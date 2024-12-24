<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Organizerlist extends Component
{
    use WithPagination;

    public function mount() {}

    #[On('response')]
    public function render()
    {
        $organizers = User::where('role', 'ORGANIZER')->paginate(10);

        return view('livewire.organizerlist', compact('organizers'));
    }
}
