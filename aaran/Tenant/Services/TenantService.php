<?php

namespace Aaran\Tenant\Services;

use Aaran\Tenant\Models\Tenant;

class TenantService
{
    protected ?Tenant $tenant = null;

    public function setTenant(Tenant $tenant)
    {
        $this->tenant = $tenant;
        session(['tenant_id' => $tenant->id]);
    }

    public function getTenant(): ?Tenant
    {
        return $this->tenant ?? Tenant::find(session('tenant_id'));
    }
}
