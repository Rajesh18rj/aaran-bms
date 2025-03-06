<?php

namespace Aaran\Books\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Aaran\Books\Livewire\accountHead;
use Aaran\Books\Livewire\ledgerGroup;
use Aaran\Books\Livewire\ledger;

class BooksServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Books';
    protected string $moduleNameLower = 'books';

    public function register(): void
    {
        $this->app->register(BooksRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();
//        $this->mapApiRoutes();
//        $this->mapWebRoutes();

        // Register Livewire components
        Livewire::component('books::accountHead', accountHead\Index::class);
        Livewire::component('books::ledger-group', ledgerGroup\Index::class);
        Livewire::component('books::ledger', ledger\Index::class);


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
//
//    protected function mapWebRoutes()
//    {
//        Route::middleware('web')
//            ->prefix($this->moduleNameLower)
//            ->namespace("Modules\\{$this->moduleName}\\Http\\Controllers")
//            ->group(__DIR__ . '/../Routes/web.php');
//    }
//
//    protected function mapApiRoutes()
//    {
//        Route::prefix('api')
//            ->middleware('api')
//            ->namespace("Modules\\{$this->moduleName}\\Http\\Controllers")
//            ->group(__DIR__ . '/../Routes/api.php'); // Optional API routes
//    }

}
