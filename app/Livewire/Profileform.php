<?php

namespace App\Livewire;

use App\Models\ParamOrganization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Profileform extends Component
{
    public $first_name, $last_name, $middle_name, $name_ext, $gender, $unit_no, $email, $age, $active_flag, $org_code;
    public $id;


    public function mount()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if ($user) {
            $this->id = $user->id;
            $this->first_name = $user->first_name;
            $this->middle_name = $user->middle_name;
            $this->last_name = $user->last_name;
            $this->name_ext = $user->name_ext;
            $this->gender = $user->gender;
            $this->age = $user->age;
            $this->unit_no = $user->unit_no;
            $this->email = $user->email;
            $this->active_flag = $user->active_flag;
            $this->org_code = $user->org_code;

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
            'org_code' => 'required',
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

            if ($this->id) {
                // Find the user
                $user = User::find($this->id);

                if ($user) {
                    // Update the fields, Laravel will apply the encryption automatically
                    $user->update($validated);
                    $this->dispatch('response', 'Changes has been saved!');
                } else {
                    // Handle case if user not found
                    $this->dispatch('response', 'Authentication Error!');
                    Auth::logout();
                    $this->redirect('/');
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
        $org_codes = ParamOrganization::all();
        return view('livewire.profileform', compact('org_codes'));
    }
}
