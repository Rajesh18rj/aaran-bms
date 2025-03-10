<?php

namespace Aaran\Reports\Livewire\Statement;

use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Master\Models\Contact;
use Livewire\Component;

class Payable extends Component
{
    use CommonTraitNew;

    public function getList()
    {
        return Contact::where('contact_type_id', '123')->get();
    }

    public function render()
    {
        return view('reports::Statement.payable')->with([
            'list' => $this->getList(),
        ]);
    }
}
