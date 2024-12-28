<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\JoinedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function profile()
    {
        return view('dashboard.profile');
    }

    public function event_form($id = null)
    {
        return view('dashboard.form.event_form', compact('id'));
    }

    public function joined_events()
    {
        // Get the event_ids from the joined events for the authenticated user
        $joined_events = JoinedEvent::where('created_by', Auth::user()->id)->get(['event_id']);

        // Extract event_id values into an array
        $event_ids = $joined_events->pluck('event_id')->toArray();

        // Use the whereIn method to filter by event_ids
        $events = Event::whereIn('id', $event_ids)->paginate(10);

        return view('dashboard.joined_events', compact('events'));
    }
}
