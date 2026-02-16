<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Admin Dashboard';
         $totalAthletes = User::where('role_id', 5)->count();
        $totalMentors = User::where('role_id', 4)->count();

        return view('admin.index', compact('pageTitle','totalAthletes','totalMentors'));
    }
}
