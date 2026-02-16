<?php

namespace App\Http\Controllers\Athlete;

use App\Http\Controllers\Controller;

class AthleteDashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Athlete Dashboard';
        return view('athlete.index', compact('pageTitle'));
    }
}
