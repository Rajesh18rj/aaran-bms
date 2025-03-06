<?php

namespace Aaran\Transaction\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class TransactionServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Transaction';
    protected string $moduleNameLower = 'transaction';

    public function register(): void
    {
        $this->app->register(TransactionRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

//        Livewire::component('temp::index', Temp\Index::class);
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
