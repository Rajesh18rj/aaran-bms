<?php

namespace Aaran\Auth\User\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AuthServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Core';
    protected string $moduleNameLower = 'core';

    public function register(): void
    {
        $this->app->register(AuthRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        Livewire::component('role::index', \Aaran\Auth\User\Livewire\Role\Index::class);
        Livewire::component('users::index', \Aaran\Auth\User\Livewire\Users\Index::class);

    }

    protected function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/auth.php', $this->moduleNameLower);
    }

    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Livewire', $this->moduleNameLower);
    }

    protected function loadMigrations(): void
    {

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
