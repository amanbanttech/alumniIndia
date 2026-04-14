<?php
namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\Course;
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
use App\Models\UniversityScholarship;
use App\Models\UniversitySport;
use App\Models\UniversityManageSeat;
use App\Models\UniversityCourse;

use Exception;

class CourseController extends Controller
{


    public function add()
    {
        try {

            $pageTitle = 'University Courses';

            // Fetch all available courses ordered alphabetically
            $courses = Course::orderBy('name')->get();

            // Get authenticated user's university

            $university = Auth::user()->university;

            // Retrieve IDs of courses already assigned to the university
            $selectedCourses = $university->courses()
                ->pluck('courses.id')
                ->toArray();

            return view(
                'university.managecourse.courseAdd',
                compact('pageTitle', 'courses', 'selectedCourses')
            );

        } catch (Exception $e) {
            Log::error($e);

            return back()->with('error', 'Unable to load page.');
        }
    }


    public function store(Request $request)
    {


        $request->validate([
            'course_id' => 'required|array',
            'course_id.*' => 'exists:courses,id',
        ]);


        DB::beginTransaction();

        try {
            $university = Auth::user()->university;

            // Sync selected courses with authenticated user's university and this will add new, keep existing, and remove unselected courses
            $university->courses()->sync($request->course_id);


            DB::commit();
            return redirect()->route('university.course.add')->with('success', 'Course added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Scholarship Store Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }





}