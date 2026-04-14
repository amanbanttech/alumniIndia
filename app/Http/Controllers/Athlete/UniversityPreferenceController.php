<?php

namespace App\Http\Controllers\Athlete;
use App\Models\OtpValidation;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Degree;
use App\Models\Board;
use App\Models\DiplomaBoard;
use App\Models\AthleteDocument;
use App\Models\DiplomaStream;
use App\Models\Sport;
use App\Models\TwelfthStream;
use App\Models\Athlete;
use App\Models\AthleteUniversityPreference;
use App\Models\University;
class UniversityPreferenceController extends Controller
{



    // ================= SET UNIVERSITY PREFERENCE =================
    public function setUniversityPreference()
    {
        $pageTitle = 'Set Universities Preferences';


        $universities = University::with('user')->get();
        $athlete = Athlete::where('user_id', Auth::id())->first();
         $preference = $athlete
        ? $athlete->universityPreference
        : null;

        return view('athlete.setPreference.setPreference', compact('pageTitle', 'universities', 'preference','athlete'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'first_university' => 'required|integer',
            'second_university' => 'required|integer|different:first_university',
            'third_university' => 'required|integer|different:first_university|different:second_university',
        ]);
        try {

            //  Get Logged-in User's Athlete
            $athlete = Athlete::where('user_id', Auth::id())->first();

            if (!$athlete) {
                return back()->with('error', 'Athlete profile not found.');
            }


            //  Store Using Relation
            $athlete->universityPreference()->updateOrCreate([
                'athlete_id' => $athlete->id,
            ], [
                'firstPreference' => $request->first_university,
                'secondPreference' => $request->second_university,
                'thirdPreference' => $request->third_university,
            ]);

            //  Success
            return back()->with('success', 'University preferences saved successfully.');

        } catch (\Exception $e) {

            //  Log Error
            Log::error('University Preference Save Error', [
                'user_id' => Auth::id(),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            //  Show Friendly Message
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}

