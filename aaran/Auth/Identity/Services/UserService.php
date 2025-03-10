<?php

namespace Aaran\Auth\Identity\Services;

use Aaran\Auth\Identity\Events\UserCreated;
use Aaran\Auth\Identity\Models\UserLog;
use Aaran\Auth\Identity\Repositories\UserRepository;
use Aaran\Auth\User\Models\Role;
use Aaran\Auth\Identity\Exceptions\ApiException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Get all users with filters
    public function getAllUsers($filters = [])
    {
        return $this->userRepository->all($filters);
    }

    // Get a single user
    public function getUserById($id)
    {
        $user =  $this->userRepository->find($id);
        if (!$user) {
            throw new ApiException("User not found", 404);
        }
        return $user;
    }

    // Create a new user
    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);

        // Assign default role if not provided
        $role = Role::where('name', 'User')->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }


        event(new UserCreated($user));
        return $user;
    }

    // Update user details
    public function updateUser($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user =  $this->userRepository->update($id, $data);
        $this->logAction($user->id, "User Updated");
        return $user;

    }

    // Delete user
    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }

    // Validate and update user password
    public function updatePassword($id, array $data)
    {
        $user = $this->getUserById($id);

        if (!Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages(['current_password' => 'The current password is incorrect.']);
        }

        return $this->updateUser($id, ['password' => $data['new_password']]);
    }


    protected function logAction($userId, $action)
    {
        UserLog::create([
            'user_id' => $userId,
            'action' => $action,
            'ip_address' => request()->ip(),
        ]);
    }

}
