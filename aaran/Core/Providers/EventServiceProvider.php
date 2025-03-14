<?php

namespace Aaran\Core\Providers;

use Aaran\Core\Listeners\SetDefaultCompanyIdInSession;
use Aaran\Tenant\Listeners\SetTenantIdInSession;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            SetTenantIdInSession::class,
            SetDefaultCompanyIdInSession::class,
        ],
    ];

}
