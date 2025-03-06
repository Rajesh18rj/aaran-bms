<?php

namespace Aaran\Master\Livewire\Product\Lookup;

use Aaran\Assets\Enums\ProductType;
use Aaran\Common\Models\GstPercent;
use Aaran\Common\Models\Hsncode;
use Aaran\Common\Models\Unit;
use Aaran\Master\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class ProductModel extends Component
{
    public bool $showModel = false;

    public $vname = "";
    public $quantity;
    public $price;

//    public function mount($name): void
//    {
//        $this->vname = $name;
//        $this->producttype_id = 92;
//        $this->producttype_name = $this->producttype_id ? Common::find($this->producttype_id)->vname : '';
//        $this->hsncode_id = 61;
//        $this->hsncode_name = $this->hsncode_id ? Common::find($this->hsncode_id)->vname : '';
//        $this->unit_id = 94;
//        $this->unit_name = $this->unit_id ? Common::find($this->unit_id)->vname : '';
//        $this->gstpercent_id = 100;
//        $this->gstpercent_name = $this->gstpercent_id ? Common::find($this->gstpercent_id)->vname : '';
//        $this->quantity = 0;
//        $this->price = 0;
//    }

    public function mount($name, $producttype_id = null, $hsncode_id = null, $unit_id = null, $gstpercent_id = null): void
    {
        $this->vname = $name;

        // Assigning Enum value (if null, default to GOODS)
        $this->producttype_id = $producttype_id ?? ProductType::GOODS->value;
        $this->producttype_name = ProductType::tryFrom($this->producttype_id)?->getName() ?? '';

        $this->hsncode_id = $hsncode_id ?? HsnCode::first()?->id;
        $this->hsncode_name = HsnCode::find($this->hsncode_id)?->vname ?? '';

        $this->unit_id = $unit_id ?? Unit::first()?->id;
        $this->unit_name = Unit::find($this->unit_id)?->vname ?? '';

        $this->gstpercent_id = $gstpercent_id ?? GstPercent::first()?->id;
        $this->gstpercent_name = GstPercent::find($this->gstpercent_id)?->vname ?? '';

        $this->quantity = 0;
        $this->price = 0;
    }


    public function save(): void
    {
//        $this->vname=preg_replace('/[^A-Za-z0-9\-]/', ' ', $this->vname);

        if ($this->vname != '') {
            $obj = Product::create([
                'vname' => Str::ucfirst($this->vname),
                'producttype_id' => $this->producttype_id ?: '',
                'hsncode_id' => $this->hsncode_id ?: '',
                'unit_id' => $this->unit_id ?: '',
                'gstpercent_id' => $this->gstpercent_id ?: '',
                'initial_quantity' => $this->quantity ?: '0',
                'initial_price' => $this->price ?: '0',
                'user_id' => Auth::id(),
                'company_id' => session()->get('company_id'),
                'active_id' => '1'
            ]);
            $this->dispatch('refresh-factory', ['name' => $this->vname, 'id' => $obj->id, 'gstpercent_id' => $this->gstpercent_id]);
            $this->clearAll();
        }
    }

    public function clearAll(): void
    {
        $this->showModel = false;
        $this->vname = "";
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

    #region[hsncode]

    public $hsncode_id = '';
    public $hsncode_name = '';
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
            Hsncode::search(trim($this->hsncode_name))->get() :
            Hsncode::all();
    }
#endregion

    #region[producttype]

    public $producttype_id = '';
    public $producttype_name = '';
    public array $producttypeCollection = [];
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

    public function setProductType($id): void
    {
        $id = (int) $id; // Convert to integer before passing it
        $productType = ProductType::tryFrom($id);


        if ($productType) {
            $this->producttype_id = $productType->value;
            $this->producttype_name = $productType->getName();
        }
    }

    public function enterProductType(): void
    {
        $obj = $this->producttypeCollection[$this->highlightProductType] ?? null;
        $this->producttypeCollection = [];
        $this->highlightProductType = 0;

        if ($obj) {
            $this->setProductType($obj['id']);
        }
    }

    #[On('refresh-producttype')]
    public function refreshProductType($v): void
    {
        $this->producttype_id = $v['id'];
        $this->producttype_name = $v['name'];
        $this->producttypeTyped = false;
    }


    public function getProductTypeList(): void
    {
        $this->producttypeCollection = collect(ProductType::cases())->map(fn ($type) => [
            'id' => $type->value,
            'vname' => $type->getName(),
        ])->toArray();
    }
#endregion

    #region[unit]

    public $unit_id = '';
    public $unit_name = '';
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
        $this->unit_name = $v['name'];
        $this->unitTyped = false;
    }

    public function unitSave($name)
    {
        $obj = Unit::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshUnit($v);
    }

    public function getUnitList(): void
    {
        $this->unitCollection = $this->unit_name ?
            Unit::search(trim($this->unit_name))->get():
            Unit::all();
    }
#endregion

    #region[gstpercent]

    public $gstpercent_id = '';
    public $gstpercent_name = '';
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
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshGstPercent($v);
    }

    public function getGstPercentList(): void
    {
        $this->gstpercentCollection = $this->gstpercent_name ?
            GstPercent::search(trim($this->gstpercent_name))->get():
            GstPercent::all();
    }

#endregion

    public function render()
    {
        $this->getHsncodeList();
        $this->getProductTypeList();
        $this->getUnitList();
        $this->getGstPercentList();
        return view('master::Product.Lookup.product-model');
    }
}
