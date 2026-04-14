<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use App\Models\OtpValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\OtpTrait;

class LoginController extends Controller
{
    use OtpTrait;
    public function getUsers()
    {
        try {


            return response()->json([
                'status' => true,
                'message' => 'User successfully deactivated',
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function deactivateApi(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 401);
            }

            // deactivate
            $user->account_status = 0;
            $user->save();

            $user->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Account deactivated successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function sendotp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/'
        ], [
            'mobile.required' => 'Please enter your mobile number.',
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

            //  CHECK IF USER EXISTS (NO ROLE CHECK)
            $user = User::where('phoneNumber', $request->mobile)->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'not_registered' => true,
                    'message' => 'You are not registered. Please sign up first.'
                ], 422);
            }

            //  RATE LIMITING (max 3 OTPs in 5 minutes)
            $recentOtps = OtpValidation::where('phone', $request->mobile)
                ->where('type', 'login')
                ->where('created_at', '>', now()->subMinutes(5))
                ->count();

            if ($recentOtps >= 3) {
                return response()->json([
                    'status' => false,
                    'message' => 'Too many OTP requests. Please try again after 5 minutes.'
                ], 429);
            }

            //  GENERATE OTP
            $otp = $this->createOtp($request->mobile, 'login');

            if (isset($otp['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to generate OTP. Please try again.'
                ], 500);
            }



            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully',
                'otp' => $otp
            ], 200);

        } catch (\Exception $e) {
            log::error('Login OTP Send Error: ' . $e->getMessage());


            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/',
                'otp' => 'required|digits:6'
            ], [
                'otp.required' => 'Please enter the OTP',
                'otp.digits' => 'OTP must be 6 digits',
                'mobile.regex' => 'Please enter a valid mobile number'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

        try {

            $result = $this->validateOtp($request->mobile, $request->otp, 'login');

            if (isset($result['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => $result['error']
                ], 422);
            }
            

            return response()->json([
                'status' => true,
                'message' => 'OTP verification completed successfully.',
            ], 200);

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
        $validator = Validator::make($request->all(), [
                'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/',
                'otp' => 'required|digits:6'
            ], [
                'otp.required' => 'Please enter the OTP',
                'otp.digits' => 'OTP must be 6 digits',
                'mobile.regex' => 'Please enter a valid mobile number'
            ]);

        if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

        try {

            //  CHECK USER EXISTS
            $user = User::where('phoneNumber', $request->mobile)->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'You are not registered'
                ], 404);
            }

            //  CHECK OTP VERIFIED (RECENT)
            $otpVerified = OtpValidation::where('phone', $request->mobile)
                ->where('type', 'login')
                ->where('is_used', 1)
                ->where('created_at', '>', now()->subMinutes(5))
                ->latest()
                ->first();

            if (!$otpVerified) {
                return response()->json([
                    'status' => false,
                    'message' => 'OTP not verified or expired'
                ], 401);
            }

            //  ACCOUNT STATUS CHECK
            if (isset($user->account_status) && $user->account_status != 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Account is inactive'
                ], 403);
            }

            //  GENERATE TOKEN (Sanctum)
            $token = $user->createToken('auth_token')->plainTextToken;

            //  DELETE OTP AFTER LOGIN (security)
            OtpValidation::where('phone', $request->mobile)
                ->where('type', 'login')
                ->delete();

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ], 200);

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
        try {
            $user = $request->user();

            if ($user) {
                $user->currentAccessToken()->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Logout successful'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Logout failed. Please try again.'
            ], 500);
        }
    }
    

}