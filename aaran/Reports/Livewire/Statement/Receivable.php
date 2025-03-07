<?php

namespace App\Livewire\Reports\Statement;

use Aaran\Master\Models\Contact;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Receivable extends Component
{

    use CommonTraitNew;

    public function getList()
    {
        return Contact::where('contact_type_id', '124')->get();
    }

    public function render()
    {
        return view('livewire.reports.statement.receivable')->with([
            'list' => $this->getList(),
        ]);
    }
}
