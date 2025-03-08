<?php

namespace App\Livewire\Reports\Statement;

use Aaran\Master\Models\Contact;
use App\Livewire\Trait\CommonTraitNew;
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
        return view('livewire.reports.statement.payable')->with([
            'list' => $this->getList(),
        ]);
    }
}
