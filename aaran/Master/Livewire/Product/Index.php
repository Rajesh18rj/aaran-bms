<?php

namespace Aaran\Master\Livewire\Product;

use Aaran\Assets\Enums\ProductType;
use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Common\Models\GstPercent;
use Aaran\Common\Models\Hsncode;
use Aaran\Common\Models\Unit;
use Aaran\Master\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[Properties]
    public $quantity;
    public $price;
    public $log;

    #endregion

    public function rules(): array
    {
        return [
            'common.vname' => 'required|unique:products,vname',
            'hsncode_name' => 'required',
            'unit_name' => 'required',
            'gstpercent_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'common.vname.required' => ' :attribute are missing.',
            'common.vname.unique' => ' :attribute is already created.',
            'hsncode_name.required' => ' :attribute is required.',
            'unit_name.required' => ' :attribute is required.',
            'gstpercent_name.required' => ' :attribute is required.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'common.vname' => 'Name',
            'hsncode_name' => 'Hsncode',
            'unit_name' => 'Unit',
            'gstpercent_name' => 'Gst percent',
        ];
    }

    #region[Get-Save]
    public function getSave(): void
    {
        if (empty($this->common->vname)) {
            return;
        }

        $this->common->vname = preg_replace('/[^A-Za-z0-9\-]/', '', $this->common->vname);

        $extraFields = [
            'producttype_id'  => $this->producttype_id ?: ProductType::GOODS,
            'hsncode_id'      => $this->hsncode_id ?: Hsncode::value('id'),
            'unit_id'         => $this->unit_id ?: Unit::value('id'),
            'gstpercent_id'   => $this->gstpercent_id ?: GstPercent::value('id'),
            'initial_quantity'=> $this->quantity ?: '0',
            'initial_price'   => $this->price ?: '0',
            'user_id'         => auth()->id(),
            'company_id'      => session()->get('company_id') ?? 1, // Ensure default value
        ];

        if (empty($this->common->vid)) {
            $this->validate($this->rules());
            $product = new Product();
            $this->common->save($product, $extraFields);
            $message = 'Saved';
        } else {
            $product = Product::find($this->common->vid);
            if ($product) {
                $this->common->edit($product, $extraFields);
                $message = 'Updated';
            } else {
                $this->dispatch('notify', ...['type' => 'error', 'content' => 'Product not found!']);
                return;
            }
        }
        $message = "Saved";
        $this->dispatch('notify', ...['type' => 'success', 'content' => "$message Successfully"]);
    }
    #endregion

    #region[hsncode]
    #[validate]
    public $hsncode_name = '';
    public $hsncode_id = '';
    public Collection $hsncodeCollection;
    public $highlightHsncode = 0;
    public $hsncodeTyped = false;

    public function decrementHsncode(): void
    {
        if ($this->highlightHsncode === 0) {
            $this->highlightHsncode = count($this->hsncodeCollection) - 1;
            return;
        }
        $this->highlightHsncode--;
    }

    public function incrementHsncode(): void
    {
        if ($this->highlightHsncode === count($this->hsncodeCollection) - 1) {
            $this->highlightHsncode = 0;
            return;
        }
        $this->highlightHsncode++;
    }

    public function setHsncode($name, $id): void
    {
        $this->hsncode_name = $name;
        $this->hsncode_id = $id;
        $this->getHsncodeList();
    }

    public function enterHsncode(): void
    {
        $obj = $this->hsncodeCollection[$this->highlightHsncode] ?? null;

        $this->hsncode_name = '';
        $this->hsncodeCollection = Collection::empty();
        $this->highlightHsncode = 0;

        $this->hsncode_name = $obj['vname'] ?? '';
        $this->hsncode_id = $obj['id'] ?? '';
    }

    public function refreshHsncode($v): void
    {
        $this->hsncode_id = $v['id'];
        $this->hsncode_name = $v['name'];
        $this->hsncodeTyped = false;
    }

    public function hsncodeSave($name)
    {
        $obj = Hsncode::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshHsncode($v);
    }

    public function getHsncodeList(): void
    {
        $this->hsncodeCollection = $this->hsncode_name ?
            HsnCode::where('vname', 'like', '%' . trim($this->hsncode_name) . '%')->get() :
            HsnCode::all();
    }
