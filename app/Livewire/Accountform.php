<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Accountform extends Component
{

    public $first_name, $last_name, $middle_name, $name_ext, $gender, $unit_no, $email, $age, $active_flag;
    public $id;


    public function reset_fields()
    {
        $this->first_name = '';
        $this->middle_name = '';
        $this->last_name = '';
        $this->gender = '';
        $this->unit_no = '';
        $this->email = '';
        $this->age = '';
        $this->id = '';
        $this->active_flag = '';
    }

    #[On('edit')]
    public function edit($id)
    {
        if ($id) {

            $user = User::where('id', $id)->first();

            if ($user) {
                $this->id = $id;
                $this->first_name = $user->first_name;
                $this->middle_name = $user->middle_name;
                $this->last_name = $user->last_name;
                $this->name_ext = $user->name_ext;
                $this->gender = $user->gender;
                $this->age = $user->age;
                $this->unit_no = $user->unit_no;
                $this->email = $user->email;
                $this->active_flag = $user->active_flag;
            }
        }
    }

    public function submit()
    {
        $validated = $this->validate([
            'first_name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'last_name' => 'required|max:255',
            'name_ext' => 'nullable|max:255',
            'gender' => 'required',
            'active_flag' => 'required',
            'unit_no' => [
                'required',
                $this->id ? 'unique:users,unit_no,' . $this->id : 'unique:users,unit_no',
                'max:255'
            ],
            'age' => 'required|integer|max:100',
            'email' => [
                'required',
                'email',
                $this->id ? 'unique:users,email,' . $this->id : 'unique:users,email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@(lspu.edu.ph)$/',
            ]
        ], [
            'email.regex' => 'Email domain should be lspu.edu.ph'
        ]);

        try {
            DB::beginTransaction();

            $validated['role'] = 'ORGANIZER';
            $validated['password'] = Hash::make($validated['unit_no']);

            if (!$this->id) {
                User::create($validated);
                $this->reset_fields();
                $this->dispatch('response', 'Organizer account has been created!');
            }

            if ($this->id) {
                // Find the user
                $user = User::find($this->id);

                // Make sure the user exists
                if ($user) {
                    // Update the fields, Laravel will apply the encryption automatically
                    $user->update($validated);

                    // Reset fields after update
                    $this->reset_fields();

                    // Dispatch success message
                    $this->dispatch('response', 'Organizer account has been updated!');
                } else {
                    // Handle case if user not found
                    $this->dispatch('response', 'User not found!');
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('response_err', $th->getMessage());
            Log::error($th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.accountform');
    }
}
