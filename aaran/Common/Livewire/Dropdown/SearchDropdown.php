<?php

namespace Aaran\Common\Livewire\Dropdown;

use Livewire\Component;
use Illuminate\Support\Str;
use Aaran\Common\Models\City;
use Aaran\Common\Models\Country;
use Aaran\Common\Models\State;
use Aaran\Common\Models\Pincode;

class SearchDropdown extends Component
{
    public string $searchQuery = '';
    public string $selectedItem = '';
    public string $label; // City, State, Country, etc.
    public string $model; // Dynamic model name
    public $results = [];

    public function mount($label, $model)
    {
        $this->label = $label;
        $this->model = $model;
    }

    public function updatedSearchQuery()
    {
        $this->results = app("Aaran\\Common\\Models\\" . $this->model)::where('vname', 'like', "%{$this->searchQuery}%")
            ->orderBy('vname')
            ->limit(10)
            ->get();
    }

    public function selectItem($id)
    {
        $item = app("Aaran\\Common\\Models\\" . $this->model)::find($id);
        if ($item) {
            $this->selectedItem = $id;
            $this->searchQuery = $item->vname;
            $this->dispatch('item-selected', $this->selectedItem);
        }
    }

    public function createNewItem($vname)
    {
        if (!empty($vname)) {
            $modelInstance = app("Aaran\\Common\\Models\\" . $this->model)::create(['vname' => Str::ucfirst($vname)]);
            $this->selectItem($modelInstance->id);
        }
    }

    public function render()
    {
        return view('common::Dropdown.Search-dropdown', ['results' => $this->results]);
    }
}
