<?php

namespace Aaran\Assets\Trait;

use Livewire\Component;
use Livewire\WithPagination;

abstract class EntriesIndexAbstract extends Component
{
    use WithPagination;
    public bool $showFilters = false;

    public bool $sortAsc = true;
    public string $perPage = "100";
    public string $activeRecord = "1";

    public string $searches = "";
    public string $sortField = 'vno';

    public function toggleShowFilters(): void
    {
        $this->showFilters = !$this->showFilters;
    }

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }
}
