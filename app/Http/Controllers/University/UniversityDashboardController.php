<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;

class UniversityDashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'University Dashboard';
        return view('university.index', compact('pageTitle'));
    }
}
