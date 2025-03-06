<?php

namespace Aaran\Core\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetTenantIdInSession
{
    public function __construct()
    {
        //
    }

    public function handle(object $event): void
    {
        session()->put('tenant_id', $event->user->tenant_id);
        session()->put('role_id', $event->user->role_id);

    }
}
