<?php

namespace Aaran\Entries\Livewire\Sales;

use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Entries\Models\Sale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use CommonTraitNew;
    use WithPagination;
    public $log;

    public $salesAllLogs;
    #region[create]
    public function create(): void
    {
        ini_set('max_execution_time', 3600);
        $this->redirect(route('sales.upsert', ['0']));
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Sale::find($id);
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
        DB::table('saleitems')->where('sale_id', '=', $this->common->vid)->delete();
        $obj->delete();
        $this->showDeleteModal = false;
        $message = "Deleted Successfully";
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message]);
    }
    #endregon

    #region[print]
    public function print($id): void
    {
        $this->redirect(route('sales.print', [$id]));
    }
    #endregion

//    public function getSalesLog()
//    {
//        $this->salesAllLogs = Logbook::where('model_name', 'Sales')->take(8)->get();
//    }

    #region[render]
    public function render()
    {
//        $this->getSalesLog();
        $this->getListForm->searchField='invoice_no';
        $this->getListForm->sortField='invoice_no';
        return view('entries::Sales.index')->with([
            'list'=>$this->getListForm->getList(Sale::class,function ($query){
                return  $query->where('company_id','=',session()->get('company_id'))->where('acyear',session()->get('acyear'));
            }),
        ]);
    }
    #endregion
}
