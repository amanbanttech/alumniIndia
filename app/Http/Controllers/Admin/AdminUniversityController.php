<?php
namespace App\Http\Controllers\Admin;

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

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use Exception;

class AdminUniversityController extends Controller
{
    use OtpTrait;

    public function universitylist()
    {
        try {

            $pageTitle = 'Manage Universities';

            $universities = University::with('user', 'state')
                ->orderBy('id', 'desc')
                ->get();

            return view('admin.manageUniversity.universityList', compact('pageTitle', 'universities'));
        } catch (Exception $e) {
            log::error($e);
            return back()->with('error', 'Unable to load password update page.');
        }
    }

    public function add()
    {
        try {
            $pageTitle = 'Add University';
            $states = State::orderBy('name')->get();

            return view('admin.manageUniversity.addUniversity', compact('pageTitle', 'states'));
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Unable to load add university page.');
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
                    'message' => 'This mobile number is already registered. Please use a different mobile number.'
                ], 422);
            }

            // Check rate limiting - prevent spam (max 3 OTPs in 5 minutes)
            $recentOtps = OtpValidation::where('phone', $request->mobile)
                ->where('type', 'admin')
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
                'message' => 'OTP verified successfully!'
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
                'about' => 'required|string',
                'mobile' => 'required|unique:users,phoneNumber|digits:10',
                'otp' => 'required|digits:6',
                'email' => 'required|email|unique:users,email',
                'address' => 'required|string',
                'city' => 'required|string',
                'state_id' => 'required|exists:states,id',
                'emblem_logo' => 'nullable',
                'sports_logo' => 'nullable',
            ],
            [
                'email.email' => 'Please enter a valid email address.',

                'state_id.required' => 'The state field is required.',
                'state_id.exists' => 'Please select a valid state.',
                'name.regex' => 'The name should contain only letters and spaces.',
                'name.required' => 'The university name field is required.',
                'about.required' => 'The about university field is required.',

            ],

        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        if (
            !session()->has('verified_registration_phone') ||
            session('verified_registration_phone') != $request->mobile
        ) {
            return redirect()
                ->back()
                ->with('error', 'Please verify mobile number before submitting.')
                ->withInput();

        }

        $otpRecord = OtpValidation::where('phone', $request->mobile)
            ->where('otp', $request->otp)
            ->where('type', 'admin')
            ->latest()
            ->first();

        if (!$otpRecord) {
            return back()->with('error', 'Invalid OTP')->withInput();
        }

        // Expiry check (5 min)
        if ($otpRecord->created_at < now()->subMinutes(5)) {
            return back()->with('error', 'OTP expired')->withInput();
        }



        DB::beginTransaction();

        try {

            $emblemFileName = null;
            if ($request->hasFile('emblem_logo')) {
                $emblemFileName = uniqid() . '.' . $request->file('emblem_logo')->extension();
                $request->file('emblem_logo')->move(
                    public_path('university_assets/images'),
                    $emblemFileName
                );
            }

            $user = User::create([
                'role_id' => 2,
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->mobile,
                'image' => $emblemFileName,
            ]);

            $sportsFileName = null;
            if ($request->hasFile('sports_logo')) {
                $sportsFileName = uniqid() . '.' . $request->file('sports_logo')->extension();
                $request->file('sports_logo')->move(
                    public_path('university_assets/sports_logo'),
                    $sportsFileName
                );
            }

            $university = University::create([
                'user_id' => $user->id,
                'about' => $request->about,
                'city' => $request->city,
                'address' => $request->address,
                'sports_logo' => $sportsFileName,
                'state_id' => $request->state_id,
            ]);

            



            DB::commit();

            Mail::send('email.universityRegister', [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phoneNumber,
                'loginUrl' => route('university.login.view'),
            ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('University Account Created Successfully');
            });

            session()->forget('verified_registration_phone');

            return response()->json([
                'status' => true,
                'message' => 'University added successfully',
                'redirect' => route('admin.university.list')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('University Store Error: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();


        }
    }


    public function edit($id)
    {
        try {
            $pageTitle = 'Add University';
            $university = University::with(['user', 'state'])->findOrFail($id);
            $states = State::orderBy('name')->get();

            $currentStateId = optional($university->state)->id;


            return view('admin.manageUniversity.editUniversity', compact('university', 'currentStateId', 'states', 'pageTitle'));
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Unable to load add university page.');
        }
    }

    public function update(Request $request, $id)
    {
        $university = University::with('user')->findOrFail($id);
        $userId = $university->user->id;

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
                'about' => 'required|string',
                'mobile' => 'required|digits:10|unique:users,phoneNumber,' . $userId,
                'email' => 'required|email|unique:users,email,' . $userId,
                'address' => 'required|string',
                'city' => 'required|string',
                'state_id' => 'required|exists:states,id',
                'emblem_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'sports_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ],
            [
                'state_id.required' => 'The state field is required.',
                'state_id.exists' => 'Please select a valid state.',
                'name.regex' => 'The name should contain only letters and spaces.',
                'name.required' => 'The university name field is required.',
                'about.required' => 'The about university field is required.',

            ]
        );
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->mobile != $university->user->phoneNumber) {

            if ($request->otp_verified != 1) {
                return back()
                    ->withErrors(['otp_verified' => 'Please verify mobile number before updating.'])
                    ->withInput();
            }
            $otpRecord = OtpValidation::where('phone', $request->mobile)
                ->where('otp', $request->otp)
                ->where('type', 'admin')
                ->latest()
                ->first();

            if (!$otpRecord) {
                return back()->with('error', 'Invalid OTP')->withInput();
            }

            // Expiry check (5 min)
            if ($otpRecord->created_at < now()->subMinutes(5)) {
                return back()->with('error', 'OTP expired')->withInput();
            }
        }



        DB::beginTransaction();

        try {

            $emblemFileName = $university->user->image;
            if ($request->hasFile('emblem_logo')) {
                if ($emblemFileName && file_exists(public_path('university_assets/images/' . $emblemFileName))) {
                    unlink(public_path('university_assets/images/' . $emblemFileName));
                }

                $emblemFileName = uniqid() . '.' . $request->file('emblem_logo')->extension();
                $request->file('emblem_logo')->move(
                    public_path('university_assets/images'),
                    $emblemFileName
                );
            }

            $university->user->update([
                'name' => $request->name,
                'phoneNumber' => $request->mobile,
                'email' => $request->email,
                'image' => $emblemFileName,
            ]);

            $sportsFileName = $university->sports_logo;
            if ($request->hasFile('sports_logo')) {
                if ($sportsFileName && file_exists(public_path('university_assets/sports_logo/' . $sportsFileName))) {
                    unlink(public_path('university_assets/sports_logo/' . $sportsFileName));
                }

                $sportsFileName = uniqid() . '.' . $request->file('sports_logo')->extension();
                $request->file('sports_logo')->move(
                    public_path('university_assets/sports_logo'),
                    $sportsFileName
                );
            }

            $university->update([
                'city' => $request->city,
                'about' => $request->about,
                'state_id' => $request->state_id,
                'address' => $request->address,
                'sports_logo' => $sportsFileName,
            ]);

            

            DB::commit();

            return redirect()->route('admin.university.list')
                ->with('success', 'University updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('University Update Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong');
        }
    }


    public function view($id)
    {
        try {
            $pageTitle = 'View University';
            $university = University::with(['user', 'state'])->findOrFail($id);
            return view('admin.manageUniversity.viewUniversity', compact('pageTitle', 'university'));

        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Unable to load view university page.');
        }
    }


}


