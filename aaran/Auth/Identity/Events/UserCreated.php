<?php

namespace Aaran\Auth\Identity\Events;

use Aaran\Auth\Identity\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class UserCreated
{
    use Dispatchable;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createUser(array $data)
    {
        $user = User::create($data);
        event(new UserCreated($user));
        return $user;
    }
}
