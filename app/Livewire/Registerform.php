<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Registerform extends Component
{

    public $first_name, $last_name, $email, $password;

    public function submit()
    {

        $validated = $this->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' =>
            [
                'required',
                'email',
                'unique:users,email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@(lspu.edu.ph)$/',
            ],
            'password' => 'required|min:8|max:255'
        ], [
            'email.regex' => 'Email domain should be lspu.edu.ph'
        ]);

        try {
            DB::beginTransaction();

            $validated['password'] = Hash::make($validated['password']);
            User::create($validated);

            $this->dispatch('response', 'Account has been successfully created!');

            DB::commit();

            $this->first_name = '';
            $this->last_name = '';
            $this->email = '';
            $this->password = '';
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            $this->dispatch('response', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.registerform');
    }
}
