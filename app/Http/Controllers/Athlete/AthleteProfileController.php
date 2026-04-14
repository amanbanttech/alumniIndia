<?php

namespace App\Http\Controllers\Athlete;
use App\Models\OtpValidation;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use App\Models\Degree;
use App\Models\Board;
use App\Models\DiplomaBoard;
use App\Models\AthleteDocument;
use App\Models\DiplomaStream;
use App\Models\Sport;
use App\Models\TwelfthStream;
use App\Models\Nationality;
use App\Models\Athlete;
use App\Models\AthleteAcademicDetail;
use App\Models\AthleteSportDetail;
use App\Http\Controllers\Admin\OtpTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AthleteProfileController extends Controller
{


    // ================= PROFILE PAGE =================
    public function profile()
    {
        $user = auth()->user();
        $pageTitle = 'Athlete Profile';

        $athlete = Athlete::with('academicDetail', 'sportDetail', 'document')
            ->where('user_id', $user->id)
            ->first();

        $states = State::orderBy('name')->get();
        $boards = Board::all();
        $diplomaBoards = DiplomaBoard::all();
        $diplomaStreams = DiplomaStream::all();
        $twelfthStreams = TwelfthStream::all();
        $sports = Sport::all();

        $degrees = Degree::all();
        $nationalities = Nationality::orderBy('nationality')->get();

        return view('athlete.athleteProfile.athleteProfile', compact('user', 'athlete', 'states', 'boards', 'diplomaBoards', 'diplomaStreams', 'twelfthStreams', 'degrees', 'sports', 'pageTitle', 'nationalities'));
    }




    public function updateAjaxProfile(Request $request)
    {



        $user = Auth::user();
        $athlete = Athlete::with('document')
            ->where('user_id', $user->id)
            ->first();
        /* ================= STEP 1 ================= */
        if ($request->ajax() && $request->step == 1) {

            /* 🔹 Validation */
            $validator = Validator::make($request->all(), [

                'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email',
                'mobile' => 'required|digits:10',
                'dob' => 'required|date|before:today',
                'gender' => 'required',
                'nationality_id' => 'required|exists:nationalities,id',
                'address' => 'required',
                'athlete_profile' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
                'city' => 'required',
                'zip_code' => 'required|numeric',
                'state_id' => 'required',

            ], [
                'state_id.required' => 'The state field is required.',
                'name.required' => 'The full name field is required.',
                'name.regex' => 'The full name should contain only letters and spaces.',
                'nationality_id.exists' => 'The selected nationality is invalid.',
                'nationality_id.required' => 'The nationality field is required.',



            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }






            DB::beginTransaction();

            try {

                /* 🔹 IMAGE UPLOAD (STEP-1) */

                $imageName = $user->image;

                if ($request->hasFile('athlete_profile')) {

                    // delete old
                    if ($imageName && file_exists(public_path('athlete_assets/images/' . $imageName))) {

                        unlink(public_path('athlete_assets/images/' . $imageName));
                    }

                    $img = $request->file('athlete_profile');

                    $imageName = time() . '.' . $img->getClientOriginalExtension();

                    $img->move(
                        public_path('athlete_assets/images/'),
                        $imageName
                    );
                }


                /* 🔹 USER UPDATE (STEP-1) */

                $user->update([

                    'name' => $request->name,
                    'email' => $request->email,
                    'phoneNumber' => $request->mobile,
                    'image' => $imageName,

                ]);

                $user->refresh();
                /* 🔹 ATHLETE UPDATE (STEP-1) */

                $athlete->update([

                    'name' => $request->name,
                    'date_of_birth' => $request->dob,
                    'gender' => $request->gender,
                    'nationality_id' => $request->nationality_id,
                    'address' => $request->address,
                    'city' => $request->city,
                    'zip_code' => $request->zip_code,
                    'state_id' => $request->state_id,

                ]);

                DB::commit();

            } catch (\Exception $e) {

                DB::rollBack();
                Log::error('Step4 Error: ' . $e->getMessage());

                return response()->json([
                    'errors' => [
                        'server' => ['Failed to save Step-1 data']
                    ]
                ], 422);
            }





            return response()->json([
                'status' => true
            ]);
        }


        /* ================= STEP 2 (FINAL) ================= */
        if ($request->ajax() && $request->step == 2) {




            /* 🔹 Validation */
            $validator = Validator::make($request->all(), [

                // ========== 10th ==========
                'school_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'tenth_board_id' => 'required',
                'tenth_year' => 'required|integer|min:1950|max:' . date('Y'),
                'tenth_result_type' => 'required|in:percentage,cgpa,grade',
                'tenth_result' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $type = $request->tenth_result_type;

                        if ($type === 'percentage') {
                            if (!is_numeric($value) || $value < 1 || $value > 100) {
                                $fail('For percentage result type, the value must be a number between 1 and 100.');
                            }
                        } elseif ($type === 'cgpa') {
                            if (!is_numeric($value) || $value < 1 || $value > 10) {
                                $fail('For CGPA result type, the value must be a number between 1 and 10.');
                            }
                        } elseif ($type === 'grade') {
                            if (!preg_match('/^[A-F]$/i', $value)) {
                                $fail('For grade result type, the value must be a letter between A and F.');
                            }
                        }
                    }
                ],
                'tenth_marksheet' => $athlete->academicDetail?->tenth_marksheet
                    ? 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120'
                    : 'required|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',


                // ========== 12th ==========
                'twelfth_school_name' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'twelfth_board_id' => 'nullable',
                'twelfth_stream_id' => 'nullable',
                'twelfth_year' => 'nullable|integer|min:1950|max:' . date('Y'),
                'twelfth_result_type' => 'nullable|in:percentage,cgpa,grade',
                'twelfth_result' => [
                    'nullable',
                    function ($attribute, $value, $fail) use ($request) {
                        $type = $request->twelfth_result_type;

                        if ($type === 'percentage') {
                            if (!is_numeric($value) || $value < 1 || $value > 100) {
                                $fail('For percentage result type, the value must be a number between 1 and 100.');
                            }
                        } elseif ($type === 'cgpa') {
                            if (!is_numeric($value) || $value < 1 || $value > 10) {
                                $fail('For CGPA result type, the value must be a number between 1 and 10.');
                            }
                        } elseif ($type === 'grade') {
                            if (!preg_match('/^[A-F]$/i', $value)) {
                                $fail('For grade result type, the value must be a letter between A and F.');
                            }
                        }
                    }
                ],
                'twelfth_marksheet' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',


                // Diploma
                'diploma_college_name' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'diploma_board_id' => 'nullable',
                'diploma_stream_id' => 'nullable',
                'diploma_year' => 'nullable|integer|min:1950|max:' . date('Y'),
                'diploma_result_type' => 'nullable|in:percentage,cgpa,grade',
                'diploma_result' => [
                    'nullable',
                    function ($attribute, $value, $fail) use ($request) {
                        $type = $request->diploma_result_type;

                        if ($type === 'percentage') {
                            if (!is_numeric($value) || $value < 1 || $value > 100) {
                                $fail('For percentage result type, the value must be a number between 0 and 100.');
                            }
                        } elseif ($type === 'cgpa') {
                            if (!is_numeric($value) || $value < 1 || $value > 10) {
                                $fail('For CGPA result type, the value must be a number between 0 and 10.');
                            }
                        } elseif ($type === 'grade') {
                            if (!preg_match('/^[A-F]$/i', $value)) {
                                $fail('For grade result type, the value must be a letter between A and F.');
                            }
                        }
                    }
                ],
                'diploma_marksheet' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',


                // ========== Graduation (Optional) ==========
                'graduation_university' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'degree_id' => 'nullable',
                'specialization' => 'nullable|string|max:100|regex:/^[a-zA-Z\s]+$/',
                'graduation_year' => 'nullable|integer|min:1975|max:' . (date('Y') + 5),
                'graduation_result_type' => 'nullable|in:percentage,cgpa,grade',
                'graduation_result' => [
                    'nullable',
                    function ($attribute, $value, $fail) use ($request) {
                        $type = $request->graduation_result_type;

                        if ($type === 'percentage') {
                            if (!is_numeric($value) || $value < 1 || $value > 100) {
                                $fail('For percentage result type, the value must be a number between 0 and 100.');
                            }
                        } elseif ($type === 'cgpa') {
                            if (!is_numeric($value) || $value < 1 || $value > 10) {
                                $fail('For CGPA result type, the value must be a number between 0 and 10.');
                            }
                        } elseif ($type === 'grade') {
                            if (!preg_match('/^[A-F]$/i', $value)) {
                                $fail('For grade result type, the value must be a letter between A and F.');
                            }
                        }
                    }
                ],
                'graduation_marksheet' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',

            ], [
                'tenth_board_id.required' => 'Board field is required.',
                'twelfth_board_id.required' => 'Board field is required.',
                'twelfth_stream_id.required' => 'Twelfth stream is required.',
                'diploma_board_id.required' => 'Diploma board is required.',
                'diploma_stream_id.required' => 'Diploma stream is required.',
                'degree_id.required' => 'Degree is required.',
                'school_name.regex' => 'The school name should contain only letters and spaces.',
                'twelfth_school_name.regex' => 'The school name should contain only letters and spaces.',
                'diploma_college_name.regex' => 'The college name should contain only letters and spaces.',
                'graduation_university.regex' => 'The college name should contain only letters and spaces.',
                'specialization.regex' => 'The specialization should contain only letters and spaces.',
                'tenth_year.integer' => 'The year of passing must be a integer.',
                'tenth_result_type.required' => 'The result type field is required.',
                'tenth_result.required' => 'Please select result type first.',
                'tenth_year.min' => 'Year of passing cannot be less than 1975.',
                'tenth_year.max' => 'Year of passing must not be greater than 2026.',
                'twelfth_year.min' => 'Year of passing cannot be less than 1975.',
                'twelfth_year.max' => 'Year of passing must not be greater than 2026.',
                'tenth_year.required' => 'The year of passing field is required.',
                'tenth_marksheet.required' => 'Certificate field is required.',








            ]);


            if ($validator->fails()) {

                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }


            DB::beginTransaction();

            try {



                $imageName = optional($athlete->academicDetail)->tenth_marksheet;

                if ($request->hasFile('tenth_marksheet')) {

                    // delete old
                    if ($imageName && file_exists(public_path('athlete_assets/10_marksheet/' . $imageName))) {

                        unlink(public_path('athlete_assets/10_marksheet/' . $imageName));
                    }

                    $img = $request->file('tenth_marksheet');

                    $imageName = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/10_marksheet/'),
                        $imageName
                    );
                }

                $twelfthImage = optional($athlete->academicDetail)->twelfth_marksheet;

                if ($request->hasFile('twelfth_marksheet')) {

                    // delete old
                    if ($twelfthImage && file_exists(public_path('athlete_assets/12_marksheet/' . $twelfthImage))) {

                        unlink(public_path('athlete_assets/12_marksheet/' . $twelfthImage));
                    }

                    $img = $request->file('twelfth_marksheet');

                    $twelfthImage = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/12_marksheet/'),
                        $twelfthImage
                    );
                }


                $diplomaImage = optional($athlete->academicDetail)->diploma_marksheet;

                if ($request->hasFile('diploma_marksheet')) {

                    // delete old
                    if ($diplomaImage && file_exists(public_path('athlete_assets/diploma_marksheet/' . $diplomaImage))) {

                        unlink(public_path('athlete_assets/diploma_marksheet/' . $diplomaImage));
                    }

                    $img = $request->file('diploma_marksheet');

                    $diplomaImage = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/diploma_marksheet/'),
                        $diplomaImage
                    );
                }



                $graduationImage = optional($athlete->academicDetail)->graduation_marksheet;

                if ($request->hasFile('graduation_marksheet')) {

                    // delete old
                    if ($graduationImage && file_exists(public_path('athlete_assets/graduation_marksheet/' . $graduationImage))) {

                        unlink(public_path('athlete_assets/graduation_marksheet/' . $graduationImage));
                    }

                    $img = $request->file('graduation_marksheet');

                    $graduationImage = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/graduation_marksheet/'),
                        $graduationImage
                    );
                }



                /* 🔹 ONLY EDUCATION UPDATE (STEP-2) */

                AthleteAcademicDetail::updateOrCreate(
                    ['athlete_id' => $athlete->id],
                    [

                        // 10th
                        'school_name' => $request->school_name,
                        'tenth_board_id' => $request->tenth_board_id,
                        'tenth_year' => $request->tenth_year,
                        'tenth_result_type' => $request->tenth_result_type,
                        'tenth_result' => $request->tenth_result,
                        'tenth_marksheet' => $imageName,

                        // 12th
                        'twelfth_school_name' => $request->twelfth_school_name,
                        'twelfth_board_id' => $request->twelfth_board_id,
                        'twelfth_stream_id' => $request->twelfth_stream_id,
                        'twelfth_year' => $request->twelfth_year,
                        'twelfth_result_type' => $request->twelfth_result_type,
                        'twelfth_result' => $request->twelfth_result,
                        'twelfth_marksheet' => $twelfthImage,

                        // Diploma
                        'diploma_college_name' => $request->diploma_college_name,
                        'diploma_board_id' => $request->diploma_board_id,
                        'diploma_stream_id' => $request->diploma_stream_id,
                        'diploma_year' => $request->diploma_year,
                        'diploma_result_type' => $request->diploma_result_type,
                        'diploma_result' => $request->diploma_result,
                        'diploma_marksheet' => $diplomaImage,

                        // Graduation
                        'graduation_university' => $request->graduation_university,
                        'degree_id' => $request->degree_id,
                        'specialization' => $request->specialization,
                        'graduation_year' => $request->graduation_year,
                        'graduation_result_type' => $request->graduation_result_type,
                        'graduation_result' => $request->graduation_result,
                        'graduation_marksheet' => $graduationImage,
                    ]
                );






                DB::commit();


            } catch (\Exception $e) {

                DB::rollBack();

                return response()->json([
                    'errors' => [
                        'server' => ['Failed to save Step-2 data']
                    ]
                ], 422);
            }






            return response()->json([
                'status' => true
            ]);
        }

        /* ================= STEP 3 ================= */

        if ($request->ajax() && $request->step == 3) {

            if ($request->previous_injury === 'No') {

                // Delete old medical file
                $medical_certificate = optional($athlete->sportDetail)->medical_certificate;
                if ($medical_certificate && file_exists(public_path('athlete_assets/medical_certificate/' . $medical_certificate))) {
                    unlink(public_path('athlete_assets/medical_certificate/' . $medical_certificate));
                }

                $medical_certificate = null;

                $request->merge([
                    'injury_details' => null,
                    'recovery_status' => null,
                ]);
            }

            /* 🔹 Validation */
            $validator = Validator::make($request->all(), [

                // ========== sports profile ==========
                'primary_sport_id' => 'required',
                'academy' => 'nullable|string|regex:/^[a-zA-Z\s]+$/|max:255',
                'coach_name' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'coach_contact' => 'nullable|digits:10',
                'training_experience' => 'required|numeric',

                // ========== physical matrices ==========

                'height' => 'required|numeric',
                'weight' => 'required|numeric',
                'wingspan' => 'required|numeric',
                'chest' => 'required|numeric',
                'waist' => 'required|numeric',
                'body_fat' => 'nullable|numeric',
                'fitness_level' => 'required|in:Beginner,Intermediate,Elite',


                'state_ranking' => 'nullable',
                'state_age_category' => 'nullable|in:U14,U16,U19,senior',
                'district_ranking' => 'nullable',
                'district_age_category' => 'nullable|in:U14,U16,U19,senior',
                'national_ranking' => 'nullable',
                'national_age_category' => 'nullable|in:U14,U16,U19,senior',
                'best_performance' => 'nullable|string',
                'international_participation' => 'nullable|in:Yes,No',
                'bronze_medal' => 'nullable|string',
                'gold_medal' => 'nullable|string',
                'silver_medal' => 'nullable|string',

                'previous_injury' => 'required|in:Yes,No',
                'injury_details' => [
                    Rule::when($request->previous_injury === 'Yes', ['required', 'string', 'min:20', 'max:1000'], ['nullable']),
                ],
                'recovery_status' => [
                    Rule::when($request->previous_injury === 'Yes', ['required', 'string', 'max:255'], ['nullable']),
                ],
                'medical_certificate' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',


                'coach_certificate' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',
                'sport_card' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',




            ], [
                'primary_sport_id.required' => 'The primary sport is required.',
                'academy.regex' => 'The academy should contain only letters and spaces.',
                'training_experience.numeric' => 'The training/experience should contain numbers only.',
                'coach_name.regex' => 'The coach name should contain only letters and spaces.',
                'height.numeric' => 'The height should contain numbers only.',
                'weight.numeric' => 'The weight should contain numbers only.',
                'wingspan.numeric' => 'The wingspan should contain numbers only.',
                'chest.numeric' => 'The chest should contain numbers only.',
                'waist.numeric' => 'The waist should contain numbers only.',
                'body_fat.numeric' => 'The body fat should contain numbers only.',
                'training_experience.required' => 'The training/experience field is required.',



            ]);




            if ($validator->fails()) {

                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();
            try {

                /* 🔹 ONLY SPORTS UPDATE (STEP-3) */

                $sport_card = optional($athlete->sportDetail)->sport_card ?? null;

                if ($request->hasFile('sport_card')) {

                    // delete old
                    if ($sport_card && file_exists(public_path('athlete_assets/sport_card/' . $sport_card))) {

                        unlink(public_path('athlete_assets/sport_card/' . $sport_card));
                    }

                    $img = $request->file('sport_card');

                    $sport_card = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/sport_card/'),
                        $sport_card
                    );
                }

                $coach_certificate = optional($athlete->sportDetail)->coach_certificate ?? null;

                if ($request->hasFile('coach_certificate')) {

                    // delete old
                    if ($coach_certificate && file_exists(public_path('athlete_assets/coach_certificate/' . $coach_certificate))) {

                        unlink(public_path('athlete_assets/coach_certificate/' . $coach_certificate));
                    }

                    $img = $request->file('coach_certificate');

                    $coach_certificate = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/coach_certificate/'),
                        $coach_certificate
                    );
                }

                $medical_certificate = optional($athlete->sportDetail)->medical_certificate ?? null;

                if ($request->hasFile('medical_certificate')) {

                    // delete old
                    if ($medical_certificate && file_exists(public_path('athlete_assets/medical_certificate/' . $medical_certificate))) {

                        unlink(public_path('athlete_assets/medical_certificate/' . $medical_certificate));
                    }

                    $img = $request->file('medical_certificate');

                    $medical_certificate = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/medical_certificate/'),
                        $medical_certificate
                    );
                }

                if ($request->previous_injury !== 'Yes') {

                    $request->merge([
                        'injury_details' => null,
                        'recovery_status' => null,
                        'medical_certificate' => null,
                    ]);
                }


                AthleteSportDetail::updateOrCreate(

                    [
                        'athlete_id' => $athlete->id,
                    ],
                    [
                        'primary_sport_id' => $request->primary_sport_id,
                        'academy' => $request->academy,
                        'coach_name' => $request->coach_name,
                        'coach_contact' => $request->coach_contact,
                        'training_experience' => $request->training_experience,


                        'height' => $request->height,
                        'weight' => $request->weight,
                        'wingspan' => $request->wingspan,
                        'chest' => $request->chest,
                        'waist' => $request->waist,
                        'body_fat' => $request->body_fat,
                        'fitness_level' => $request->fitness_level,

                        'state_ranking' => $request->state_ranking,
                        'state_age_category' => $request->state_age_category,
                        'district_ranking' => $request->district_ranking,
                        'district_age_category' => $request->district_age_category,
                        'national_ranking' => $request->national_ranking,
                        'national_age_category' => $request->national_age_category,
                        'best_performance' => $request->best_performance,
                        'international_participation' => $request->international_participation,
                        'gold_medal' => $request->gold_medal,
                        'silver_medal' => $request->silver_medal,
                        'bronze_medal' => $request->bronze_medal,

                        'previous_injury' => $request->previous_injury,
                        'injury_details' => $request->injury_details,
                        'recovery_status' => $request->recovery_status,
                        'medical_certificate' => $medical_certificate,
                        'sport_card' => $sport_card,
                        'coach_certificate' => $coach_certificate,




                    ]
                );

                db::commit();

            } catch (\Exception $e) {

                db::rollBack();
                Log::error('Step4 Error: ' . $e->getMessage());

                return response()->json([
                    'errors' => [
                        'server' => ['Failed to save Step-3 data']
                    ]
                ], 422);
            }





            return response()->json([
                'status' => true
            ]);
        }

        /* ================= STEP 4 ================= */

        if ($request->ajax() && $request->step == 4) {




            /* 🔹 Validation */
            $validator = Validator::make($request->all(), [

                // ========== mandatory documents =========

                'profile_photo' => $athlete->document?->profile_photo
                    ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'
                    : 'required|image|mimes:jpg,jpeg,png,webp|max:5120',

                'government_proof' => $athlete->document?->government_proof
                    ? 'nullable|file|mimes:jpg,doc,docx,jpeg,png,webp|max:5120'
                    : 'required|file|mimes:jpg,doc,docx,jpeg,png,webp|max:5120',
                'dob_proof' => $athlete->document?->dob_proof
                    ? 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120'
                    : 'required|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',
                'address_proof' => $athlete->document?->address_proof
                    ? 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120'
                    : 'required|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',

                'sport_achievement' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',
                'coach_recommendation' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',
                'medical_fitness' => $athlete->document?->medical_fitness
                    ? 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120'
                    : 'required|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',
                'player_contract' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',

                'reference_name1' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'reference_role1' => 'nullable|in:Coach,Trainer,Teacher,Sports officials',
                'reference_academy1' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'reference_relationship1' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'reference_number1' => 'nullable|regex:/^[0-9]+$/',
                'reference_email1' => 'nullable|email',
                'reference_document1' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',


                'reference_name2' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'reference_role2' => 'nullable|in:Coach,Trainer,Teacher,Sport Official',
                'reference_academy2' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'reference_relationship2' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'reference_number2' => 'nullable|regex:/^[0-9]+$/',
                'reference_email2' => 'nullable|email',
                'reference_document2' => 'nullable|file|mimes:jpg,jpeg,doc,docx,png,webp|max:5120',





            ], [
                'reference_name1.regex' => 'The reference name should contain only letters and spaces.',
                'reference_name2.regex' => 'The reference name should contain only letters and spaces.',
                'reference_academy1.regex' => 'The reference academy should contain only letters and spaces.',
                'reference_academy2.regex' => 'The reference academy should contain only letters and spaces.',
                'reference_relationship1.regex' => 'The reference relationship should contain only letters and spaces.',
                'reference_relationship2.regex' => 'The reference relationship should contain only letters and spaces.',
                'reference_number1.regex' => 'The reference number should contain only numbers.',
                'reference_number2.regex' => 'The reference number should contain only numbers.',
                'reference_email1.email' => 'The reference email address should be a valid email address.',
                'reference_email2.email' => 'The reference email address should be a valid email address.',
                'profile_photo.required' => 'Profile photo field is required.',
                'government_proof.required' => 'Government id proof field is required.',
                'dob_proof.required' => 'Date of birth proof field is required.',
                'address_proof.required' => 'Address proof field is required.',
                'medical_fitness.required' => 'Medical fitness certificate field is required.',



            ]);


            if ($validator->fails()) {

                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();
            try {


                $profilePhoto = optional($athlete->document)->profile_photo ?? null;

                if ($request->hasFile('profile_photo')) {

                    // delete old
                    if ($profilePhoto && file_exists(public_path('athlete_assets/athlete_documents/' . $profilePhoto))) {

                        unlink(public_path('athlete_assets/athlete_documents/' . $profilePhoto));
                    }

                    $img = $request->file('profile_photo');

                    $profilePhoto = time() . '.' . $img->getClientOriginalExtension();

                    $img->move(
                        public_path('athlete_assets/athlete_documents/'),
                        $profilePhoto
                    );
                }

                $govProof = optional($athlete->document)->government_proof ?? null;

                if ($request->hasFile('government_proof')) {

                    // delete old
                    if ($govProof && file_exists(public_path('athlete_assets/athlete_documents/' . $govProof))) {

                        unlink(public_path('athlete_assets/athlete_documents/' . $govProof));
                    }

                    $img = $request->file('government_proof');

                    $govProof = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/athlete_documents/'),
                        $govProof
                    );
                }

                $dobProof = optional($athlete->document)->dob_proof ?? null;

                if ($request->hasFile('dob_proof')) {

                    // delete old
                    if ($dobProof && file_exists(public_path('athlete_assets/athlete_documents/' . $dobProof))) {

                        unlink(public_path('athlete_assets/athlete_documents/' . $dobProof));
                    }

                    $img = $request->file('dob_proof');

                    $dobProof = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/athlete_documents/'),
                        $dobProof
                    );
                }

                $addressProof = optional($athlete->document)->address_proof ?? null;

                if ($request->hasFile('address_proof')) {

                    // delete old
                    if ($addressProof && file_exists(public_path('athlete_assets/athlete_documents/' . $addressProof))) {

                        unlink(public_path('athlete_assets/athlete_documents/' . $addressProof));
                    }

                    $img = $request->file('address_proof');

                    $addressProof = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/athlete_documents/'),
                        $addressProof
                    );
                }

                $sportAchieve = optional($athlete->document)->sport_achievement ?? null;

                if ($request->hasFile('sport_achievement')) {

                    // delete old
                    if ($sportAchieve && file_exists(public_path('athlete_assets/athlete_documents/' . $sportAchieve))) {

                        unlink(public_path('athlete_assets/athlete_documents/' . $sportAchieve));
                    }

                    $img = $request->file('sport_achievement');

                    $sportAchieve = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/athlete_documents/'),
                        $sportAchieve
                    );
                }

                $coachRecomend = optional($athlete->document)->coach_recommendation ?? null;

                if ($request->hasFile('coach_recommendation')) {

                    // delete old
                    if ($coachRecomend && file_exists(public_path('athlete_assets/athlete_documents/' . $coachRecomend))) {

                        unlink(public_path('athlete_assets/athlete_documents/' . $coachRecomend));
                    }

                    $img = $request->file('coach_recommendation');

                    $coachRecomend = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/athlete_documents/'),
                        $coachRecomend
                    );
                }

                $medicalFitness = optional($athlete->document)->medical_fitness ?? null;

                if ($request->hasFile('medical_fitness')) {

                    // delete old
                    if ($medicalFitness && file_exists(public_path('athlete_assets/athlete_documents/' . $medicalFitness))) {

                        unlink(public_path('athlete_assets/athlete_documents/' . $medicalFitness));
                    }

                    $img = $request->file('medical_fitness');

                    $medicalFitness = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/athlete_documents/'),
                        $medicalFitness
                    );
                }


                $playerContract = optional($athlete->document)->player_contract ?? null;

                if ($request->hasFile('player_contract')) {

                    // delete old
                    if ($playerContract && file_exists(public_path('athlete_assets/athlete_documents/' . $playerContract))) {

                        unlink(public_path('athlete_assets/athlete_documents/' . $playerContract));
                    }

                    $img = $request->file('player_contract');

                    $playerContract = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/athlete_documents/'),
                        $playerContract
                    );
                }

                $reference1 = optional($athlete->document)->reference_document1 ?? null;

                if ($request->hasFile('reference_document1')) {

                    // delete old
                    if ($reference1 && file_exists(public_path('athlete_assets/athlete_documents/' . $reference1))) {

                        unlink(public_path('athlete_assets/athlete_documents/' . $reference1));
                    }

                    $img = $request->file('reference_document1');

                    $reference1 = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/athlete_documents/'),
                        $reference1
                    );
                }

                $reference2 = optional($athlete->document)->reference_document2 ?? null;

                if ($request->hasFile('reference_document2')) {

                    // delete old
                    if ($reference2 && file_exists(public_path('athlete_assets/athlete_documents/' . $reference2))) {

                        unlink(public_path('athlete_assets/athlete_documents/' . $reference2));
                    }

                    $img = $request->file('reference_document2');

                    $reference2 = $img->getClientOriginalName();

                    $img->move(
                        public_path('athlete_assets/athlete_documents/'),
                        $reference2
                    );
                }

                AthleteDocument::updateOrCreate(

                    ['athlete_id' => $athlete->id],

                    [
                        'profile_photo' => $profilePhoto,
                        'government_proof' => $govProof,
                        'dob_proof' => $dobProof,
                        'address_proof' => $addressProof,

                        'sport_achievement' => $sportAchieve,
                        'coach_recommendation' => $coachRecomend,
                        'medical_fitness' => $medicalFitness,
                        'player_contract' => $playerContract,


                        'reference_email1' => $request->reference_email1,
                        'reference_number1' => $request->reference_number1,
                        'reference_relationship1' => $request->reference_relationship1,
                        'reference_academy1' => $request->reference_academy1,
                        'reference_role1' => $request->reference_role1,
                        'reference_name1' => $request->reference_name1,
                        'reference_document1' => $reference1,


                        'reference_email2' => $request->reference_email2,
                        'reference_number2' => $request->reference_number2,
                        'reference_relationship2' => $request->reference_relationship2,
                        'reference_academy2' => $request->reference_academy2,
                        'reference_role2' => $request->reference_role2,
                        'reference_name2' => $request->reference_name2,
                        'reference_document2' => $reference2,

                    ]
                );


                DB::commit();

            } catch (\Exception $e) {
                Log::error('Step4 Error: ' . $e->getMessage());

                return response()->json([
                    'errors' => [
                        'server' => ['Failed to save Step-4 data']
                    ]
                ], 422);
            }

            session()->flash('success', 'Profile updated successfully!');
            return response()->json([
                'status' => true,
                'redirect' => route('athlete.dashboard')
            ]);
        }

    }
}
