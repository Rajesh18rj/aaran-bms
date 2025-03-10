<?php

namespace Aaran\Auth\Identity\Http\Controllers;

use Aaran\Auth\Identity\Models\User;
use Aaran\Auth\Identity\Http\Requests\StoreUserRequest;
use Aaran\Auth\Identity\Http\Requests\UpdateUserRequest;
use Aaran\Auth\Identity\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class UserApiController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'users' => $this->userService->getAllUsers(),
        ]);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $this->authorize('create', User::class);
        $user = $this->userService->createUser($request->validated());

        return response()->json([
            'message' => 'User created successfully!',
            'user' => $user
        ], 201);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $this->userService->updateUser($user, $request->validated());
        return response()->json(['message' => 'User updated successfully!']);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->userService->deleteUser($user);
        return response()->json(['message' => 'User deleted successfully!']);
    }
}
