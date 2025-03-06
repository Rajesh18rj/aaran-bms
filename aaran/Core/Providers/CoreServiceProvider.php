<?php

namespace Aaran\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Aaran\Core\Livewire\Role;

use Aaran\Core\Livewire\Tenant;
use Aaran\Core\Livewire\Users;
use Aaran\Core\Livewire\Versions;
use Aaran\Core\Livewire\DefaultCompany;



class CoreServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Core';
    protected string $moduleNameLower = 'core';

    public function register(): void
    {
        $this->app->register(CoreRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        Livewire::component('role::index', Role\Index::class);
        // Register
        Livewire::component('tenant::index', Tenant\Index::class);
        Livewire::component('users::index', Users\Index::class);
        Livewire::component('versions::index', Versions\Index::class);
        Livewire::component('DefaultCompany::Index', DefaultCompany\Index::class);

        Livewire::component('DefaultCompany::SwitchDefaultCompany', DefaultCompany\SwitchDefaultCompany::class);
        Livewire::component('DefaultCompany::SwitchAcyear', DefaultCompany\SwitchAcyear::class);


    }

    protected function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', $this->moduleNameLower);
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
