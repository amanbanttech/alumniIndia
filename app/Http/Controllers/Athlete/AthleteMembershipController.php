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
use Illuminate\Support\Facades\Validator;
use App\Jobs\UploadVideoJob;


class AthleteMembershipController extends Controller
{



    // ================= MANAGE MEMBERSHIP =================
    public function manageMembership()
    {
        $pageTitle = 'Manage Membership';

        try {


            return view('athlete.athleteMembership.athleteMembershipList', compact('pageTitle'));
        } catch (\Exception $e) {

            //  Log Error
            Log::error('Membership Manage Error', [
                'message' => $e->getMessage(),
            ]);

            //  Show Friendly Message
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }




}
