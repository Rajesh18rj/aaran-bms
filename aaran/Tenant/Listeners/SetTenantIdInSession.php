<?php

namespace Aaran\Tenant\Listeners;

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
