<?php

namespace Aaran\Master\Livewire\Style\Lookup;

use Aaran\Master\Models\Style;
use Livewire\Component;

class StyleModel extends Component
{
    public bool $showModel = false;

    public string $vname = "";
    public string $desc = "";

    public function mount($name)
    {
        $this->vname = $name;
    }

    public function save()
    {
        if ($this->vname != '') {
            $obj = Style::create([
                'vname' => $this->vname,
                'desc' => $this->desc,
                'company_id'=>session()->get('company_id'),
                'active_id' => '1',
            ]);
            $this->dispatch('refresh-style-item', ['name' => $this->vname, 'id' => $obj->id]);
            $this->dispatch('refresh-style', ['name' => $this->vname, 'id' => $obj->id]);
            $this->clearAll();
        }
    }

    public function clearAll()
    {
        $this->showModel = false;
        $this->vname = "";
    }
    public function render()
    {
        return view('master::Style.Lookup.style-model');
    }
}
