<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\JoinedEvent;
use App\Models\Signatory;
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

    public function event_attachtments($event_id)
    {
        $event = Event::find(decrypt($event_id));

        $signatory = Signatory::where('event_id', $event->id)->first();

        return view('dashboard.event_attachtment', compact('event', 'signatory'));
    }
    public function template_preview(Request $request)
    {
        $view = '';

        switch ($request->template) {
            case 'template_1':
                $view = view('templates.template_1')->render();
                break;
            case 'template_2':
                $view = view('templates.template_2')->render();
                break;
            default:
                return response()->json('Template not found', 404);
                break;
        }
        return response()->json($view, 200);
    }

    public function upload_signature(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png|max:2048', // Example validation
        ]);


        $event_signatory = Signatory::where('event_id', $request->event_id)->first();
        if ($event_signatory) {
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $file = $request->file('file');
                // Get the original file name and extension
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Move the file to the public directory (e.g., public/uploads)
                $filePath = public_path('uploads/' . $fileName); // Path to public/uploads directory

                // Store the file in the public/uploads directory
                $file->move(public_path('uploads'), $fileName);


                switch ($request->signatory) {
                    case 1:
                        $event_signatory->update([
                            'signatory_1_img' => 'uploads/' . $fileName
                        ]);
                        break;
                    case 2:
                        $event_signatory->update([
                            'signatory_2_img' => 'uploads/' . $fileName
                        ]);
                        break;
                    case 3:
                        $event_signatory->update([
                            'signatory_3_img' => 'uploads/' . $fileName
                        ]);
                        break;
                    case 4:
                        $event_signatory->update([
                            'signatory_4_img' => 'uploads/' . $fileName
                        ]);
                        break;
                    default:
                        return response()->json([
                            'success' => false,
                            'message' => 'Signatory Not Found!'
                        ], 400);
                        break;
                }
                // Respond with the file path or success message
                return response()->json([
                    'success' => true,
                    'message' => 'File uploaded successfully!',
                    'filePath' => 'uploads/' . $fileName
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'File upload failed!'
            ], 400);
        }

        return response()->json([
            'success' => false,
            'message' => 'Signatory is not set'
        ], 400);
    }
}
