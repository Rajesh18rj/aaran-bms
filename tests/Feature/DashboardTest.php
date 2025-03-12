<?php

use Aaran\Auth\Identity\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/dashboard');
    $response->assertStatus(200);
});


beforeEach(function () {
    $this->user = User::factory()->create();
});


// Model Tests
it('has correct attributes', function () {
    expect($this->user)->toHaveKeys(['name', 'email', 'password', 'tenant_id']);
});



beforeEach(function () {
    $this->user = User::factory()->create();
});


// Model Tests
it('has correct attributes', function () {
    expect($this->user)->toHaveKeys(['name', 'email', 'password', 'tenant_id']);
});



beforeEach(function () {
    $this->user = User::factory()->create();
});


// Model Tests
it('has correct attributes', function () {
    expect($this->user)->toHaveKeys(['name', 'email', 'password', 'tenant_id']);
});

