<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profilemenu extends Component
{

    public function logout()
    {
        // Log out the user
        Auth::logout();
        session()->regenerate();
        $this->redirect('/', navigate: true);

    }
    public function render()
    {
        return view('livewire.profilemenu');
    }
}
