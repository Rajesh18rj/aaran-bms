<?php

namespace Aaran\Assets\Trait;

use Illuminate\Support\Collection;
use Livewire\Component;

abstract class ItemLookupAbstract extends Component
{
    public string $searches = '';
    public string $id = '';
    public Collection $list;
    public int $selectHighlight = 0;


    public function setObj($name, $id): void
    {
        $this->id = $id;
        $this->searches = $name;
        $this->getList();
        $this->dispatchObj();
    }

    public function selectObj(): void
    {
        $obj = $this->list[$this->selectHighlight] ?? null;
        $this->resetEmpty();
        $this->searches = $obj['vname'] ?? '';;
        $this->id = $obj['id'] ?? '';;
        $this->dispatchObj();
    }

    public function resetEmpty(): void
    {
        $this->searches = '';
        $this->list = Collection::empty();
        $this->selectHighlight = 0;
    }

    public function incrementHighlight(): void
    {
        if ($this->selectHighlight === count($this->list) - 1) {
            $this->selectHighlight = 0;
            return;
        }
        $this->selectHighlight++;
    }

    public function decrementHighlight(): void
    {
        if ($this->selectHighlight === 0) {
            $this->selectHighlight = count($this->list) - 1;
            return;
        }
        $this->selectHighlight--;
    }

    public function getList()
    {
    }

    public function refreshObj($v): void
    {
    }

    public function dispatchObj()
    {

    }
}
