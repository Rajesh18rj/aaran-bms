<?php

namespace Aaran\Assets\Trait;

use Livewire\WithPagination;

trait CommonTrait
{
    use WithPagination;

    protected $queryString = ['page'];

    public bool $showEditModal = false;
    public bool $showFilters = false;
    public bool $showDeleteModal = false;

    public bool $sortAsc = true;
    public string $perPage = "50";

    public string $searches = "";
    public string $sortField = 'id';
    public string $activeRecord = "1";

    public $vid = '';

    public function toggleShowFilters(): void
    {
        $this->showFilters = !$this->showFilters;
    }

    public function deleteSelect($id): void
    {
        $this->showDeleteModal = true;
        $this->vid = $id;
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

    public function create(): void
    {
        $this->clearFields();
        $this->showEditModal = true;
    }

    public function resetFilters()
    {
        $this->activeRecord='1';
        $this->resetPage();
        $this->showFilters = false;

    }

    public function save(): void
    {
        $message = $this->getSave();
        $this->clearFields();
        $this->showEditModal = false;
    }

    public function edit($id): void
    {
        $this->clearFields();
        $this->getObj($id);
        $this->showEditModal = true;
    }

    public function getDelete($id): void
    {
        if ($id) {
            $this->clearFields();
            $this->getObj($id);
            $this->showDeleteModal = true;
        }
    }

    public function delete(): void
    {

        if ($this->vid) {
            $obj = $this->getObj($this->vid);
            $obj->delete();
            $this->showDeleteModal = false;
            $this->clearFields();
        }
    }
}
