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

class AthleteRegisterController extends Controller
{
    use OtpTrait;

    public function registerView()
    {
        return view('athlete.auth.register');
    }



    public function sendOtp(Request $request)
    {
        try {
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

            // Check if mobile already registered
            if (User::where('phoneNumber', $request->mobile)->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => 'This mobile number is already registered. Please login.'
                ], 422);
            }

            // Rate limit: max 3 OTPs in 5 minutes
            $recentOtps = OtpValidation::where('phone', $request->mobile)
                ->where('type', 'athlete_register')
                ->where('created_at', '>', now()->subMinutes(5))
                ->count();

            if ($recentOtps >= 3) {
                return response()->json([
                    'status' => false,
                    'message' => 'Too many OTP requests. Please try again after 5 minutes.'
                ], 429);
            }

            // Generate OTP
            $otp = $this->createOtp($request->mobile, 'athlete_register');

            if (isset($otp['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to generate OTP. Please try again.'
                ], 500);
            }

            // Temporary session store
            session(['temp_registration_phone' => $request->mobile]);

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully to your mobile number',
                'otp' => $otp // ⚠️ REMOVE IN PRODUCTION
            ]);

        } catch (\Exception $e) {
            Log::error('Athlete OTP Send Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ], 500);
        }
    }


    public function verifyOtp(Request $request)
    {
        try {
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

            $result = $this->validateOtp(
                $request->mobile,
                $request->otp,
                'athlete_register'
            );

            if (isset($result['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => $result['error']
                ], 422);
            }

            // Lock verified phone in session
            session([
                'verified_registration_phone' => $request->mobile,
                'registration_phone_locked_at' => now()->timestamp
            ]);

            // Remove temp phone
            session()->forget('temp_registration_phone');

            return response()->json([
                'status' => true,
                'message' => 'Mobile number verified successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Athlete OTP Verify Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'OTP verification failed. Please try again.'
            ], 500);
        }
    }



    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10|unique:users,phoneNumber',
            'email' => 'required|email|unique:users,email',
            'otp' => 'required|digits:6',
        ]);

        if (
            !session()->has('verified_registration_phone') ||
            session('verified_registration_phone') != $request->mobile
        ) {
            return back()->with('error', 'Please verify mobile number before submitting.');
        }

        DB::beginTransaction();

        try {


            $user = User::create([
                'role_id' => 5,
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->mobile,
            ]);

            $user->athlete()->create([
                'name' => $user->name
            ]);

            DB::commit();

            Mail::send('email.SubUniversityRegister', [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phoneNumber,
            ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Sub-University Registration Successful');
            });

            session()->forget('verified_registration_phone');

            return redirect()->route('athlete.login.view')->with('success', 'Athlete added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Athlete Store Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }
}
