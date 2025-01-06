<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\JoinedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JoinedEventsController extends Controller
{
    public function join(Request $request)
    {
        $validated = $request->validate([
            'event_code' => 'required|max:100'
        ]);

        $event = Event::where('code', $validated['event_code'])->where('status', 'PENDING')->first();

        if (!$event) {
            session()->flash('invalid_code', 'You have entered invalid code. please check your code again or contact your organizer.');
            return redirect()->back();
        }

        if ($event) {

            $no_of_seats = $event->no_of_participants;
            $join_count = JoinedEvent::where('event_code', $validated['event_code'])->count();

            if ($join_count > $no_of_seats) {
                session()->flash('no_available_seats', 'No Avaible slots for you to join this event. please contact your organizer.');
            } else {

                if (
                    JoinedEvent::where('event_code', $validated['event_code'])
                    ->where('created_by', Auth::user()->id)
                    ->count() > 0
                ) {
                    session()->flash('err', 'You have already joined this event.');
                    return redirect()->back();
                }

                try {
                    DB::beginTransaction();
                    JoinedEvent::create([
                        'event_id' => $event->id,
                        'event_code' => $event->code,
                        'created_by' => Auth::user()->id
                    ]);

                    $this->_send_notification($event->created_by, Auth::user()->first_name . ' ' . Auth::user()->last_name . ' has joined your event.');

                    DB::commit();
                    session()->flash('success', 'Successfully joined.');
                    return redirect()->back();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    Log::error($th->getMessage());
                    session()->flash('err', $th->getMessage());
                }
            }
        }
    }
}
