<?php

namespace Aaran\Entries\Livewire\ExportSales;

use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Entries\Models\ExportSale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[create]
    public function create(): void
    {
        $this->redirect(route('exportsales.upsert', ['0']));
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = ExportSale::find($id);
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
        DB::table('export_sale_items')->where('export_sales_id', '=', $this->common->vid)->delete();
        $obj->delete();
        $this->showDeleteModal = false;
        $message = "Deleted Successfully";
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message]);
    }
    #endregon

//    public $exportsalesAllLogs;
//
//    public function getExportSalesLog()
//    {
//        $this->exportsalesAllLogs = Logbook::where('model_name', 'ExportSale')->take(8)->get();
//    }

    #region[render]
    public function render()
    {
//        $this->getExportSalesLog();
        $this->getListForm->searchField='invoice_no';
        $this->getListForm->sortField='invoice_no';
        return view('entries::ExportSales.index')->with([
            'list'=>$this->getListForm->getList(ExportSale::class,function ($query){
                return  $query->where('company_id','=',session()->get('company_id'))->where('acyear',session()->get('acyear'));
            }),
        ]);
    }
    #endregion
}
