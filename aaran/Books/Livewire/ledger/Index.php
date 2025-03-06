<?php

namespace Aaran\Books\Livewire\ledger;

use Aaran\Books\Models\Ledger;
use Aaran\Books\Models\LedgerGroup;
use Aaran\Assets\Trait\CommonTraitNew;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{

    use CommonTraitNew;
    #region[property]
    public $description;
    public $opening;
    public $opening_date;
    public $current;
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $Ledger = new Ledger();
            $extraFields = [
                'ledger_group_id' => $this->ledger_group_id ?: '1',
                'description' => $this->description,
                'opening' => $this->opening,
                'opening_date' => $this->opening_date,
                'current' => $this->current,
                'user_id' => auth()->id(),
            ];
            $this->common->save($Ledger, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $Ledger = Ledger::find($this->common->vid);
            $extraFields = [
                'ledger_group_id' => $this->ledger_group_id ?: '1',
                'description' => $this->description,
                'opening' => $this->opening,
                'opening_date' => $this->opening_date,
                'current' => $this->current,
                'user_id' => auth()->id(),
            ];
            $this->common->edit($Ledger, $extraFields);
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[ledger]

    public $ledger_group_id = '';
    public $ledger_name = '';
    public Collection $ledgerCollection;
    public $highlightLedger = 0;
    public $ledgerTyped = false;

    public function decrementLedger(): void
    {
        if ($this->highlightLedger === 0) {
            $this->highlightLedger = count($this->ledgerCollection) - 1;
            return;
        }
        $this->highlightLedger--;
    }

    public function incrementLedger(): void
    {
        if ($this->highlightLedger === count($this->ledgerCollection) - 1) {
            $this->highlightLedger = 0;
            return;
        }
        $this->highlightLedger++;
    }

    public function setLedger($name, $id): void
    {
        $this->ledger_name = $name;
        $this->ledger_group_id = $id;
        $this->getLedgerList();
    }

    public function enterLedger(): void
    {
        $obj = $this->ledgerCollection[$this->highlightLedger] ?? null;

        $this->ledger_name = '';
        $this->ledgerCollection = Collection::empty();
        $this->highlightLedger = 0;

        $this->ledger_name = $obj['vname'] ?? '';
        $this->ledger_group_id = $obj['id'] ?? '';
    }

    #[On('refresh-Ledger')]
    public function refreshLedger($v): void
    {
        $this->ledger_group_id = $v['id'];
        $this->ledger_name = $v['name'];
        $this->ledgerTyped = false;
    }

    public function getLedgerList(): void
    {
        $this->ledgerCollection = $this->ledger_name ? LedgerGroup::search(trim($this->ledger_name))
            ->get() : LedgerGroup::all();
    }
#endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $Ledger = Ledger::find($id);
            $this->common->vid = $Ledger->id;
            $this->common->vname = $Ledger->vname;
            $this->ledger_group_id = $Ledger->ledger_group_id;
            $this->ledger_name = $Ledger->ledger_name;
            $this->description = $Ledger->description;
            $this->opening = $Ledger->opening;
            $this->opening_date = $Ledger->opening_date;
            $this->current = $Ledger->current;
            $this->common->active_id = $Ledger->active_id;
            return $Ledger;
        }
        return null;
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->ledger_group_id = '';
        $this->ledger_name = '';
        $this->description = '';
        $this->opening = '';
        $this->opening_date = Carbon::now()->format('Y-m-d');
        $this->current = '';
        $this->common->active_id = '1';
    }
    #endregion

    #region[delete]
    public function deleteFunction($id): void
    {
        if ($id) {
            $obj = Ledger::find($id);
            if ($obj) {
                $obj->delete();
                $message = "Deleted Successfully";
                $this->dispatch('notify', ...['type' => 'success', 'content' => $message]);
            }
        }
    }
    #endregion

    #region[account]
    public function render()
    {
        $this->getLedgerList();
        return view('books::ledger.index')->with([
            'list' => $this->getListForm->getList(Ledger::class),

        ]);
    }
}
