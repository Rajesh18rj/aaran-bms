<?php

namespace Aaran\Auth\Identity\Livewire\Class;

use Aaran\Auth\Identity\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserForm extends Component
{
    public $userId, $name, $email, $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'nullable|min:6',
    ];


    public function loadUser($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function saveUser()
    {
        $this->validate();

        $user = User::updateOrCreate(
            ['id' => $this->userId],
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password ? Hash::make($this->password) : User::find($this->userId)->password,
            ]
        );

        session()->flash('success', 'User saved successfully.');
        $this->reset();
        $this->dispatch('userUpdated');
    }

    public function render()
    {
        return view('identity::user-form');
    }
}
