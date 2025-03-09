<?php

namespace Aaran\Auth\User\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

beforeEach(function () {
    $this->withoutExceptionHandling(); // Show full error messages
    $this->app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
});

uses(TestCase::class, RefreshDatabase::class);



test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = Volt::test('auth.register')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});


it('can register a new user', function () {

    $response = Volt::test('auth.register')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register');

    dd($response->json());

    $response->assertRedirect('/dashboard');
    $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
})->group('auth');

