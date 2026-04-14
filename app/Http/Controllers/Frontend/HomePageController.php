<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Exception;

class HomePageController extends Controller
{
    public function about()
    {
        return view('frontend.about');
    }

    public function contactUs()
    {
        return view('frontend.contactUs');
    }

    public function mentorshipProgram()
    {
        return view('frontend.mentorshipProgram');
    }

    public function donation()
    {
        return view('frontend.donation');
    }

    public function scholarshipEvent()
    {
        return view('frontend.scholarshipEvents');
    }

    public function eventDetail()
    {
        return view('frontend.eventDetail');
    }

    public function blog()
    {
        return view('frontend.blog');

    }

    public function workshop()
    {
        return view('frontend.workshop');
    }

    public function pastEvents()
    {
        return view('frontend.pastEvent');
    }

    public function privacyPolicy()
    {
        return view('frontend.privacyPolicy');
    }
    public function termsAndConditions()
    {
        return view('frontend.termAndCondition');
    }

            public function findUniversity()
    {
        return view('frontend.findUniversity');
    }

        public function universityDetails()
    {
        return view('frontend.universityDetail');
    }

            public function upcomingEvents()
    {
        return view('frontend.upcomingEvent');
    }
}