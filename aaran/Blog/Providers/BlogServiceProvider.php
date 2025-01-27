<?php

namespace Aaran\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class BlogServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Blog';
    protected string $moduleNameLower = 'blog';

    public function register(): void
    {
        $this->app->register(BlogRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        // Register Livewire components
        Livewire::component('blog::blog-tag', blog\blogTag::class);
        Livewire::component('blog::index', exportSales\PackingList::class);
        Livewire::component('blog::show', exportSales\Upsert::class);

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
