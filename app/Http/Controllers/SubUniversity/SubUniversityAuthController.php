<?php

namespace App\Http\Controllers\SubUniversity;

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

class SubUniversityAuthController extends Controller
{
    public function loginView()
    {
        return view('subUniversity.auth.login');
    }
}