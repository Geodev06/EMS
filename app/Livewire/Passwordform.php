<?php

namespace App\Livewire;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Livewire\Component;

class Passwordform extends Component
{

    public $old_password;
    public $password;
    public $password_confirmation;

    // Define validation rules for the password change
    protected $rules = [
        'old_password' => 'required',
        'password' => 'required|min:8|confirmed', // Requires the password to be at least 8 characters long
        'password_confirmation' => 'required|min:8',
    ];

    // Define custom validation messages if needed
    protected $messages = [
        'password.min' => 'Password must be at least 8 characters long.',
        'password_confirmation.required' => 'Please confirm your new password.',
        'password.confirmed' => 'The new password and confirmation password do not match.',
    ];

    public function updated($propertyName)
    {
        // Validate only the updated property
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        // Validate all the fields
        $this->validate();

        // Check if the old password is correct
        if (!Hash::check($this->old_password, Auth::user()->password)) {
            throw ValidationValidationException::withMessages([
                'old_password' => ['The old password is incorrect.']
            ]);
        }

        User::where('id', Auth::user()->id)->update(['password' => Hash::make($this->password)]);

        // Reset the fields
        $this->reset(['old_password', 'password', 'password_confirmation']);

        session()->flash('message', 'Password changed successfully!');
    }

    public function render()
    {
        return view('livewire.passwordform');
    }
}
