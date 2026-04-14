<?php
namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;

use App\Models\OtpValidation;
use Illuminate\Support\Facades\Validator;
use App\Models\State;
use App\Http\Controllers\Admin\OtpTrait;

use App\Models\SubUniversity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use Exception;

class SubUniversityController extends Controller
{
    use OtpTrait;


    public function universitylist()
    {
        try {
            $pageTitle = 'Manage Sub-University Admins';

            $university = Auth::user()->university;

            // Fetch all sub-universities for the current university, including their related user data.
            $subUniversities = SubUniversity::with('user')
                ->where('university_id', $university->id)
                ->orderBy('id', 'desc')
                ->get();

            return view(
                'university.subUniversity.subUniversityList',
                compact('pageTitle', 'subUniversities')
            );

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load sub-university list page.');
        }
    }

    public function add()
    {
        try {
            $pageTitle = 'Add Sub-University Admin';

            return view('university.subUniversity.addSubUniversity', compact('pageTitle'));
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Unable to load add sub-university page.');
        }
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
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
        try {

            // Check if mobile already registered
            if (User::where('phoneNumber', $request->mobile)->exists()) {
                return response()->json([
                    'success' => false,
                    'already_registered' => true,
                    'message' => 'This mobile number is already registered. Please login.'
                ], 422);
            }

            // Check rate limiting - prevent spam (max 3 OTPs in 5 minutes)
            $recentOtps = OtpValidation::where('phone', $request->mobile)
                ->where('type', 'sub_university')
                ->where('created_at', '>', now()->subMinutes(5))
                ->count();

            if ($recentOtps >= 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many OTP requests. Please try again after 5 minutes.'
                ], 429);
            }

            // GENERATE NEW OTP (createOtp will delete old ones automatically)
            $otp = $this->createOtp($request->mobile, 'admin');

            if (isset($otp['error'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to generate OTP. Please try again.'
                ], 500);
            }

            // Store phone in session temporarily (will be locked after verification)
            session(['temp_registration_phone' => $request->mobile]);

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully to your mobile number',
                'otp' => $otp // Remove in production
            ]);

        } catch (\Exception $e) {
            Log::error('OTP Send Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
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
            'otp.required' => 'Please enter the OTP',
            'otp.digits' => 'OTP must be 6 digits',
            'mobile.regex' => 'Please enter a valid mobile number'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
        try {

            $result = $this->validateOtp($request->mobile, $request->otp, 'admin');

            if (isset($result['error'])) {
                return response()->json([
                    'success' => false,
                    'message' => $result['error']
                ], 422);
            }

            // Lock the verified phone number in session
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
            Log::error('OTP Verify Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'OTP verification failed. Please try again.'
            ], 500);
        }
    }
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
            'mobile' => 'required|digits:10|unique:users,phoneNumber',
            'email' => 'required|email|unique:users,email',
            'otp' => 'required|digits:6',
        ], [
            'name.regex' => 'The sub-university admin name may only contain letters and spaces.',
            'name.required' => 'The sub-university admin name field is required.',
        ]);

        // Ensure mobile number is verified via session before proceeding.

        if (
            !session()->has('verified_registration_phone') ||
            session('verified_registration_phone') != $request->mobile
        ) {
            return back()->with('error', 'Please verify mobile number before submitting.');
        }

        DB::beginTransaction();

        try {

            $university = Auth::user()->university;

            $user = User::create([
                'role_id' => 3,
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->mobile,
            ]);

            SubUniversity::create([
                'university_id' => $university->id,
                'user_id' => $user->id,
                'name' => $request->name,
            ]);

            DB::commit();

            Mail::send('email.subUniversityRegister', [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phoneNumber,
                'loginUrl' => route('subUniversity.login.view'),
            ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Sub-University Account Created Successfully');
            });

            // Clear verified session data after successful registration
            session()->forget('verified_registration_phone');

            return redirect()->route('university.subUniversity.list')->with('success', 'Sub-University Admin added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('University Store Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }


    public function edit($id)
    {
        try {
            $pageTitle = 'Edit Sub-University Admin';

            $subUniversity = Auth::user()->university
                ->subUniversities()
                ->with('user')
                ->findOrFail($id);

            return view(
                'university.subUniversity.editSubUniversity',
                compact('subUniversity', 'pageTitle')
            );

        } catch (\Exception $e) {
            return back()->with('error', 'Sub-University not found.');
        }
    }


    public function update(Request $request, $id)
    {
        $subUniversity = Auth::user()->university
            ->subUniversities()
            ->with('user')
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
            'email' => 'required|email|unique:users,email,' . $subUniversity->user->id,
            'mobile' => 'required|digits:10|unique:users,phoneNumber,' . $subUniversity->user->id,
            // 'otp_verified' => 'required|in:1',
        ], [
            'name.regex' => 'The sub-university admin name may only contain letters and spaces.',
            'name.required' => 'The sub-university admin name field is required.',
            // 'otp_verified.in' => 'Please verify mobile number before updating.',
        ]);

        // Check if mobile number is changed and ensure OTP verification
        if ($request->mobile != $subUniversity->user->phoneNumber) {

            if ($request->otp_verified != 1) {
                return back()
                    ->withErrors(['otp_verified' => 'Please verify mobile number before updating.'])
                    ->withInput();
            }
        }

        DB::beginTransaction();

        try {

            $subUniversity->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->mobile,
            ]);

            // update sub_universities table
            $subUniversity->update([
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()->route('university.subUniversity.list')->with('success', 'Sub-University Admin updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Sub-University Admin Update Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }


}