#endregion

    #region[producttype]
    public $producttype_id = '';
    public $producttype_name = '';
    public Collection $producttypeCollection;
    public $highlightProductType = 0;
    public $producttypeTyped = false;

    public function decrementProductType(): void
    {
        if ($this->highlightProductType === 0) {
            $this->highlightProductType = count($this->producttypeCollection) - 1;
            return;
        }
        $this->highlightProductType--;
    }

    public function incrementProductType(): void
    {
        if ($this->highlightProductType === count($this->producttypeCollection) - 1) {
            $this->highlightProductType = 0;
            return;
        }
        $this->highlightProductType++;
    }

    public function setProductType($name, $id): void
    {
        $this->producttype_name = $name;
        $this->producttype_id = $id;
        $this->getProductTypeList();
    }

    public function enterProductType(): void
    {
        $obj = $this->producttypeCollection[$this->highlightProductType] ?? null;

        $this->producttype_name = '';
        $this->producttypeCollection = Collection::empty();
        $this->highlightProductType = 0;

        $this->producttype_name = $obj['name'] ?? '';
        $this->producttype_id = $obj['id'] ?? '';
    }

    public function refreshProductType($v): void
    {
        $this->producttype_id = $v['id'];
        $this->producttype_name = $v['name'];
        $this->producttypeTyped = false;
    }

    public function getProductTypeList(): void
    {
        $this->producttypeCollection = collect(ProductType::getList());
    }
