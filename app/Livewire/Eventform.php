<?php

namespace App\Livewire;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Eventform extends Component
{

    public $id = null,
        $title,
        $particulars,
        $start_date,
        $start_time,
        $end_date,
        $end_time,
        $reg_start_date,
        $reg_start_time,
        $reg_end_date,
        $reg_end_time,
        $status,
        $certificate_id,
        $participants,
        $no_of_participants;


    public function reset_fields()
    {
        $this->id = null;
        $this->title = '';
        $this->particulars = '';
        $this->start_date = '';
        $this->start_time = '';
        $this->end_date = '';
        $this->end_time = '';
        $this->reg_start_date = '';
        $this->reg_start_time = '';
        $this->reg_end_date = '';
        $this->reg_end_time = '';
        $this->status = '';
        $this->certificate_id = '';
        $this->no_of_participants = '';
    }

    public function mount($id = null)
    {
        if ($id) {
            $event_id = decrypt($id);

            $event = Event::where('id', $event_id)->first();
            if ($event) {
                $this->id = $event_id;
                $this->title = $event->title ?? '';
                $this->particulars = $event->particulars ?? '';
                $this->start_date = $event->start_date ?? '';
                $this->start_time = Carbon::parse($event->start_time)->format('H:i');
                $this->end_date = $event->end_date ?? '';
                $this->end_time = Carbon::parse($event->end_time)->format('H:i');
                $this->reg_start_date = $event->reg_start_date ?? '';
                $this->reg_start_time = Carbon::parse($event->reg_start_time)->format('H:i');
                $this->reg_end_date = $event->reg_end_date ?? '';
                $this->reg_end_time = Carbon::parse($event->reg_end_time)->format('H:i');
                $this->status = $event->status ?? '';
                $this->certificate_id = $event->certificate_id ?? '';
                $this->no_of_participants = $event->no_of_participants ?? '';
            }
        }
    }
    public function submit()
    {


        $validated = $this->validate([
            'title' => 'required|max:255',
            'particulars' => 'nullable|max:500',

            'no_of_participants' => 'required|numeric|min:1|max:9999',

            'start_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'required|date_format:H:i|after:start_time',

            'reg_start_date' => 'required|date|after_or_equal:today',
            'reg_start_time' => 'required|date_format:H:i',
            'reg_end_date' => 'required|date|after_or_equal:reg_start_date',
            'reg_end_time' => 'required|date_format:H:i|after:reg_start_time',

            'certificate_id' => 'required',
            'status' => 'required',

        ]);


        try {
            DB::beginTransaction();

            if (!$this->id) {
                $validated['code'] = $this->generate_code();
                $validated['created_by'] = Auth::user()->id;

                Event::create($validated);
                $this->dispatch('response', 'Event Successfully created!.');
                $this->reset_fields();
            }

            if ($this->id) {
                $evt = Event::find($this->id);
                if ($evt) {
                    $evt->update($validated);
                    $this->dispatch('response', 'Event account has been updated!');
                } else {
                    $this->dispatch('response', 'Event not found!');
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->dispatch('response_err', $th->getMessage());
            DB::rollBack();
        }
    }
    public function render()
    {
        return view('livewire.eventform');
    }
}
