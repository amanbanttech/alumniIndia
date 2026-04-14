<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\OtpValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\OtpTrait;

class MentorAuthController extends Controller
{
    use OtpTrait;

    public function loginView()
    {
        return view('mentor.auth.login');
    }

    public function sendLoginOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/'
            ], [
                'mobile.required' => 'Please enter your mobile number.',
                'mobile.digits' => 'Mobile number must be exactly 10 digits.',
                'mobile.regex' => 'Please enter a valid mobile number.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            // CHECK IF MENTOR EXISTS
            $user = User::where('phoneNumber', $request->mobile)
                ->where('role_id', 4)
                ->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'not_registered' => true,
                    'message' => 'We couldn\'t find a mentor account associated with this phone number.'
                ], 422);
            }

            

            // Check rate limiting - prevent spam (max 3 OTPs in 5 minutes)
            $recentOtps = OtpValidation::where('phone', $request->mobile)
                ->where('type', 'mentor_login')
                ->where('created_at', '>', now()->subMinutes(5)) // FIXED: Was 1 minute
                ->count();

            if ($recentOtps >= 3) {
                return response()->json([
                    'status' => false,
                    'message' => 'Too many OTP requests. Please try again after 5 minutes.'
                ], 429);
            }

            // GENERATE NEW OTP (createOtp will delete old ones)
            $otp = $this->createOtp($request->mobile, 'mentor_login');

            if (isset($otp['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to generate OTP. Please try again.'
                ], 500);
            }

            // Store phone in session temporarily
            session(['temp_login_phone' => $request->mobile]);

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully to your mobile number',
                'otp' => $otp // Remove in production
            ]);
        } catch (\Exception $e) {
            Log::error('Login OTP Send Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ], 500);
        }
    }

    public function verifyLoginOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/',
                'otp' => 'required|digits:6'
            ], [
                'otp.required' => 'Please enter the OTP',
                'otp.digits' => 'OTP must be 6 digits',
                'mobile.regex' => 'Please enter a valid mobile number.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $result = $this->validateOtp($request->mobile, $request->otp, 'mentor_login');

            if (isset($result['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => $result['error']
                ], 422);
            }

            // Lock the verified phone number in session
            session([
                'verified_login_phone' => $request->mobile,
                'login_phone_locked_at' => now()->timestamp
            ]);

            // Remove temp phone
            session()->forget('temp_login_phone');

            return response()->json([
                'status' => true,
                'message' => 'OTP verification completed successfully.'
            ]);
        } catch (\Exception $e) {
            Log::error('Login OTP Verify Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'OTP verification failed. Please try again.'
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate(['mobile' => 'required|digits:10']);

        try {

            // CRITICAL: Check session-locked phone number
            $verifiedPhone = session('verified_login_phone');
            $lockedAt = session('login_phone_locked_at');

            // Check if phone was verified in last 5 minutes
            if (!$verifiedPhone || !$lockedAt || (now()->timestamp - $lockedAt) > 300) {
                return response()->json([
                    'status' => false,
                    'message' => 'OTP verification expired or not completed. Please verify again.'
                ], 422);
            }

            // CRITICAL: Submitted phone MUST match session-locked phone
            if ($request->mobile !== $verifiedPhone) {
                return response()->json([
                    'status' => false,
                    'message' => 'Security validation failed. Phone number does not match verified number.'
                ], 422);
            }

            // Double-check OTP verification in database
            $otpVerified = OtpValidation::where('phone', $request->mobile)
                ->where('type', 'mentor_login')
                ->where('is_used', 1)
                ->first();

            if (!$otpVerified) {
                return response()->json([
                    'status' => false,
                    'message' => 'OTP not verified. Please verify your mobile number again.'
                ], 422);
            }

            $user = User::where('phoneNumber', $request->mobile)
                ->where('role_id', 4)
                ->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Mentor not found'
                ], 403);
            }

            //  ACCOUNT STATUS CHECK (IMPORTANT)
            if ($user->account_status == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials.Access restricted.'
                ], 403);
            }


            Auth::login($user);

            OtpValidation::where('phone', $request->mobile)
                ->where('type', 'mentor_login')
                ->delete();

            session()->forget(['verified_login_phone', 'login_phone_locked_at']);

            return response()->json([
                'status' => true,
                'message' => 'Login Successful',
                'redirect' => route('mentor.dashboard')
            ]);
        } catch (\Exception $e) {
            Log::error('Login Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Login failed. Please try again.'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('mentor.login.view')
            ->with('success', 'Logged out successfully');
    }

        public function deactivateView()
    {
        $pageTitle = 'Deactivate My Account';
        return view('mentor.profile.accountDeactivate', compact('pageTitle'));
    }

    public function deactivate()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        // status column use kar rahe ho to
        $user->account_status = 0;
        $user->save();

        auth()->logout();

        return redirect('/mentor/login')->with('success', 'Account deactivated successfully');
    }
}
