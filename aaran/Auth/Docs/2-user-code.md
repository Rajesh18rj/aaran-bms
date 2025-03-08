<?php

namespace Aaran\Auth\User;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Aaran\Auth\User\Http\Middleware\EnsureUserHasPermission;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register repositories and services
        $this->app->bind(Repositories\UserRepository::class, Repositories\UserRepositoryEloquent::class);
        $this->app->bind(Repositories\RoleRepository::class, Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(Repositories\PermissionRepository::class, Repositories\PermissionRepositoryEloquent::class);

        // Merge configuration
        $this->mergeConfigFrom(__DIR__.'/Config/user.php', 'user');
    }

    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        
        // Load seeders
        if (Schema::hasTable('users')) {
            $this->callSeeders();
        }
        
        // Load views
        $this->loadViewsFrom(__DIR__.'/Views', 'user');
        
        // Publish config
        $this->publishes([
            __DIR__.'/Config/user.php' => config_path('user.php'),
        ], 'user-config');

        // Register Middleware
        app('router')->aliasMiddleware('user.permission', EnsureUserHasPermission::class);
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

// Models
namespace Aaran\Auth\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;
    
    protected $fillable = ['name', 'email', 'password'];
}

class Role extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
}

class Permission extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
}

// Repository
namespace Aaran\Auth\User\Repositories;

interface UserRepository
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}

class UserRepositoryEloquent implements UserRepository
{
    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }
}

// Policy
namespace Aaran\Auth\User\Policies;

use Aaran\Auth\User\Models\User;

class UserPolicy
{
    public function view(User $user, User $model)
    {
        return $user->hasPermission('view-user');
    }

    public function update(User $user, User $model)
    {
        return $user->hasPermission('edit-user');
    }
}

// Requests
namespace Aaran\Auth\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ];
    }
}

// Controllers
namespace Aaran\Auth\User\Http\Controllers;

use Aaran\Auth\User\Models\User;
use Aaran\Auth\User\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(UserRequest $request)
    {
        return response()->json(User::create($request->validated()));
    }
}

// Routes
namespace Aaran\Auth\User\Routes;

use Illuminate\Support\Facades\Route;
use Aaran\Auth\User\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
});

// Blade View
// resources/views/user-form.blade.php
@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Create User</button>
</form>
@endsection
