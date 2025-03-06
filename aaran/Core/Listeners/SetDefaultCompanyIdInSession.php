<?php

namespace Aaran\Core\Listeners;

use Aaran\Core\Models\DefaultCompany;

class SetDefaultCompanyIdInSession
{
    public function handle(): void
    {

     if ($defaultCompany = DefaultCompany::find(1)) {
         session()->put('company_id', $defaultCompany->company_id);
     }
    }
}
