<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\EvaluationDetail;
use App\Models\Event;
use App\Models\JoinedEvent;
use App\Models\ParamEvalQuestion;
use App\Models\Signatory;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $no_of_users = User::whereIn('role',['PARTICIPANT','ORGANIZER'])->count();
        $my_event_counts = Event::where('created_by', Auth::user()->id)->count();
        $no_of_joined = JoinedEvent::where('created_by', Auth::user()->id)->count();

        $no_of_organizers = User::whereIn('role',['ORGANIZER'])->count();



        return view('dashboard.dashboard_index', compact('no_of_users','my_event_counts','no_of_joined','no_of_organizers'));
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

        // Attach a flag to each event indicating whether the user has already submitted an evaluation for it
        foreach ($events as $event) {
            $has_evaluation = Evaluation::where('event_id', $event->id)
                ->where('user_id', Auth::user()->id)
                ->exists(); // Check if evaluation exists for the event by the authenticated user

            // Attach the flag to the event object
            $event->has_evaluation = $has_evaluation;
        }

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

    public function evaluations()
    {
        $questions = $this->_contruct_eval();
        return view('dashboard.evaluations', compact('questions'));
    }

    public function event_evaluation($id)
    {
        $questions = $this->_contruct_eval();
        return view('dashboard.event_evaluation', compact('questions', 'id'));
    }

    public function submit_evaluation(Request $request)
    {

        // Fetch questions where ratable_flag is 'Y' and active_flag is 'Y'
        $param_questions = ParamEvalQuestion::where('ratable_flag', 'Y')
            ->where('active_flag', 'Y')
            ->get(['id'])  // Fetch only the 'id' field for simplicity
            ->toArray();

        // Create the validation rules and custom messages
        $validationRules = [];
        $validationMessages = [];

        // Loop through each question to create the validation rules and custom messages
        foreach ($param_questions as $question) {
            $questionId = "question_" . $question['id'];

            // Add a validation rule for each question in the format 'question_<id>' => 'required'
            $validationRules[$questionId] = 'required';

            // Add a custom message for each question
            $validationMessages["$questionId.required"] = "This question is required";
        }

        // Optionally, add validation for remarks
        $validationRules['remarks'] = 'required|string|max:500';
        $validationMessages['remarks.required'] = 'Remarks are required';
        $validationMessages['remarks.string'] = 'Remarks must be a string';

        // Validate the data
        $validatedData = $request->validate($validationRules, $validationMessages);


        try {
            DB::beginTransaction();

            $existing_eval = Evaluation::where(
                [
                    'user_id' => Auth::user()->id,
                    'event_id' => decrypt($request->event_id)
                ]
            )->first();

            if ($existing_eval) {
                return response()->json([
                    'message' => 'You have already submit your post evaluation for this event'
                ], 403);
            }
            $evaluation = Evaluation::create([
                'user_id' => Auth::user()->id,
                'event_id' => decrypt($request->event_id),
                'remarks' => $request->remarks
            ]);

            $no_of_questions = count($validatedData) - 1;

            $total_points = 0;
            foreach ($validatedData as $questionId => $value) {

                if (str_contains($questionId, 'question_')) {
                    $questionId = str_replace('question_', '', $questionId);
                    $total_points += intval($value);

                    EvaluationDetail::create([
                        'evaluation_id' => $evaluation['id'],
                        'question_id' => $questionId,
                        'mark' => intval($value),
                    ]);
                }
            }

            Evaluation::find($evaluation['id'])->update(
                ['overall' => $total_points]
            );

            $remarks = $validatedData['remarks'] ?? null;

            DB::commit();

            return response()->json([
                'message' => 'Evaluation submitted successfully',
                'data' => $validatedData
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function certification($id)
    {

        $event = Event::find(decrypt($id));

        if (!$event) {
            echo  'Event Not Found!';
            return;
        }

        return view('dashboard.certification', compact('event'));
    }

    public function render_template(Request $request)
    {
        $view = '';

        $event = Event::find($request->event_id);
        $participant = User::find($request->user_id);
        $signatory = Signatory::where('event_id',$request->event_id)->first();

        switch ($request->template_id) {
            case 1:
                $view = view('renders.template_1', compact('event', 'participant','signatory'))->render();
                break;
            case 2:
                $view = view('renders.template_2', compact('event', 'participant','signatory'))->render();
                break;
            default:
                return response()->json('Template not found', 404);
                break;
        }
        return response()->json($view, 200);
    }
}
