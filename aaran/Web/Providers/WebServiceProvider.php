<?php

namespace Aaran\Web\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

use Aaran\Web\Livewire\Dashboard;
use Aaran\Web\Livewire\Contact;
use Aaran\Web\Livewire\Blog;


class WebServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'web';
    protected string $moduleNameLower = 'web';

    public function register(): void
    {
        $this->app->register(WebRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        Livewire::component('web::index', Dashboard\Index::class);
        Livewire::component('web::index', Contact\Index::class);
        Livewire::component('web::blog.index', Blog\Index::class);
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
