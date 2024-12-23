<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Loginform extends Component
{

    public $email, $password;

    public function submit()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required',

        ]);
        // Attempt login with provided email and password
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {

            $this->redirect('/dashboard', navigate: true);
        }

        session()->flash('invalid_cred','Invalid credentials');
    }
    public function render()
    {
        return view('livewire.loginform');
    }
}
