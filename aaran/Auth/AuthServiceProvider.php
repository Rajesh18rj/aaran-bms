<?php

namespace Aaran\Auth;

use Aaran\Auth\Identity\Providers\IdentityServiceProvider;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(IdentityServiceProvider::class);
    }
}