#endregion
#endregion

    #region[unit]
    #[validate]
    public $unit_name = '';
    public $unit_id = '';
    public Collection $unitCollection;
    public $highlightUnit = 0;
    public $unitTyped = false;

    public function decrementUnit(): void
    {
        if ($this->highlightUnit === 0) {
            $this->highlightUnit = count($this->unitCollection) - 1;
            return;
        }
        $this->highlightUnit--;
    }

    public function incrementUnit(): void
    {
        if ($this->highlightUnit === count($this->unitCollection) - 1) {
            $this->highlightUnit = 0;
            return;
        }
        $this->highlightUnit++;
    }

    public function setUnit($name, $id): void
    {
        $this->unit_name = $name;
        $this->unit_id = $id;
        $this->getUnitList();
    }

    public function enterUnit(): void
    {
        $obj = $this->unitCollection[$this->highlightUnit] ?? null;

        $this->unit_name = '';
        $this->unitCollection = Collection::empty();
        $this->highlightUnit = 0;

        $this->unit_name = $obj['vname'] ?? '';
        $this->unit_id = $obj['id'] ?? '';
    }

    public function refreshUnit($v): void
    {
        $this->unit_id = $v['id'];
        $this->unit_name = $v['vname'];
        $this->unitTyped = false;
    }

    public function unitSave($name)
    {
        $obj = Unit::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['vname' => $name, 'id' => $obj->id];
        $this->refreshUnit($v);
    }

    public function getUnitList(): void
    {
        $this->unitCollection = $this->unit_name ?
            Unit::where('vname', 'like', '%' . trim($this->unit_name) . '%')->get() :
            Unit::all();
    }
    #endregion

    #region[gstpercent]
    #[validate]
    public $gstpercent_name = '';
    public $gstpercent_id = '';
    public Collection $gstpercentCollection;
    public $highlightGstPercent = 0;
    public $gstpercentTyped = false;

    public function decrementGstPercent(): void
    {
        if ($this->highlightGstPercent === 0) {
            $this->highlightGstPercent = count($this->gstpercentCollection) - 1;
            return;
        }
        $this->highlightGstPercent--;
    }

    public function incrementGstPercent(): void
    {
        if ($this->highlightGstPercent === count($this->gstpercentCollection) - 1) {
            $this->highlightGstPercent = 0;
            return;
        }
        $this->highlightGstPercent++;
    }

    public function setGstPercent($name, $id): void
    {
        $this->gstpercent_name = $name;
        $this->gstpercent_id = $id;
        $this->getGstPercentList();
    }

    public function enterGstPercent(): void
    {
        $obj = $this->gstpercentCollection[$this->highlightGstPercent] ?? null;

        $this->gstpercent_name = '';
        $this->gstpercentCollection = Collection::empty();
        $this->highlightGstPercent = 0;

        $this->gstpercent_name = $obj['vname'] ?? '';
        $this->gstpercent_id = $obj['id'] ?? '';
    }

    public function refreshGstPercent($v): void
    {
        $this->gstpercent_id = $v['id'];
        $this->gstpercent_name = $v['name'];
        $this->gstpercentTyped = false;
    }

    public function gstPercentSave($name)
    {
        $obj = GstPercent::create([
            'vname' => $name,
            'desc' => null,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshGstPercent($v);
    }

    public function getGstpercentList(): void
    {
        $this->gstpercentCollection = $this->gstpercent_name ?
            GstPercent::where('vname', 'like', '%' . trim($this->gstpercent_name) . '%')->get() :
            GstPercent::all();
    }
#endregion

    #region[Get-Obj]
    public function getObj($id)
    {
        if ($id) {
            $Product = Product::find($id);
            $this->common->vid = $Product->id;
            $this->common->vname = $Product->vname;
            $this->common->active_id = $Product->active_id;
            $this->hsncode_id = $Product->hsncode_id;
            $this->hsncode_name = $Product->hsncode_id ? Hsncode::find($Product->hsncode_id)->vname : '';
            $this->producttype_id = $Product->producttype_id;
            $this->producttype_name = $Product->producttype_id->name ?? 'Unknown';
            $this->unit_id = $Product->unit_id;
            $this->unit_name = $Product->unit_id ? Unit::find($Product->unit_id)->vname : '';
            $this->gstpercent_id = $Product->gstpercent_id;
            $this->gstpercent_name = $Product->gstpercent_id ? GstPercent::find($Product->gstpercent_id)->vname : '';
            $this->quantity = $Product->initial_quantity;
            $this->price = $Product->initial_price;
            return $Product;
        }
        $message = "Updated";
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);

        return null;
    }
    #endregion

    #region[Clear-Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->hsncode_id = '';
        $this->hsncode_name = '';
        $this->gstpercent_name = '';
        $this->gstpercent_id = '';
        $this->unit_name = '';
        $this->unit_id = '';
        $this->producttype_id = '';
        $this->producttype_name = '';
        $this->quantity = '';
        $this->price = '';
    }
    #endregion

    #region[Render]
    public function getRoute()
    {
        return route('products');
    }

    public function getList()
    {
        return Product::select(
            'products.*',
            DB::raw("CASE products.producttype_id
                WHEN 1 THEN 'Goods'
                WHEN 2 THEN 'Services'
                ELSE 'Unknown'
             END as producttype_name"),
            'units.vname as unit_name',
            'hsncodes.vname as hsncode_name',
            'gst_percents.vname as gstpercent_name'
        )
            ->leftJoin('units', 'units.id', '=', 'products.unit_id')
            ->leftJoin('hsncodes', 'hsncodes.id', '=', 'products.hsncode_id')
            ->leftJoin('gst_percents', 'gst_percents.id', '=', 'products.gstpercent_id')
            ->whereNotNull('products.company_id') // Prevent null filter issues
            ->whereNotNull('products.active_id') // Ensure active records are fetched
            ->orderBy('products.id', 'desc')
            ->paginate($this->getListForm->perPage);
    }

    #region[Delete]
    public function deleteFunction($id): void
    {
        if ($id) {
            $obj = Product::find($id);
            if ($obj) {
                $obj->delete();
                $message = "Deleted Successfully";
                $this->dispatch('notify', ...['type' => 'success', 'content' => $message]);
            }
        }
    }
    #endregion

    public function render()
    {
        $list = $this->getList();

        $this->getHsncodeList();
        $this->getProductTypeList();
        $this->getUnitList();
        $this->getGstPercentList();
//        $this->log = Logbook::where('model_name','Product')->take(5)->get();

        return view('master::Product.index')
            ->with([
            'list' => $list ]);
    }
    #endregion
}

