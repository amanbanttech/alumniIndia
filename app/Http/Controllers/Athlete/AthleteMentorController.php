<?php

namespace App\Http\Controllers\Athlete;
use Illuminate\Support\Facades\Auth;
use App\Models\AthleteAssignMentor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\MentorFeedback;

class AthleteMentorController extends Controller
{
    public function index()
    {
        $pageTitle = 'My Mentor';
        $athlete = Auth::user()->athlete;

        $mentorData = AthleteAssignMentor::with(['mentor.user', 'mentor.university'])
            ->where('athlete_id', $athlete->id)
            ->first();
        return view('athlete.athleteMentor.myMentor', compact('pageTitle', 'mentorData'));
    }
    public function feedbackList()
    {
        $pageTitle = 'Feedback List';

        $athlete = Auth::user()->athlete;

        $feedbacks = MentorFeedback::with('mentor')
            ->where('athlete_id', $athlete->id)
            ->latest()
            ->get();
            

        return view('athlete.athleteMentor.feedbackList', compact('pageTitle','feedbacks'));
    }

    public function addFeedback()
    {
        $pageTitle = 'Add Feedback';

        return view('athlete.athleteMentor.addFeedback', compact('pageTitle'));
    }

    public function storeFeedback(Request $request)
    {
        $request->validate(
            [
                'feedback' => 'required',
            ],
            [
                'feedback.required' => 'Mentor Feedback field is required.',
            ]
        );
        try {



            $athlete = Auth::user()->athlete;

            // athlete ka assigned mentor
            $assignMentor = AthleteAssignMentor::where('athlete_id', $athlete->id)->first();

            if (!$assignMentor) {
                return back()->with('error', 'No mentor assigned.');
            }

            MentorFeedback::create([
                'athlete_id' => $athlete->id,
                'mentor_id' => $assignMentor->mentor_id,
                'feedback' => $request->feedback,
            ]);


            //  Success
            return redirect()->route('athlete.feedback-list')->with('success', 'feedback added successfully.');

        } catch (\Exception $e) {

            //  Log Error
            Log::error('Athlete feedback Save Error', [
                'message' => $e->getMessage(),

            ]);

            //  Show Friendly Message
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
