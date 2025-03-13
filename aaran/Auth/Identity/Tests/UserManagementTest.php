<?php

namespace Aaran\Auth\Identity\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use Aaran\Auth\Identity\Models\User;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_creation()
    {
        $user = User::factory()->create();
        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }


    public function test_user_creation_fails_with_missing_fields()
    {
        $response = $this->post('/register', []);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

}
