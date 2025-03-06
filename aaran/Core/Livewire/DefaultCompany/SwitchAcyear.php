<?php

namespace Aaran\Core\Livewire\DefaultCompany;

use Aaran\Assets\Enums\Acyear;
use Aaran\Core\Models\DefaultCompany;
use Aaran\Master\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;


class SwitchAcyear extends Component
{
    public mixed $acyear;
    public $years;

    public function changeAcyear(): void
    {
        if ($this->acyear) {
            session()->put('acyear', $this->acyear);

            $obj = DefaultCompany::find(1);
            $obj->acyear = session()->get('acyear');
            $obj->save();
        }
    }

    public function mount(): void
    {
        $defaultAcyear = DefaultCompany::find('1');
        $this->acyear = $defaultAcyear->acyear;
    }

    public function render()
    {
        $this->years= Acyear::cases();

        return view('core::DefaultCompany.switch-acyear');
    }
}
