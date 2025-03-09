<?php

namespace Aaran\Auth\User\Policies;

use Aaran\Auth\User\Models\User;

class UserPolicy
{
    public function view(User $authUser, User $user)
    {
        return $authUser->hasPermission('view_users');
    }

    public function create(User $authUser)
    {
        return $authUser->hasPermission('create_users');
    }

    public function update(User $authUser, User $user)
    {
        return $authUser->hasPermission('edit_users');
    }

    public function delete(User $authUser, User $user)
    {
        return $authUser->hasPermission('delete_users');
    }
}
