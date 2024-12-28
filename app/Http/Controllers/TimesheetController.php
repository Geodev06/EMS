<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\JoinedEvent;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TimesheetController extends Controller
{
    public function time_sheet($encrypted)
    {
        $id = decrypt($encrypted);

        return view('dashboard.timesheet', compact('id'));
    }

    public function time_in(Request $request)
    {

        $event = Event::where('id', $request->event_id)->first();


        if (!$event) {
            return response()->json('You are not allowed to join this event please contact the organizer.', 403);
        }
        $joined_event = JoinedEvent::where('event_id', $request->event_id)
            ->where('created_by', $request->participant_id)
            ->first();

        if (!$joined_event) {
            return response()->json('You are not allowed to join this event please contact the organizer.', 403);
        }

        $timesheet = Timesheet::where('participant_id', $request->participant_id)->first();

        if ($timesheet) {
            $user = User::find($request->participant_id);

            return response()->json([
                'msg' => $request->unit_no . ' - Successfully Time in',
                'name' => $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . ' ' . $user->name_ext,
                'role' =>  $user->role,
                'org_code' =>  $user->org_code,
                'created_at' => \Carbon\Carbon::parse($timesheet->created_at)->format('F d, Y'), // January 01, 2024
                'time_in' => \Carbon\Carbon::parse($timesheet->time_in)->format('g:i a'), // 12:30 pm

            ], 200);
        } else {

            try {
                DB::beginTransaction();
                Timesheet::create([
                    'event_id' => $request->event_id,
                    'participant_id' => $request->participant_id,
                    'time_in' => now()->format('H:i:s')
                ]);
                DB::commit();

                $user = User::find($request->participant_id);

                return response()->json([
                    'msg' => $request->unit_no . ' - Successfully Time in',
                    'name' => $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . ' ' . $user->name_ext,
                    'role' =>  $user->role,
                    'org_code' =>  $user->org_code,
                    'created_at' => \Carbon\Carbon::parse($timesheet->created_at)->format('F d, Y'), // January 01, 2024
                    'time_in' => \Carbon\Carbon::parse($timesheet->time_in)->format('g:i a'), // 12:30 pm

                ], 200);
            } catch (\Throwable $th) {
                DB::rollBack();
                Log::error($th->getMessage());
                return response()->json($th->getMessage(), 500);
            }
        }
    }
}
