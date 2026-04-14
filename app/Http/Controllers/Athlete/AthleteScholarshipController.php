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
use App\Models\AthleteVideo;
use App\Models\AthleteScholarship;
use Illuminate\Support\Facades\Validator;
use App\Jobs\UploadVideoJob;
use App\Models\UniversityScholarship;
use App\Models\AthleteUniversityPreference;


class AthleteScholarshipController extends Controller
{



    // ================= MANAGE SCHOLARSHIP =================
    public function manageScholarship()
    {
        $pageTitle = 'Current Scholarships';

        try {

            $athlete = Athlete::with('sportDetail', )
                ->where('user_id', Auth::id())
                ->first();

            $primarySport = optional($athlete->sportDetail)->primary_sport_id;
            // ✅ Get preference row
            $preference = AthleteUniversityPreference::where('athlete_id', $athlete->id)->first();
            $preferredUniversityIds = [];
            if ($preference) {
                $preferredUniversityIds = array_filter([
                    $preference->firstPreference,
                    $preference->secondPreference,
                    $preference->thirdPreference,
                ]);
            }

            if (!$primarySport) {
                $scholarships = collect();
            } else {

                $scholarships = UniversityScholarship::with('university.user')
                    ->whereHas('seats.sport', function ($q) use ($primarySport) {

                        // university_sports.sport_id = sports.id
                        $q->where('sport_id', $primarySport);

                    })
                    ->whereIn('university_id', $preferredUniversityIds)
                    ->get();
            }

            return view(
                'athlete.athleteScholarship.athleteScholarshipList',
                compact('pageTitle', 'scholarships')
            );

        } catch (\Exception $e) {

            Log::error('Scholarship Manage Error', [
                'message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function applyScholarship($id)
    {
        $pageTitle = 'Scholarship Details';

        try {

            $athlete = Athlete::with('sportDetail')
                ->where('user_id', Auth::id())
                ->first();

            $primarySport = optional($athlete->sportDetail)->primary_sport_id;

            $scholarships = UniversityScholarship::with([
                'university.user',

                // Seats filter
                'seats' => function ($q) use ($primarySport) {
                    $q->whereHas('sport', function ($s) use ($primarySport) {
                        $s->where('sport_id', $primarySport);
                    });
                },

                'seats.sport',
                'seats.course'
            ])

                // Scholarship filter
                ->whereHas('seats.sport', function ($q) use ($primarySport) {
                    $q->where('sport_id', $primarySport);
                })

                ->where('id', $id)
                ->get();


            $appliedSeats = AthleteScholarship::where('athlete_id', $athlete->id)
                ->pluck('scholarship_seat_id')
                ->toArray();

            return view(
                'athlete.athleteScholarship.applyScholarship',
                compact('pageTitle', 'scholarships', 'appliedSeats')
            );

        } catch (\Exception $e) {

            Log::error('Scholarship Manage Error', [
                'message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }



    public function storeApplication(Request $request)
    {
        try {

            $athlete = Athlete::where('user_id', Auth::id())->first();

            AthleteScholarship::create([
                'athlete_id' => $athlete->id,
                'scholarship_seat_id' => $request->seat_id,
                'university_scholarship_id' => $request->scholarship_id
            ]);



            return response()->json([
                'success' => true,
                'message' => 'Scholarship applied successfully'
            ]);

        } catch (\Exception $e) {

            Log::error('Apply Scholarship Error', [
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false
            ]);
        }
    }

}
