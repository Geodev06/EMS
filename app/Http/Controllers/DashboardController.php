<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('dashboard.dashboard_index');
    }

    public function organizer()
    {
        return view('dashboard.organizer');
    }
    public function events()
    {
        return view('dashboard.events');
    }
}
