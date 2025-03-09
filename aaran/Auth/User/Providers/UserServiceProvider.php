<?php

namespace Aaran\Auth\User\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Aaran\Auth\User\Http\Middleware\EnsurePermission;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Repositories\UserRepository::class, Repositories\UserRepositoryEloquent::class);
        $this->app->bind(Repositories\RoleRepository::class, Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(Repositories\PermissionRepository::class, Repositories\PermissionRepositoryEloquent::class);

        $this->mergeConfigFrom(__DIR__.'/Config/user.php', 'user');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        if (Schema::hasTable('users')) {
            $this->callSeeders();
        }

        $this->loadViewsFrom(__DIR__.'/Views', 'user');

        $this->publishes([
            __DIR__.'/Config/user.php' => config_path('user.php'),
        ], 'user-config');

        app('router')->aliasMiddleware('user.permission', EnsurePermission::class);
    }

    protected function callSeeders()
    {
        $this->app[\Illuminate\Database\Console\Seeds\Seeder::class]->call([
            \Aaran\Auth\User\Database\Seeders\RoleSeeder::class,
            \Aaran\Auth\User\Database\Seeders\PermissionSeeder::class,
            \Aaran\Auth\User\Database\Seeders\UserSeeder::class,
        ]);
    }
}
