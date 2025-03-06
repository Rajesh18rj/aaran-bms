<?php

namespace Aaran\Entries\Livewire\ExportSales;


use Aaran\Assets\Trait\CommonTraitNew;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PackingList extends Component
{
    use CommonTraitNew;

    #region[property]
    public $exportSales_id = '';
    public $exportSalesItem = '';

    public $exportSalesItem_index = '';
    public $nos = '';
    public $net_wt = '';
    public $grs_wt = '';
    public $dimension = '';
    public $cbm = '';

    public string $itemIndex = "";
    public $itemList = [];
    #endregion

    #region[save]
    public function save()
    {
        DB::beginTransaction();

        try {
            foreach ($this->itemList as $sub) {
                if (!isset($sub['exportSalesItem_index']) || !isset($this->exportSalesItem[$sub['exportSalesItem_index']])) {
                    throw new \Exception("Invalid exportSalesItem_index for item.");
                }

                $data = [
                    'export_sales_id' => $this->exportSales_id,
                    'export_sales_item_id' => $this->exportSalesItem[$sub['exportSalesItem_index']]->id,
                    'nos' => $sub['nos'],
                    'net_wt' => $sub['net_wt'],
                    'grs_wt' => $sub['grs_wt'],
                    'dimension' => $sub['dimension'] ?: '0',
                    'cbm' => $sub['cbm'] ?: '0',
                ];

                $packingList = \Aaran\Entries\Models\PackingList::where('export_sales_id', $this->exportSales_id)
                    ->where('export_sales_item_id', $this->exportSalesItem[$sub['exportSalesItem_index']]->id)
                    ->first();

                if ($packingList) {
                    $packingList->update($data);
                } else {
                    \Aaran\Entries\Models\PackingList::create($data);
                }
            }
            $message = "Saved";
            DB::commit();
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message.' Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notify', ...['type' => 'error', 'content' => 'Error: '.$e->getMessage()]);
        }

        $this->getRoute();
    }

    #endregion

    #region[addItem]
    public function addItems(): void
    {
        if ($this->itemIndex == "") {
            if (!(empty($this->exportSalesItem_index))) {
                $this->itemList[] = [
                    'exportSalesItem_index' => round($this->exportSalesItem_index),
                    'nos' => $this->nos,
                    'net_wt' => $this->net_wt,
                    'grs_wt' => $this->grs_wt,
                    'dimension' => $this->dimension,
                    'cbm' => $this->cbm,
                ];
            }
        } else {
            $this->itemList[$this->itemIndex] = [
                'exportSalesItem_index' => $this->exportSalesItem_index,
                'nos' => $this->nos,
                'net_wt' => $this->net_wt,
                'grs_wt' => $this->grs_wt,
                'dimension' => $this->dimension,
                'cbm' => $this->cbm,
            ];
        }
        $this->resetsItems();
    }

    public function resetsItems(): void
    {
        $this->itemIndex = '';
        $this->exportSalesItem_index = '';
        $this->nos = '';
        $this->net_wt = '';
        $this->grs_wt = '';
        $this->dimension = '';
        $this->cbm = '';
    }

    public function changeItems($index): void
    {
        $this->itemIndex = $index;

        $items = $this->itemList[$index];
        $this->exportSalesItem_index = $items['exportSalesItem_index'];
        $this->nos = $items['nos'];
        $this->net_wt = $items['net_wt'];
        $this->grs_wt = $items['grs_wt'];
        $this->dimension = $items['dimension'];
        $this->cbm = $items['cbm'];
    }

    public function removeItems($index): void
    {
        DB::table('packing_lists')->where('export_sales_item_id', '=',$this->exportSalesItem[$this->itemList[$index]['exportSalesItem_index']]->id)->delete();
        unset($this->itemList[$index]);
        $this->itemList = collect($this->itemList);
    }
    #endregion

    #region[mount]
    public function mount($id)
    {
        $this->exportSales_id = $id;
        $this->exportSalesItem = DB::table('export_sale_items')
            ->select(
                'export_sale_items.*',
                'products.vname as product_name',
                'sizes.vname as size_name',
                'colours.vname as colour_name',
            )
            ->join('products', 'export_sale_items.product_id', '=', 'products.id')
            ->join('sizes', 'export_sale_items.size_id', '=', 'sizes.id')
            ->join('colours', 'export_sale_items.colour_id', '=', 'colours.id')
            ->where('export_sale_items.export_sales_id', $id)
            ->get();

        $obj = DB::table('packing_lists')
            ->select('packing_lists.*')
            ->where('export_sales_id', $id)
            ->get()
            ->transform(function ($obj) {
                $index = $this->exportSalesItem->search(function ($item) use ($obj) {
                    return $item->id == $obj->export_sales_item_id;
                });

                return [
                    'exportSalesItem_index' => $index !== false ? $index : null,
                    'nos' => $obj->nos,
                    'net_wt' => $obj->net_wt,
                    'grs_wt' => $obj->grs_wt,
                    'dimension' => $obj->dimension,
                    'cbm' => $obj->cbm,
                ];
            });

        if ($obj) {
            $this->itemList = $obj;
        }
    }
    #endregion

    #region[getRoute]
    public function getRoute(): void
    {
        $this->redirect(route('exportsales'));
    }
    #endregion

    #region[render]
    public function render()
    {
        return view('entries::ExportSales.packing-list');
    }
    #endregion
}
