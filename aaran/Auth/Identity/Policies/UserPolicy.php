<?php

namespace Aaran\Auth\Identity\Policies;

use Aaran\Auth\Identity\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermission('view_users');
    }

    public function create(User $user)
    {
        return $user->hasPermission('create_users');
    }

    public function update(User $user)
    {
        return $user->hasPermission('update_users');
    }

    public function delete(User $user)
    {
        return $user->hasPermission('delete_users');
    }
}
