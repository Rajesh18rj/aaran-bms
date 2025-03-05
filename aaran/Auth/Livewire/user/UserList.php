<?php

namespace Aaran\Auth\Livewire\user;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserList extends Component
{
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('auth::user.user-list')->with([
            'List'=>User::all()
        ]);
    }

}
