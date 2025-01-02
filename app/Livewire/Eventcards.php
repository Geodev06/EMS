<?php

namespace App\Livewire;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Eventcards extends Component
{
    use WithPagination;

    #[On('edit')]
    public function edit($id)
    {
        $this->redirect('/event-form/' . encrypt($id), true);
    }
    #[On('view_attendees')]
    public function view_attendees($id)
    {
        $this->redirect('/attendees/' . encrypt($id));
    }
    public function render()
    {
        $events = Event::where('created_by', Auth::user()->id)
            ->orderBy('created_at', 'desc')->get();
        return view('livewire.eventcards', compact('events'));
    }
}
