<?php
namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\ScholarshipSeat;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Athlete;
use App\Models\Mentor;
use App\Models\OtpValidation;
use Illuminate\Support\Facades\Validator;
use App\Models\State;

use App\Http\Controllers\Admin\OtpTrait;
use App\Models\AthleteScholarship;
use App\Models\AthleteAssignMentor;
use App\Models\AthleteSportDetail;
use App\Models\VideoLike;
use App\Models\AthleteVideo;
use App\Models\SubUniversity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\UniversityScholarship;
use App\Models\UniversitySport;
use App\Models\UniversityManageSeat;
use Carbon\Carbon;

use Exception;

class ScholarshipController extends Controller
{


    public function scholarshiplist()
    {
        try {

            $pageTitle = 'Manage Scholarships';

            $user = Auth::user();
            $university = $user->university;

            if (!$university) {
                return back()->with('error', 'University not found.');
            }

            // Fetch only login university scholarships
            $scholarships = UniversityScholarship::where('university_id', $university->id)
                ->orderBy('id', 'desc')
                ->get();


            return view(
                'university.scholarship.scholarshipList',
                compact('pageTitle', 'scholarships')
            );

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load scholarship list page.');
        }
    }

    public function add()
    {
        try {
            $pageTitle = 'Add Scholarship';

            return view('university.scholarship.scholarshipAdd', compact('pageTitle'));
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Unable to load add scholarship page.');
        }
    }


    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:250',
            'open_from' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after_or_equal:open_from|after_or_equal:today',


        ], [
            'open_from.after_or_equal' => 'Date must be greater than or equal to today.',
            'end.after_or_equal' => 'End date must be greater than or equal to open from date.'

        ]);


        DB::beginTransaction();

        try {

            $university = Auth::user()->university;

            if (!$university) {
                return back()->with('error', 'University not found.');
            }

            $scholarship = UniversityScholarship::create([
                'university_id' => $university->id,
                'title' => $request->title,
                'description' => $request->description,
                'open_from' => $request->open_from,
                'end' => $request->end,
            ]);

            // Generate SCH-1 format like Ord-1
            $scholarship->scholarship_id = 'SCH-' . $scholarship->id;
            $scholarship->save();



            DB::commit();
            return redirect()->route('university.scholarship.list')->with('success', 'Scholarship added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Scholarship Store Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }


    public function edit($id)
    {
        try {

            $pageTitle = 'Edit Scholarship';
            $user = Auth::user();

            $university = $user->university;

            if (!$university) {
                return back()->with('error', 'University not found.');
            }

            $scholarship = UniversityScholarship::where('id', $id)
                ->where('university_id', $university->id)
                ->first();

            if (!$scholarship) {
                return back()->with('error', 'Scholarship not found.');
            }

            return view(
                'university.scholarship.scholarshipEdit',
                compact('scholarship', 'pageTitle')
            );

        } catch (\Exception $e) {
            Log::error($e);
            return back()->with('error', 'Something went wrong.');
        }
    }


    public function update(Request $request, $id)
    {
        $scholarship = UniversityScholarship::where('id', $id)
            ->where('university_id', Auth::user()->university->id)
            ->firstOrFail();

        $originalDate = Carbon::parse($scholarship->open_from)->toDateString();
        $newDate = Carbon::parse($request->open_from)->toDateString();
        $openFromRule = 'required|date';
        if ($originalDate != $newDate) {
            //  sirf tab check lagega jab date change hui ho
            $openFromRule .= '|after_or_equal:today';
        }
        $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:250',
            'open_from' => $openFromRule,

            'end' => 'required|date|after_or_equal:open_from',
        ], [
            'open_from.after_or_equal' => 'Open from date cannot be earlier than original date.',
            'end.after_or_equal' => 'End date must be greater than or equal to open from date.'

        ]);

        try {



            $scholarship->update([
                'title' => $request->title,
                'description' => $request->description,
                'open_from' => $request->open_from,
                'end' => $request->end,
            ]);

            return redirect()
                ->route('university.scholarship.list')
                ->with('success', 'Scholarship updated successfully.');

        } catch (\Exception $e) {
            Log::error('Scholarship Store Error: ' . $e->getMessage());

            return back()->with('error', 'Something went wrong.');
        }
    }

    public function manageseat($id)
    {
        try {

            $pageTitle = 'Manage Seats';

            $user = Auth::user();
            $university = $user->university;

            if (!$university) {
                return back()->with('error', 'University not found.');
            }

            // Get scholarships with seats
            $scholarships = UniversityScholarship::where('id', $id)
                ->where('university_id', $university->id)
                ->with([
                    'seats' => function ($q) {
                        $q->orderBy('id', 'desc'); //  latest first
                    }
                ])
                ->firstOrFail();

            return view(
                'university.scholarship.manageseat',
                compact('pageTitle', 'scholarships')
            );

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load manage seats list page.');
        }
    }

    public function addseat($id)
    {
        try {
            $pageTitle = 'Add Seat';

            $university = Auth::user()->university;

            $scholarship = UniversityScholarship::where('id', $id)
                ->where('university_id', $university->id)
                ->firstOrFail();

            $sports = $university->sports()
                ->with('sport')
                ->get();

            $courses = $university->courses()->orderBy('name')->get();

            return view('university.scholarship.addseat', compact('pageTitle', 'sports', 'courses', 'scholarship'));
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Unable to load add seat page.');
        }
    }

    public function storeseat(Request $request)
    {


        $request->validate([
            'scholarship_id' => 'required|exists:university_scholarships,id',
            'sport_id' => 'required',
            'seat_alloted' => 'required',
            'course_id' => 'required',
            'scholarship_amount' => 'required|integer',


        ], [
            'scholarship_id.exists' => 'Selected scholarship does not exist.',
            'sport_id.required' => 'The sport name is required.',
            'course_id.required' => 'The course is required.',
            'scholarship_amount.integer' => 'Decimal values are not allowed. Please enter a whole number.',
        ]);


        DB::beginTransaction();

        try {

            $university = Auth::user()->university;

            if (!$university) {
                return back()->with('error', 'Your account is not linked with any university.');
            }

            ScholarshipSeat::create([
                'university_id' => $university->id,
                'scholarship_id' => $request->scholarship_id,
                'university_sport_id' => $request->sport_id,
                'course_id' => $request->course_id,
                'seat_alloted' => $request->seat_alloted,
                'scholarship_amount' => $request->scholarship_amount,
            ]);




            DB::commit();
            return redirect()->route('university.manageseat', $request->scholarship_id)->with('success', 'Seat added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Seat Store Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function editseat($id)
    {
        try {

            $pageTitle = 'Edit Seat';

            $user = Auth::user();
            $university = $user->university;

            if (!$university) {
                return back()->with('error', 'University not found.');
            }

            // Get Seat
            $seat = ScholarshipSeat::where('id', $id)
                ->where('university_id', $university->id)
                ->firstOrFail();

            // Get Scholarship
            $scholarship = UniversityScholarship::where('id', $seat->scholarship_id)
                ->where('university_id', $university->id)
                ->firstOrFail();

            // Get Sports
            $sports = $university->sports()
                ->with('sport')
                ->get();

            // Get Courses
            $courses = $university->courses()
                ->orderBy('name')
                ->get();

            return view(
                'university.scholarship.editseat',
                compact(
                    'pageTitle',
                    'seat',
                    'scholarship',
                    'sports',
                    'courses'
                )
            );

        } catch (\Exception $e) {

            Log::error('Edit Seat Error: ' . $e->getMessage());

            return back()->with('error', 'Unable to load edit seat page.');
        }
    }


    public function updateseat(Request $request, $id)
    {
        $request->validate([
            'sport_id' => 'required',
            'seat_alloted' => 'required',
            'course_id' => 'required',
            'scholarship_amount' => 'required|integer',
        ], [
            'sport_id.required' => 'The sport name is required.',
            'course_id.required' => 'The course is required.',
            'scholarship_amount.integer' => 'Decimal values are not allowed. Please enter a whole number.',

        ]);

        try {

            $university = Auth::user()->university;

            $seat = ScholarshipSeat::where('id', $id)
                ->where('university_id', $university->id)
                ->firstOrFail();

            $seat->update([
                'university_sport_id' => $request->sport_id,
                'seat_alloted' => $request->seat_alloted,
                'course_id' => $request->course_id,
                'scholarship_amount' => $request->scholarship_amount,
            ]);

            return redirect()
                ->route('university.manageseat', $seat->scholarship_id)
                ->with('success', 'Seat updated successfully.');

        } catch (\Exception $e) {

            Log::error('Seat Update Error: ' . $e->getMessage());

            return back()->with('error', 'Something went wrong.');
        }
    }


    public function appliedScholarship($seatId)
    {
        $pageTitle = 'Applied Scholarships';

        $user = Auth::user();
        $university = $user->university;

        if (!$university) {
            return back()->with('error', 'University not found.');
        }

        // seat info
        $seat = ScholarshipSeat::findOrFail($seatId);

        $applications = DB::table('athlete_scholarships as aps')

            ->join('athletes as a', 'a.id', '=', 'aps.athlete_id')

            ->join('athlete_sport_details as asd', 'asd.athlete_id', '=', 'a.id')

            ->join('university_sports as us', 'us.sport_id', '=', 'asd.primary_sport_id')

            ->join('sports as s', 's.id', '=', 'us.sport_id')

            ->where('aps.university_scholarship_id', $seat->scholarship_id)

            // IMPORTANT FILTER
            ->where('us.id', $seat->university_sport_id)

            ->select(
                'a.id as athlete_id',
                'a.name',
                'a.address',
                's.name as sport'
            )

            ->distinct()
            ->get();

        return view(
            'university.scholarship.appliedScholarship',
            compact('pageTitle', 'applications', 'seat')
        );
    }


    public function viewPreview($id)
    {
        try {

            $pageTitle = 'Athlete Profile';

            $athlete = Athlete::with(['state', 'videos.likes'])->findOrFail($id);

            return view(
                'university.scholarship.viewPreview',
                compact('pageTitle', 'athlete')
            );

        } catch (\Exception $e) {

            Log::error('Athlete profile(university-pannel) Error: ' . $e->getMessage());

            return back()->with('error', 'Unable to load athlete profile page.');
        }
    }

    public function assignMentor($id)
    {
        try {

            $pageTitle = 'Assign Mentor';

            $athlete = Athlete::findOrFail($id);

            $university = Auth::user()->university;

            // athlete ka sport (sports.id)
            $sportId = AthleteSportDetail::where('athlete_id', $id)
                ->value('primary_sport_id');

            // mentors filter
            $mentors = Mentor::with('user')
                ->whereHas('sport', function ($q) use ($sportId, $university) {
                    $q->where('sport_id', $sportId)
                        ->where('university_id', $university->id);
                })
                ->get();

            $assignedMentor = AthleteAssignMentor::where('athlete_id', $id)->first();

            return view(
                'university.scholarship.assignMentor',
                compact('pageTitle', 'mentors', 'athlete', 'assignedMentor')
            );

        } catch (\Exception $e) {

            Log::error('Assign Mentor Error: ' . $e->getMessage());

            return back()->with('error', 'Unable to load assign mentor page.');
        }
    }


    public function storeAssignedMentor(Request $request)
    {
        try {

            $request->validate([
                'athlete_id' => 'required',
                'mentor_id' => 'required'
            ]);

            AthleteAssignMentor::updateOrCreate(
                ['athlete_id' => $request->athlete_id],
                ['mentor_id' => $request->mentor_id]
            );

            return back()->with('success', 'Mentor assigned successfully');

        } catch (\Exception $e) {

            Log::error('Assign Mentor Store Error: ' . $e->getMessage());

            return back()->with('error', 'Something went wrong');
        }
    }



}


