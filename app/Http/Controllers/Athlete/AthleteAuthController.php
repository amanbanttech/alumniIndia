<?php

namespace App\Http\Controllers\Athlete;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\User;
use App\Models\OtpValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\OtpTrait;

class AthleteAuthController extends Controller
{
    use OtpTrait;

    public function loginView()
    {
        return view('athlete.auth.login');
    }



    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/'
        ], [
            'mobile.required' => 'Mobile number is required',
            'mobile.digits' => 'Mobile number must be exactly 10 digits',
            'mobile.regex' => 'Please enter a valid mobile number'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
        try {




            // 🔐 Athlete must already exist for LOGIN
            $user = User::where('phoneNumber', $request->mobile)
                ->where('role_id', 5) // athlete
                ->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Athlete not found. Please register first.'
                ], 404);
            }

            // 🚫 Rate limit: 3 OTPs in 5 minutes
            $recentOtps = OtpValidation::where('phone', $request->mobile)
                ->where('type', 'athlete_login')
                ->where('created_at', '>', now()->subMinutes(5))
                ->count();

            if ($recentOtps >= 3) {
                return response()->json([
                    'status' => false,
                    'message' => 'Too many OTP requests. Please try again after 5 minutes.'
                ], 429);
            }

            // ✅ Generate OTP for LOGIN
            $otp = $this->createOtp($request->mobile, 'athlete_login');

            if (isset($otp['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to generate OTP. Please try again.'
                ], 500);
            }

            // 🔒 Temp session (optional but safe)
            session(['temp_login_phone' => $request->mobile]);

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully to your mobile number',
                'otp' => $otp // ⚠️ REMOVE IN PRODUCTION
            ]);

        } catch (\Exception $e) {
            Log::error('Athlete Login OTP Send Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ], 500);
        }
    }



    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/',
            'otp' => 'required|digits:6'
        ], [
            'mobile.required' => 'Mobile number is required',
            'mobile.digits' => 'Mobile number must be exactly 10 digits',
            'mobile.regex' => 'Please enter a valid mobile number',
            'otp.required' => 'Please enter the OTP',
            'otp.digits' => 'OTP must be 6 digits'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
        try {




            // ✅ Validate OTP (LOGIN)
            $result = $this->validateOtp(
                $request->mobile,
                $request->otp,
                'athlete_login'
            );

            if (isset($result['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => $result['error']
                ], 422);
            }

            // 🔐 Lock verified phone for LOGIN (5 min)
            session([
                'verified_login_phone' => $request->mobile,
                'login_phone_locked_at' => now()->timestamp
            ]);

            // Cleanup
            session()->forget('temp_login_phone');

            return response()->json([
                'status' => true,
                'message' => 'Mobile number verified successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Athlete Login OTP Verify Error: ' . $e->getMessage());

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
                ->where('type', 'athlete_login')
                ->where('is_used', 1)
                ->first();

            if (!$otpVerified) {
                return response()->json([
                    'status' => false,
                    'message' => 'OTP not verified. Please verify your mobile number again.'
                ], 422);
            }

            $user = User::where('phoneNumber', $request->mobile)
                ->where('role_id', 5)
                ->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Athlete not found'
                ], 403);
            }


            Auth::login($user);

            OtpValidation::where('phone', $request->mobile)
                ->where('type', 'athlete_login')
                ->delete();

            session()->forget(['verified_login_phone', 'login_phone_locked_at']);

            return redirect()
                ->route('athlete.dashboard');

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
            ->route('athlete.login.view')
            ->with('success', 'Logged out successfully');
    }

}
