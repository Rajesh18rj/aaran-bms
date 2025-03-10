<?php

namespace Aaran\Auth\Identity\Livewire\Class;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfile extends Component
{
    public function render()
    {
        return view('identity::user-profile', [
            'user' => Auth::user()
        ]);
    }
}
