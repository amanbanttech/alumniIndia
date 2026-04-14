<?php

namespace App\Http\Controllers\Mentor;

use App\Models\VideoLike;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\Athlete;
use App\Models\MentorFeedback;
class MentorAthleteController extends Controller
{
    public function index()
    {
        $pageTitle = 'My Athletes';
        try {

            $mentor = auth()->user()->mentor;
            if (!$mentor) {
                abort(404, 'Mentor profile not found.');
            }

            $assignments = $mentor->assignedAthletes()
                ->with('athlete.user', 'athlete.sportDetail')
                ->orderBy('athlete_id', 'desc')
                ->get();

            return view('mentor.athlete.athleteList', compact('pageTitle', 'assignments'));
        } catch (\Exception $e) {
            \Log::error('Error fetching mentor athletes: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while fetching your athletes. Please try again later.');
        }




    }

    public function athleteProfile($athleteId)
    {
        $pageTitle = 'Athlete Profile';

        try {
            $mentor = auth()->user()->mentor;

            if (!$mentor) {
                abort(404, 'Mentor profile not found.');
            }

            $assignment = $mentor->assignedAthletes()
                ->where('athlete_id', $athleteId)
                ->with('athlete.user', 'athlete.sportDetail')
                ->first();

            if (!$assignment) {
                abort(404, 'Athlete not assigned to you.');
            }


            $feedbacks = MentorFeedback::where('athlete_id', $athleteId)
                ->where('mentor_id', $mentor->id)
                ->latest()
                ->get();

            $athlete = $assignment->athlete;

            return view('mentor.athlete.athleteProfile', compact('pageTitle', 'athlete', 'feedbacks'));

        } catch (\Exception $e) {
            \Log::error('Error fetching athlete profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

  


}
