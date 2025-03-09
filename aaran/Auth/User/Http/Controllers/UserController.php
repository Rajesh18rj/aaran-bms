<?php

namespace Aaran\Auth\User\Http\Controllers;

use Aaran\Auth\User\Services\UserService;
use Aaran\Auth\User\Http\Requests\StoreUserRequest;
use Aaran\Auth\User\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->userService->getAllUsers());
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        return response()->json($this->userService->createUser($request->validated()), 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->userService->getUserById($id));
    }

    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        return response()->json($this->userService->updateUser($id, $request->validated()));
    }

    public function destroy($id): JsonResponse
    {
        $this->userService->deleteUser($id);
        return response()->json(['message' => 'User deleted successfully.']);
    }
}
