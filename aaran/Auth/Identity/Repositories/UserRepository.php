<?php

namespace Aaran\Auth\Identity\Repositories;

use Aaran\Auth\Identity\Models\User;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    // Get all users with optional filters
    public function all($filters = [])
    {
        return $this->model->when(isset($filters['search']), function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%');
        })
            ->paginate($filters['per_page'] ?? 15);
    }

    // Find user by ID
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    // Create a new user
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // Update an existing user
    public function update($id, array $data)
    {
        $user = $this->find($id);

        if (isset($data['profile_photo'])) {
            $this->deleteOldProfilePhoto($user);
            $data['profile_photo'] = $this->storeProfilePhoto($data['profile_photo']);
        }

        $user->update($data);
        return $user;
    }

    // Delete a user
    public function delete($id)
    {
        $user = $this->find($id);
        $this->deleteOldProfilePhoto($user);
        return $user->delete();
    }

    // Store user profile photo
    private function storeProfilePhoto($photo)
    {
        return $photo->store('profile-photos', 'public');
    }

    // Delete old profile photo
    private function deleteOldProfilePhoto($user)
    {
        if ($user->profile_photo && Storage::exists($user->profile_photo)) {
            Storage::delete($user->profile_photo);
        }
    }
}
