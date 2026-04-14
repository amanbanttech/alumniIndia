<?php
namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\UniversitySport;
use Illuminate\Support\Facades\Auth;
use App\Models\OtpValidation;
use Illuminate\Support\Facades\Validator;
use App\Models\State;
use App\Models\Mentor;
use App\Http\Controllers\Admin\OtpTrait;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use Exception;

class ManageMentorController extends Controller
{
    use OtpTrait;


    public function mentorlist()
    {
        try {
            $pageTitle = 'Manage Mentors';

            $university = Auth::user()->university;

            // Check if university is linked
            if (!$university) {
                return back()->with('error', 'University not linked with this account.');
            }

            // Fetch mentors with related user and sport data
            $mentors = Mentor::with(['user', 'sport.sport'])
                ->where('university_id', $university->id)
                ->orderBy('id', 'desc')
                ->get();

            return view('university.mentors.manageMentor', compact('pageTitle', 'mentors'));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load mentors list.');
        }
    }


    public function add()
    {

        try {
            $pageTitle = 'Add Mentor';

            $university = Auth::user()->university;

            // Check if university exists
            if (!$university) {
                return redirect()->back()
                    ->with('error', 'University not linked with this account.');
            }

            // Fetch sports associated with the university
            $sports = $university->sports()
                ->with('sport')
                ->get();



            return view('university.mentors.addMentor', compact('pageTitle', 'sports'));
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Unable to load add mentor page.');
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


        $request->validate(
            [
                'name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|digits:10|unique:users,phoneNumber',
                'sport_id' => 'required|exists:university_sports,id',
                'otp' => 'required|digits:6',
            ],
            [
                'sport_id.required' => 'The sport category field is required.',
                'sport_id.exists' => 'Please select a valid sport.',
                'name.required' => 'The mentor name field is required.',
                'name.regex' => 'The mentor name should contain only letters and spaces.',
            ]
        );

        // OTP VERIFICATION CHECK

        if (
            !session()->has('verified_registration_phone') ||
            session('verified_registration_phone') != $request->mobile
        ) {
            return back()->with('error', 'Please verify mobile number before submitting.');
        }

        DB::beginTransaction();

        try {

            // UNIVERSITY CHECK

            $university = Auth::user()->university;

            if (!$university) {
                return back()->with('error', 'University not linked with this account.');
            }

            // VALIDATE SPORT BELONGS TO UNIVERSITY
            $sport = $university->sports()
                ->where('id', $request->sport_id)
                ->first();

            if (!$sport) {
                return back()->with('error', 'Invalid sport selected.');
            }

            $user = User::create([
                'role_id' => 4,
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->mobile,
            ]);

            Mentor::create([
                'user_id' => $user->id,
                'sport_id' => $request->sport_id,
                'university_id' => $university->id,
            ]);


            DB::commit();

            Mail::send('email.mentorRegister', [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phoneNumber,
                'loginUrl' => route('mentor.login.view'),

            ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Mentor Account Created Successfully');
            });

            // Clear OTP session after successful registration
            session()->forget('verified_registration_phone');

            return redirect()->route('university.mentor.list')->with('success', 'Mentor added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('University Store Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        try {
            $pageTitle = 'Edit Mentor';

            $university = Auth::user()->university;

            if (!$university) {
                return back()->with('error', 'University not linked with this account.');
            }

            // FETCH MENTOR WITH RELATIONS
            $mentor = Mentor::with(['user', 'sport.sport'])
                ->where('id', $id)
                ->firstOrFail();

            // Ensure mentor belongs to same university
            if ($mentor->university_id !== $university->id) {
                return back()->with('error', 'Unauthorized access.');
            }

            // FETCH SPORTS LIST 
            $sports = $university->sports()
                ->with('sport')
                ->get();

            return view(
                'university.mentors.editMentor',
                compact('mentor', 'sports', 'pageTitle')
            );

        } catch (\Exception $e) {
            Log::error('University Edit Error: ' . $e->getMessage());

            return back()->with('error', 'Mentor not found.');
        }
    }


    public function update(Request $request, $id)
    {
        // FETCH MENTOR WITH USER 
        $mentor = Mentor::where('id', $id)
            ->where('university_id', Auth::user()->university->id)
            ->with('user')
            ->firstOrFail();
            
        $request->validate(
            [
                'name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
                'email' => 'required|email|unique:users,email,' . $mentor->user_id,
                'mobile' => 'required|digits:10|unique:users,phoneNumber,' . $mentor->user_id,
                'otp_verified' => 'required|in:1',

                'sport_id' => 'required|exists:university_sports,id',
            ],
            [
                'sport_id.required' => 'The Sport category field is required.',
                'sport_id.exists' => 'Please select a valid sport.',
                'name.required' => 'The Mentor name field is required.',
                'name.regex' => 'The Mentor name should contain only letters and spaces.',
                'otp_verified.in' => 'Please verify mobile number before updating.',

            ]
        );

        // OTP VERIFICATION (ONLY IF MOBILE CHANGED)
        if ($request->mobile != $mentor->user->phoneNumber) {

            if ($request->otp_verified != 1) {
                return back()
                    ->withErrors(['otp_verified' => 'Please verify mobile number before updating.'])
                    ->withInput();
            }
        }
        DB::beginTransaction();

        try {

            $mentor->user->update([
                'name' => $request->name,
                'phoneNumber' => $request->mobile,
                'email' => $request->email,
            ]);

            $mentor->update([
                'sport_id' => $request->sport_id,
            ]);

            DB::commit();

            return redirect()->route('university.mentor.list')->with('success', 'Mentor updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Mentor Update Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

}