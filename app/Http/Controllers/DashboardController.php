<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\JoinedEvent;
use App\Models\Timesheet;
use App\Models\User;
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

    public function certificates()
    {
        $templates = [
            ['key' => 'template_1', 'name' => 'Template 1'],
            ['key' => 'template_2', 'name' => 'Template 2'],

        ];
        return view('dashboard.certificates', compact('templates'));
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

    public function attendees($event_id)
    {

        $event = Event::find(decrypt($event_id));

        $logs = Timesheet::where('event_id', $event->id)->get();

        $participants = [];  // Array to hold participant details
        foreach ($logs as $item) {
            $user = User::where('id', $item->participant_id)->first();

            array_push($participants, [  // Use $participants instead of $participant
                'participant_name' =>  $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . ' ' . $user->name_ext,
                'participant_role' => $user->role,
                'participant_org' => $user->org_code,
                'participant_unit_no' => $user->unit_no,
                'participant_email' => $user->email,
                'participant_gender' => $user->gender,
                'time_in' => $item->time_in,
                'created_at' => $item->created_at,

            ]);
        }

        $utilization = 0;
        if (sizeof($logs) > 0 && $event->no_of_participants > 0) {
            // Ensure proper type casting for both sides of the division
            $utilization = round((sizeof($logs) / $event->no_of_participants) * 100, 2);
        } else {
            $utilization = 0; // Handle case where there are no logs or no participants
        }


        return view('dashboard.attendees', compact('event', 'participants', 'utilization'));
    }
}
