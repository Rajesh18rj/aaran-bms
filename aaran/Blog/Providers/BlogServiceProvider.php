<?php

namespace Aaran\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Aaran\Blog\Livewire\blog;


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
        Livewire::component('blog::blog-index', blog\Index::class);
        Livewire::component('blog::blog-Category', blog\Category::class);
        Livewire::component('blog::blog-tag', blog\Tag::class);
        Livewire::component('blog::blog-show', blog\Show::class);



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
