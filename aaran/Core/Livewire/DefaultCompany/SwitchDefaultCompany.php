<?php

namespace Aaran\Core\Livewire\DefaultCompany;

use Aaran\Core\Models\DefaultCompany;
use Aaran\Master\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;


class SwitchDefaultCompany extends Component
{
    #region[properties]
    public mixed $defaultCompany;
    public $showEditModal = false;
    public Collection $companies;
    public $tenant_id;

    public string $acyear = '';
    #endregion

    #region[Create]
    public function create(): void
    {
        $this->showEditModal = true;
    }
    #endregion


    #region[get Default]
    public function getDefaultCompany()
    {
        $this->defaultCompany = DefaultCompany::find(1);
//        $soft_version = SoftVersion::latest()->first();

        if ($this->defaultCompany) {
            session()->put('company_id', $this->defaultCompany->company_id);
            session()->put('acyear', $this->defaultCompany->acyear);
//            session()->put('soft_version', $soft_version->soft_version);
        }
    }
    #endregion

    #region[get All]
    public function getAllCompanies(): void
    {
        $this->companies = Company::where('tenant_id', '=', session()->get('tenant_id'))->get();
    }
    #endregion

    #region[Switch]
    public
    function switchCompany($id): void
    {
        $obj = DefaultCompany::find(1);
        $obj->company_id = $id;
        $obj->save();

        session()->put('company_id', 0);

        $this->showEditModal = false;
        $this->js('window.location.reload()');
    }
    #endregion

    #region[Render]
    public function render()
    {
        $this->getAllCompanies();
        $this->getDefaultCompany();
        return view('core::DefaultCompany.switch-default-company');
    }
    #endregion
}
