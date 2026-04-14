<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use App\Models\SubUniversity;
use Illuminate\Support\Facades\Auth;
use App\Models\OtpValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\OtpTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Athlete;
use App\Models\Video;
use App\Models\VideoLike;
use App\Models\University;
use App\Models\State;
use App\Models\Course;
use App\Models\Sport;
use App\Models\UniversityCourse;
use App\Models\Mentor;
use App\Models\UniversitySport;
use Illuminate\Validation\Rule;


class UniversityController extends Controller
{

    use OtpTrait;

    public function dashboard()
    {
        try {
            $user = Auth::user();

            if (!$user || !$user->university) {
                return response()->json([
                    'status' => false,
                    'message' => 'University not found for this user'
                ], 404);
            }

            $athletes = Athlete::with([
                'nationality',
                'videos.likes'
            ])->get();

            return response()->json([
                'status' => true,
                'message' => 'University dashboard data fetched successfully',
                'data' => $athletes

            ], 200);

        } catch (Exception $e) {
            Log::error('University Dashboard API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Unable to load dashboard. Please try again later.'
            ], 500);
        }
    }

    public function stateList()
    {
        try {
            $states = State::orderBy('name')->get();

            return response()->json([
                'status' => true,
                'message' => 'State list fetched successfully',
                'data' => $states
            ], 200);

        } catch (\Exception $e) {
            Log::error('State List API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
    public function editProfile(Request $request)
    {

        try {

            $university = University::with(['user', 'state'])->where('user_id', Auth::id())->firstOrFail();




            return response()->json([
                'status' => true,
                'message' => 'Profile fetched successfully',
                'data' => [
                    'university' => $university,

                ]
            ], 200);

        } catch (Exception $e) {
            Log::error('Edit Profile API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update profile. Please try again.'
            ], 500);
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $university = University::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('user')
            ->firstOrFail();



        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
            'email' => 'required|email|unique:users,email,' . $university->user->id,
            'state_id' => 'required|exists:states,id',
            'city' => 'required|string|max:255',
            'about' => 'required|string|max:255',
            'address' => 'required|string',
            // 'emblem_logo' => 'nullable|file|mimes:webp|max:2048',
            // 'sports_logo' => 'nullable|file|mimes:webp|max:2048',

        ], [
            'state_id.required' => 'The state field is required.',
            'state_id.exists' => 'Please select a valid state.',
            'name.regex' => 'The name should contain only letters and spaces.',
            'name.required' => 'The university name field is required.',
            'about.required' => 'The about university field is required.',
            // 'emblem_logo.mimes' => 'Please upload the emblem logo in WEBP format only.',
            // 'sports_logo.mimes' => 'Please upload the sports logo in WEBP format only.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        DB::beginTransaction();

        try {



            // Update user table
            $university->user->update([
                'name' => $request->name,
                'email' => $request->email,

            ]);

            // update university table
            $university->update([
                'state_id' => $request->state_id,
                'city' => $request->city,
                'about' => $request->about,
                'address' => $request->address,
            ]);
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',

            ], 200);

        } catch (Exception $e) {
            Log::error('Update Profile API Error: ' . $e->getMessage());
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to update profile. Please try again.'
            ], 500);
        }
    }

    public function subUniversityList(Request $request)
    {
        try {
            $user = Auth::user();

            // Check if user has university
            if (!$user || !$user->university) {
                return response()->json([
                    'status' => false,
                    'message' => 'University not found for this user'
                ], 404);
            }

            // Fetch sub-universities with user data
            $subUniversities = SubUniversity::with('user')
                ->where('university_id', $user->university->id)
                ->orderBy('id', 'desc')
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Sub-university list fetched successfully',
                'data' => $subUniversities
            ], 200);

        } catch (\Exception $e) {
            \Log::error('University List API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/|unique:users,phoneNumber',
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

            // Check if mobile already registered
            if (User::where('phoneNumber', $request->mobile)->exists()) {
                return response()->json([
                    'status' => false,
                    'already_registered' => true,
                    'message' => 'This mobile number is already registered. Please use a different number.'
                ], 422);
            }

            // Check rate limiting - prevent spam (max 3 OTPs in 5 minutes)
            $recentOtps = OtpValidation::where('phone', $request->mobile)
                ->where('type', 'sub_university')
                ->where('created_at', '>', now()->subMinutes(5))
                ->count();

            if ($recentOtps >= 3) {
                return response()->json([
                    'status' => false,
                    'message' => 'Too many OTP requests. Please try again after 5 minutes.'
                ], 429);
            }

            // GENERATE NEW OTP (createOtp will delete old ones automatically)
            $otp = $this->createOtp($request->mobile, 'sub_university');

            if (isset($otp['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to generate OTP. Please try again.'
                ], 500);
            }



            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully to your mobile number',
                'otp' => $otp // Remove in production
            ], 200);

        } catch (\Exception $e) {
            Log::error('OTP Send Error: ' . $e->getMessage());
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

            $result = $this->validateOtp($request->mobile, $request->otp, 'sub_university');

            if (isset($result['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => $result['error']
                ], 422);
            }



            return response()->json([
                'status' => true,
                'message' => 'Mobile number verified successfully!'
            ], 200);

        } catch (\Exception $e) {
            Log::error('OTP Verify Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'OTP verification failed. Please try again.'
            ], 500);
        }
    }




    public function storeSubUniversity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
            'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/|unique:users,phoneNumber',
            'email' => 'required|email|unique:users,email',
            'otp' => 'required|digits:6',
        ], [
            'name.regex' => 'The sub-university admin name may only contain letters and spaces.',
            'name.required' => 'The sub-university admin name field is required.',
            'mobile.required' => 'Please enter the sub-university admin mobile number.',
            'mobile.digits' => 'The sub-university admin mobile number must be exactly 10 digits.',
            'mobile.regex' => 'Please enter a valid sub-university admin mobile number.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {



            $user = Auth::user();

            // Check if user has university
            if (!$user || !$user->university) {
                return response()->json([
                    'status' => false,
                    'message' => 'University not found for this user'
                ], 404);
            }

            // CHECK OTP VERIFIED (RECENT)
            $otpVerified = OtpValidation::where('phone', $request->mobile)
                ->where('otp', $request->otp)
                ->where('type', 'sub_university')
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


            $university = Auth::user()->university;

            // Create User
            $user = User::create([
                'role_id' => 3,
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->mobile,
            ]);

            // Create Sub-University
            $subUniversity = SubUniversity::create([
                'university_id' => $university->id,
                'user_id' => $user->id,
                'name' => $request->name,
            ]);

            DB::commit();

            //  Send Mail (optional API me)
            Mail::send('email.subUniversityRegister', [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phoneNumber,
                'loginUrl' => route('subUniversity.login.view'),
            ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Sub-University Account Created Successfully');
            });



            return response()->json([
                'status' => true,
                'message' => 'Sub-university created successfully',
                'data' => [
                    'user' => $user,
                    'sub_university' => $subUniversity
                ]
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Create Sub-University API Error: ' . $e->getMessage());
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }

    }

    public function editSubUniversity(Request $request, $id)
    {
        try {
            $subUniversity = SubUniversity::with('user')->findOrFail($id);

            // Check if sub-university belongs to the authenticated user's university
            if ($subUniversity->university_id !== Auth::user()->university->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sub-university not found for this user'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Sub-university details fetched successfully',
                'data' => $subUniversity
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Edit Sub-University API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function updateSubUniversity(Request $request, $id)
    {
        $subUniversity = Auth::user()->university
            ->subUniversities()
            ->with('user')
            ->findOrFail($id);



        $isSameMobile = $request->mobile == $subUniversity->user->phoneNumber;


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
            'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/|unique:users,phoneNumber,' . $subUniversity->user->id,
            'email' => 'required|email|unique:users,email,' . $subUniversity->user->id,
            'otp' => $isSameMobile ? 'nullable' : 'required|digits:6',
        ], [
            'name.regex' => 'The sub-university admin name may only contain letters and spaces.',
            'name.required' => 'The sub-university admin name field is required.',
            'mobile.required' => 'Please enter the sub-university admin mobile number.',
            'mobile.digits' => 'The sub-university admin mobile number must be exactly 10 digits.',
            'mobile.regex' => 'Please enter a valid sub-university admin mobile number.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }



        //  Only check OTP if mobile changed
        if (!$isSameMobile) {

            $otp = OtpValidation::where('phone', $request->mobile)
                ->where('otp', $request->otp)
                ->where('type', 'sub_university')
                ->where('is_used', 1)
                ->where('created_at', '>', now()->subMinutes(5))
                ->latest()
                ->first();

            if (!$otp) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid or expired OTP'
                ], 422);
            }
            $otp->delete();
        }


        DB::beginTransaction();

        try {
            // Update user table
            $subUniversity->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->mobile,
            ]);

            // update sub-university table
            $subUniversity->update([
                'name' => $request->name,
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Sub-university updated successfully',
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Update Sub-University API Error: ' . $e->getMessage());
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function courseList()
    {
        try {
            $courses = Course::orderBy('name')->get();


            return response()->json([
                'status' => true,
                'message' => 'Course list fetched successfully',
                'data' => $courses
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Course List API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function editCourse(Request $request)
    {
        try {

            $university = Auth::user()->university;

            $selectedCourses = $university->courses()
                ->pluck('courses.id')
                ->toArray();

            return response()->json([
                'status' => true,
                'message' => 'Course details fetched successfully',
                'data' => $selectedCourses
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Edit Course API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function updateCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|array',
            'course_id.*' => 'exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $university = Auth::user()->university;

            // Sync selected courses with authenticated user's university and this will add new, keep existing, and remove unselected courses
            $university->courses()->sync($request->course_id);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Courses updated successfully',
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Update Course API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function sportCategoryList()
    {
        try {
            $sports = Sport::orderBy('name')->get();

            return response()->json([
                'status' => true,
                'message' => 'Sport list fetched successfully',
                'data' => $sports
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Sport List API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function sportList()
    {
        try {
            $university = auth()->user()->university()
                ->with('sports.sport')
                ->firstOrFail();
            return response()->json([
                'status' => true,
                'message' => 'Sport list fetched successfully',
                'data' => $university
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Sport List API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function storeSport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sport_id' => 'required|exists:sports,id|unique:university_sports,sport_id,NULL,id,university_id,' . auth()->user()->university->id,
            'category' => 'required|in:indoor,outdoor',
        ], [
            'sport_id.required' => 'Please select a sport.',
            'sport_id.exists' => 'Invalid sport selected.',
            'sport_id.unique' => 'This sport is already added in your university. Please select a different one.',
            'category.required' => 'The sport category field is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {

            $university = auth()->user()->university;

            UniversitySport::create([
                'university_id' => $university->id,
                'sport_id' => $request->sport_id,
                'category' => $request->category,
            ]);


            return response()->json([
                'status' => true,
                'message' => 'Sport added successfully',
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Store Sport API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);

        }
    }

    public function editSport($id)
    {
        try {
            $sport = UniversitySport::where('id', $id)
                ->where('university_id', auth()->user()->university->id)
                ->firstOrFail();

            return response()->json([
                'status' => true,
                'message' => 'Sport details fetched successfully',
                'data' => $sport
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Edit Sport API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function updateSport(Request $request, $id)
    {
        $university = auth()->user()->university;

        $validator = Validator::make(
            $request->all(),
            [

                'sport_id' => [
                    'required',
                    'exists:sports,id',

                    // Ensure sport is unique per university (ignore current record)
                    Rule::unique('university_sports')
                        ->where(function ($q) use ($university) {
                            return $q->where('university_id', $university->id);
                        })
                        ->ignore($id),
                ],
                'category' => 'required|in:indoor,outdoor',
            ],
            [
                'id.required' => 'Sport ID is required',
                'id.exists' => 'Sport not found',
                'sport_id.required' => 'Please select a sport.',
                'sport_id.exists' => 'Invalid sport selected.',
                'sport_id.unique' => 'This sport is already added in your university. Please select a different one.',
                'category.required' => 'The sport category field is required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {

            // Find sport
            $sport = UniversitySport::where('id', $id)
                ->where('university_id', auth()->user()->university->id)
                ->firstOrFail();
            // Update
            $sport->update([
                'sport_id' => $request->sport_id,
                'category' => $request->category,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Sport updated successfully',
            ], 200);

        } catch (\Exception $e) {

            \Log::error('Update Sport API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong while updating sport.'
            ], 500);
        }
    }

    public function mentorList()
    {
        try {

            $university = Auth::user()->university;

            if (!$university) {
                return response()->json([
                    'status' => false,
                    'message' => 'University not found for this user'
                ], 404);
            }

            $mentors = Mentor::with(['user', 'sport.sport'])
                ->where('university_id', $university->id)
                ->orderBy('id', 'desc')
                ->get();


            return response()->json([
                'status' => true,
                'message' => 'Mentor list fetched successfully',
                'data' => $mentors
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Mentor List API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function storeMentor(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
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

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            // CHECK OTP VERIFIED (RECENT)
            $otpVerified = OtpValidation::where('phone', $request->mobile)
                ->where('otp', $request->otp)
                ->where('type', 'sub_university')
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

            $university = Auth::user()->university;

            if (!$university) {
                return response()->json([
                    'status' => false,
                    'message' => 'University not found for this user'
                ], 404);
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


            return response()->json([
                'status' => true,
                'message' => 'Mentor added successfully',
                'data' => [
                    'user' => $user,
                    'mentor' => Mentor::with('sport.sport')->where('user_id', $user->id)->first(),
                ]
            ], 200);


        } catch (\Exception $e) {
            \Log::error('Store Mentor API Error: ' . $e->getMessage());
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong while adding mentor.'
            ], 500);
        }
    }

    public function editMentor(Request $request, $id)
    {
        try {

            $university = Auth::user()->university;

            if (!$university) {
                return response()->json([
                    'status' => false,
                    'message' => 'University not found for this user'
                ], 404);
            }

            $mentor = Mentor::where('id', $id)
                ->where('university_id', Auth::user()->university->id)
                ->with(['user', 'sport.sport'])
                ->firstOrFail();

            

            return response()->json([
                'status' => true,
                'message' => 'Mentor details fetched successfully',
                'data' => $mentor
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Edit Mentor API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function updateMentor(Request $request, $id)
    {
        $mentor = Mentor::where('id', $id)
            ->where('university_id', Auth::user()->university->id)
            ->with('user')
            ->firstOrFail();

        $isSameMobile = $request->mobile == $mentor->user->phoneNumber;

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255|regex:/^[A-Za-z ]+$/',
                'email' => 'required|email|unique:users,email,' . $mentor->user->id,
                'mobile' => 'required|digits:10|unique:users,phoneNumber,' . $mentor->user->id,
                'sport_id' => 'required|exists:university_sports,id',
                'otp' => $isSameMobile ? 'nullable' : 'required|digits:6',
            ],
            [
                'sport_id.required' => 'The sport category field is required.',
                'sport_id.exists' => 'Please select a valid sport.',
                'name.required' => 'The mentor name field is required.',
                'name.regex' => 'The mentor name should contain only letters and spaces.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            //  Only check OTP if mobile changed
            if (!$isSameMobile) {

                $otp = OtpValidation::where('phone', $request->mobile)
                    ->where('otp', $request->otp)
                    ->where('type', 'sub_university')
                    ->where('is_used', 1)
                    ->where('created_at', '>', now()->subMinutes(5))
                    ->latest()
                    ->first();

                if (!$otp) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid or expired OTP'
                    ], 422);
                }
                $otp->delete();
            }



            // Update user table
            $mentor->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->mobile,
            ]);

            // update mentor table
            $mentor->update([
                'sport_id' => $request->sport_id,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Mentor updated successfully',
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Update Mentor API Error: ' . $e->getMessage());
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Update mentor functionality is not implemented yet.'
            ], 501);
        }
    }
    
}