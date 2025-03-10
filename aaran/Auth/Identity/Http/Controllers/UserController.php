<?php

namespace Aaran\Auth\Identity\Http\Controllers;

use Aaran\Auth\Identity\Models\User;
use Aaran\Auth\Identity\Http\Requests\StoreUserRequest;
use Aaran\Auth\Identity\Http\Requests\UpdateUserRequest;
use Aaran\Auth\Identity\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = $this->userService->getAllUsers();
        return view('identity::livewire.user-form', compact('users'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->createUser($request->validated());
        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->updateUser($user, $request->validated());
        return redirect()->back()->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}

