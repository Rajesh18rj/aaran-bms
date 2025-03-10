<?php

namespace Aaran\Auth\Identity\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Aaran\Auth\Identity\Repositories\UserRepository;
use Aaran\Auth\Identity\Services\UserService;
use Aaran\Auth\Identity\Models\User;
use Aaran\Auth\Identity\Policies\UserPolicy;
use Aaran\Auth\Identity\Events\UserCreated;
use Aaran\Auth\Identity\Listeners\SendUserWelcomeEmail;

class IdentityServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    public function register()
    {
        // Bind Repository & Service to the Service Container
        $this->app->singleton(UserRepository::class, fn($app) => new UserRepository());
        $this->app->singleton(UserService::class, fn($app) => new UserService($app->make(UserRepository::class)));
    }

    public function boot()
    {
        $this->registerPolicies();
        $this->registerGates();
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerViews();
        $this->registerRateLimiting();
        $this->registerEventListeners();
    }

    private function registerPolicies()
    {
        Gate::policy(User::class, UserPolicy::class);
    }

    private function registerGates()
    {
        Gate::define('add-user', function (User $user) {
            return $user->hasPermission('add-user');
        });

        Gate::define('edit-user', function (User $user) {
            return $user->hasPermission('edit-user');
        });

        Gate::define('delete-user', function (User $user) {
            return $user->hasPermission('delete-user');
        });
    }

    private function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
    }

    private function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    private function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../Livewire/Views', 'identity');
    }

    private function registerRateLimiting()
    {
        RateLimiter::for('user-actions', function (Request $request) {
            return $request->user()
                ? Limit::perMinute(30)->by($request->user()->id)
                : Limit::perMinute(10)->by($request->ip());
        });
    }

    private function registerEventListeners()
    {
        Event::listen(UserCreated::class, SendUserWelcomeEmail::class);
    }
}
