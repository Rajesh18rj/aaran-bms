<?php

namespace Aaran\Books\Livewire\ledgerGroup;

use Aaran\Books\Models\AccountHeads;
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
            $LedgerGroup = new LedgerGroup();
            $extraFields = [
                'account_head_id' => $this->account_head_id ?: '1',
                'description' => $this->description,
                'opening' => $this->opening,
                'opening_date' => $this->opening_date,
                'current' => $this->current,
                'user_id' => auth()->id(),
            ];
            $this->common->save($LedgerGroup, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $LedgerGroup = LedgerGroup::find($this->common->vid);
            $extraFields = [
                'account_head_id' => $this->account_head_id ?: '1',
                'description' => $this->description,
                'opening' => $this->opening,
                'opening_date' => $this->opening_date,
                'current' => $this->current,
                'user_id' => auth()->id(),
            ];
            $this->common->edit($LedgerGroup, $extraFields);
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $LedgerGroup = LedgerGroup::find($id);
            $this->common->vid = $LedgerGroup->id;
            $this->common->vname = $LedgerGroup->vname;
            $this->account_head_id = $LedgerGroup->account_head_id;
            $this->account_name = $LedgerGroup->account_name;
            $this->description = $LedgerGroup->description;
            $this->opening = $LedgerGroup->opening;
            $this->opening_date = $LedgerGroup->opening_date;
            $this->current = $LedgerGroup->current;
            $this->common->active_id = $LedgerGroup->active_id;
            return $LedgerGroup;
        }
        return null;
    }
    #endregion

    #region[account]

    public $account_head_id = '';
    public $account_name = '';
    public Collection $accountCollection;
    public $highlightAccount = 0;
    public $accountTyped = false;

    public function decrementAccount(): void
    {
        if ($this->highlightAccount === 0) {
            $this->highlightAccount = count($this->accountCollection) - 1;
            return;
        }
        $this->highlightAccount--;
    }

    public function incrementAccount(): void
    {
        if ($this->highlightAccount === count($this->accountCollection) - 1) {
            $this->highlightAccount = 0;
            return;
        }
        $this->highlightAccount++;
    }

    public function setAccount($name, $id): void
    {
        $this->account_name = $name;
        $this->account_head_id = $id;
        $this->getAccountList();
    }

    public function enterAccount(): void
    {
        $obj = $this->accountCollection[$this->highlightAccount] ?? null;

        $this->account_name = '';
        $this->accountCollection = Collection::empty();
        $this->highlightAccount = 0;

        $this->account_name = $obj['vname'] ?? '';
        $this->account_head_id = $obj['id'] ?? '';
    }

    #[On('refresh-Account')]
    public function refreshAccount($v): void
    {
        $this->account_head_id = $v['id'];
        $this->account_name = $v['name'];
        $this->accountTyped = false;
    }

    public function getAccountList(): void
    {
        $this->accountCollection = $this->account_name ? AccountHeads::search(trim($this->account_name))
            ->get() : AccountHeads::all();
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->account_head_id = '';
        $this->account_name = '';
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
            $obj = LedgerGroup::find($id);
            if ($obj) {
                $obj->delete();
                $message = "Deleted Successfully";
                $this->dispatch('notify', ...['type' => 'success', 'content' => $message]);
            }
        }
    }
    #endregion

    #region[Clear Fields]
    public function render()
    {
        $this->getAccountList();
        return view('books::ledgerGroup.index')->with([
            'list' => $this->getListForm->getList(LedgerGroup::class)
        ]);
    }
    #endregion
}
