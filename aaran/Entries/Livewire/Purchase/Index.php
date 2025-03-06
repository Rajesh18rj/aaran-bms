<?php

namespace Aaran\Entries\Livewire\Purchase;

use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Entries\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use CommonTraitNew;
    use WithPagination;

//    public $log;

    #region[create]
    public function create(): void
    {
        $this->redirect(route('purchase.upsert', ['0']));
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Purchase::find($id);
            $this->common->vid = $obj->id;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[trashData]
    public function trashData(): void
    {
        $obj = $this->getObj($this->common->vid);
        DB::table('purchaseitems')->where('purchase_id', '=', $this->common->vid)->delete();
        $obj->delete();
        $this->showDeleteModal = false;
        $message = "Deleted Successfully";
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message]);
    }
    #endregion

    public $purchasesAllLogs;

//    public function getPurchasesLog()
//    {
//        $this->purchasesAllLogs = Logbook::where('model_name', 'Purchase')->take(8)->get();
//    }

    #region[Render]
    public function render()
    {
//        $this->getPurchasesLog();
//        $this->log = Logbook::where('vname','Purchase')->take(5)->get();
        $this->getListForm->searchField = 'purchase_no';
        $this->getListForm->sortField = 'purchase_no';
        return view('entries::Purchase.index')->with([
            'list' => $this->getListForm->getList(Purchase::class, function ($query) {
                return $query->where('company_id', '=', session()->get('company_id'))->where('acyear',session()->get('acyear'));
            }),
//            'log' => $this->log,
        ]);
    }
    #endregion
}
