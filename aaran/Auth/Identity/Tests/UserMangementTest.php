<?php

declare(strict_types=1);

use Aaran\Auth\Identity\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, deleteJson};
use Livewire\Livewire;
use Aaran\Auth\Identity\Repositories\UserRepository;
use Aaran\Auth\Identity\Services\UserService;
use Aaran\Auth\Identity\Livewire\Class\UserProfile;
uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);


beforeEach(function () {
    $this->user = User::factory()->create();
});

// Model Tests
it('has correct attributes', function () {
    expect($this->user)->toHaveKeys(['name', 'email', 'password', 'tenant_id']);
});



// Repository Tests
it('can create a user in repository', function () {
    $repo = app(UserRepository::class);
    $user = $repo->create([
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => bcrypt('password'),
    ]);
    expect($user)->toBeInstanceOf(User::class)
        ->and($user->email)->toBe('johndoe@example.com');
});



// Service Tests
it('handles user creation correctly in service', function () {
    $service = app(UserService::class);
    $user = $service->register([
        'name' => 'Jane Doe',
        'email' => 'janedoe@example.com',
        'password' => 'securepassword',
    ]);
    expect($user)->toBeInstanceOf(User::class)
        ->and($user->email)->toBe('janedoe@example.com');
});


// Authorization Tests
it('prevents unauthorized access', function () {
    getJson('/api/protected-route')->assertStatus(401);
});


// Validation Tests
it('fails with invalid user data', function () {
    postJson('/api/users', [
        'name' => '',
        'email' => 'invalid-email',
        'password' => '123',
    ])->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'email', 'password']);
});


// API Tests
it('can create a new user via API', function () {
    postJson('/api/users', [
        'name' => 'Valid User',
        'email' => 'validuser@example.com',
        'password' => 'securepassword',
    ])->assertStatus(201)
        ->assertJsonPath('email', 'validuser@example.com');
});

it('can update user profile via API', function () {
    putJson('/api/users/'.$this->user->id, [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
    ])->assertStatus(200)
        ->assertJsonPath('name', 'Updated Name');
});

it('can delete a user via API', function () {
    deleteJson('/api/users/'.$this->user->id)->assertStatus(204);
    expect(User::find($this->user->id))->toBeNull();
});

it('handles password reset request', function () {
    postJson('/api/password/email', ['email' => $this->user->email])->assertStatus(200);
});



// Livewire Tests
it('renders UserProfile component correctly', function () {
    Livewire::test(UserProfile::class)->assertStatus(200);
});



// Role-Based Access Control (RBAC) Tests
it('prevents unauthorized actions in RBAC', function () {
    postJson('/api/admin-only-action')->assertStatus(403);
});
