<?php

namespace Aaran\Auth\Providers;

use Aaran\Auth\Livewire\user\UserList;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Livewire\Volt\Volt;

class AuthServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->register(AuthRouteServiceProvider::class);
    }

    public function boot(): void
    {
        Volt::mount([
            base_path("aaran/Auth/Livewire"),
            base_path("aaran/Auth/Livewire")
        ]);

        $this->loadViewsFrom(__DIR__ . '/../Livewire', 'auth');
    }
}
