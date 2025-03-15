<?php

namespace Aaran\Entries\Livewire\ExportSales;

use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Common\Models\Colour;
use Aaran\Common\Models\GstPercent;
use Aaran\Common\Models\Size;
use Aaran\Entries\Models\ExportSale;
use Aaran\Entries\Models\ExportSaleContact;
use Aaran\Entries\Models\ExportSaleItem;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\Order;
use Aaran\Master\Models\Product;
use Aaran\Master\Models\Style;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Upsert extends Component
{
    use CommonTraitNew;

    #region[property]
    public string $uniqueno = '';
    public string $acyear = '';
    public string $invoice_no = '';
    public string $invoice_date = '';
    public mixed $total_qty = 0;
    public mixed $total_taxable = '';
    public mixed $grandtotalBeforeRound = '';
    public string $total_gst = '';
    public mixed $additional = '';
    public mixed $round_off = '';
    public mixed $grand_total = '';

    public mixed $qty = '';
    public mixed $price = '';
    public $description;

    public string $itemIndex = "";
    public $itemList = [];
    public string $consigneeIndex = "";
    public $consigneeList = [];
    public mixed $pre_carriage = '';
    public mixed $place_of_Receipt = '';
    public mixed $vessel_flight_no = '';
    public mixed $port_of_loading = '';
    public mixed $port_of_discharge = '';
    public mixed $final_destination = '';
    public mixed $pkgs_type = '';
    public mixed $no_of_count = '';
    public mixed $ex_rate = '';
    public $sales_type='';
    public $currency_type='';
    #endregion

    public function rules(): array
    {
        return [
            'uniqueno' => 'required|string|max:255|unique:export_sales,uniqueno',
//            'company_id' => 'required|exists:companies,id',
            'contact_id' => 'required|integer|exists:contacts,id',
            'invoice_no' => 'required|integer|unique:export_sales,invoice_no',
            'invoice_date' => 'required|date',
            'order_id' => 'required|exists:orders,id',
            'style_id' => 'required|exists:styles,id',
        ];
    }
    public function messages() {
        return [
            'contact_id.required' => 'The contact field is required.',
            'contact_id.integer' => 'The contact ID must be a valid number.',
            'contact_id.exists' => 'The selected contact does not exist in the database.',
            ];
    }


    #region[Contact]
    #[validate]
    public $contact_name = '';
    public $contact_id = '';
    public Collection $contactCollection;
    public $highlightContact = 0;
    public $contactTyped = false;

    public function decrementContact(): void
    {
        if ($this->highlightContact === 0) {
            $this->highlightContact = count($this->contactCollection) - 1;
            return;
        }
        $this->highlightContact--;
    }

    public function incrementContact(): void
    {
        if ($this->highlightContact === count($this->contactCollection) - 1) {
            $this->highlightContact = 0;
            return;
        }
        $this->highlightContact++;
    }

    public function setContact($name, $id): void
    {
        $this->contact_name = $name;
        $this->contact_id = $id;
        $this->getContactList();
    }

    public function enterContact(): void
    {
        $obj = $this->contactCollection[$this->highlightContact] ?? null;

        $this->contact_name = '';
        $this->contactCollection = Collection::empty();
        $this->highlightContact = 0;

        $this->contact_name = $obj['vname'] ?? '';
        $this->contact_id = $obj['id'] ?? '';
    }

    #[On('refresh-contact')]
    public function refreshContact($v): void
    {
        $this->contact_id = $v['id'];
        $this->contact_name = $v['name'];
        $this->contactTyped = false;

    }

    public function getContactList(): void
    {

        $this->contactCollection = $this->contact_name ? Contact::search(trim($this->contact_name))
            ->where('company_id', '=', session()->get('company_id'))
            ->get() : Contact::where('company_id', '=', session()->get('company_id'))->get();

    }

    #endregion

    #region[Consignee]
    #[validate]
    public $consignee_name = '';
    public $consignee_id = '';
    public Collection $consigneeCollection;
    public $highlightConsignee = 0;
    public $consigneeTyped = false;

    public function decrementConsignee(): void
    {
        if ($this->highlightConsignee === 0) {
            $this->highlightConsignee = count($this->consigneeCollection) - 1;
            return;
        }
        $this->highlightConsignee--;
    }

    public function incrementConsignee(): void
    {
        if ($this->highlightConsignee === count($this->consigneeCollection) - 1) {
            $this->highlightConsignee = 0;
            return;
        }
        $this->highlightConsignee++;
    }

    public function setConsignee($name, $id): void
    {
        $this->consignee_name = $name;
        $this->consignee_id = $id;
        $this->getConsigneeList();
    }

    public function enterConsignee(): void
    {
        $obj = $this->consigneeCollection[$this->highlightConsignee] ?? null;

        $this->consignee_name = '';
        $this->consigneeCollection = Collection::empty();
        $this->highlightConsignee = 0;

        $this->consignee_name = $obj['vname'] ?? '';
        $this->consignee_id = $obj['id'] ?? '';
    }

    #[On('refresh-consignee')]
    public function refreshConsignee($v): void
    {
        $this->consignee_id = $v['id'];
        $this->consignee_name = $v['name'];
        $this->consigneeTyped = false;
    }

    public function getConsigneeList(): void
    {
        $this->consigneeCollection = $this->consignee_name ? Contact::search(trim($this->consignee_name))
            ->where('company_id', '=', session()->get('company_id'))
            ->get() : Contact::where('company_id', '=', session()->get('company_id'))->get();
    }

#endregion

    #region[Order]

    #[Rule('required')]
    public $order_id = '';
    public $order_name = '';
    public Collection $orderCollection;
    public $highlightOrder = 0;
    public $orderTyped = false;

    public function decrementOrder(): void
    {
        if ($this->highlightOrder === 0) {
            $this->highlightOrder = count($this->orderCollection) - 1;
            return;
        }
        $this->highlightOrder--;
    }

    public function incrementOrder(): void
    {
        if ($this->highlightOrder === count($this->orderCollection) - 1) {
            $this->highlightOrder = 0;
            return;
        }
        $this->highlightOrder++;
    }

    public function setOrder($name, $id): void
    {
        $this->order_name = $name;
        $this->order_id = $id;
        $this->getOrderList();
    }

    public function enterOrder(): void
    {
        $obj = $this->orderCollection[$this->highlightOrder] ?? null;

        $this->order_name = '';
        $this->orderCollection = Collection::empty();
        $this->highlightOrder = 0;

        $this->order_name = $obj['vname'] ?? '';
        $this->order_id = $obj['id'] ?? '';
    }

    #[On('refresh-order')]
    public function refreshOrder($v): void
    {
        $this->order_id = $v['id'];
        $this->order_name = $v['name'];
        $this->orderTyped = false;

    }

    public function getOrderList(): void
    {
        $this->orderCollection = $this->order_name ? Order::search(trim($this->order_name))
            ->where('company_id', '=', session()->get('company_id'))
            ->get() : Order::where('company_id', '=', session()->get('company_id'))->get();;
    }

    #endregion

    #region[Style]

    public $style_id = '';
    public $style_name = '';
    public \Illuminate\Support\Collection $styleCollection;
    public $highlightStyle = 0;
    public $styleTyped = false;

    public function decrementStyle(): void
    {
        if ($this->highlightStyle === 0) {
            $this->highlightStyle = count($this->styleCollection) - 1;
            return;
        }
        $this->highlightStyle--;
    }

    public function incrementStyle(): void
    {
        if ($this->highlightStyle === count($this->styleCollection) - 1) {
            $this->highlightStyle = 0;
            return;
        }
        $this->highlightStyle++;
    }

    public function enterStyle(): void
    {
        $obj = $this->styleCollection[$this->highlightStyle] ?? null;

        $this->style_name = '';
        $this->styleCollection = Collection::empty();
        $this->highlightStyle = 0;

        $this->style_name = $obj['vname'] ?? '';;
        $this->style_id = $obj['id'] ?? '';;
    }

    public function setStyle($name, $id): void
    {
        $this->style_name = $name;
        $this->style_id = $id;
        $this->getStyleList();
    }

    #[On('refresh-style')]
    public function refreshStyle($v): void
    {
        $this->style_id = $v['id'];
        $this->style_name = $v['name'];
        $this->styleTyped = false;

    }

    public function getStyleList(): void
    {
        $this->styleCollection = $this->style_name ?
            Style::search(trim($this->style_name))->get() :
            Style::all();
    }

    #endregion

    #region[Product]

    public $product_name = '';
    public $product_id = '';
    public mixed $gst_percent1 = '';
    public Collection $productCollection;
    public $highlightProduct = 0;
    public $productTyped = false;

    public function decrementProduct(): void
    {
        if ($this->highlightProduct === 0) {
            $this->highlightProduct = count($this->productCollection) - 1;
            return;
        }
        $this->highlightProduct--;
    }

    public function incrementProduct(): void
    {
        if ($this->highlightProduct === count($this->productCollection) - 1) {
            $this->highlightProduct = 0;
            return;
        }
        $this->highlightProduct++;
    }

    public function setProduct($name, $id, $percent): void
    {
        $this->product_name = $name;
        $this->product_id = $id;
//        $this->gst_percent1 = Sale::commons($percent);
        $this->gst_percent1 = GstPercent::find($percent)?->vname ?? '';
        $this->getProductList();
    }

    public function enterProduct(): void
    {
        $obj = $this->productCollection[$this->highlightProduct] ?? null;
        $this->product_name = '';
        $this->productCollection = Collection::empty();
        $this->highlightProduct = 0;

        $this->product_name = $obj['vname'] ?? '';
        $this->product_id = $obj['id'] ?? '';
//        $this->gst_percent1 = Sale::commons($obj['gstpercent_id']) ?? '';
        $this->gst_percent1 = GstPercent::find($obj['gstpercent_id'])?->vname ?? '';

    }

    #[On('refresh-product')]
    public function refreshProduct($v): void
    {
        $this->product_id = $v['id'];
        $this->product_name = $v['name'];
//        $this->gst_percent1 = Sale::commons($v['gstpercent_id']);
        $this->gst_percent1 = GstPercent::find($v['gstpercent_id'])?->vname ?? '';
        $this->productTyped = false;

    }

    public function getProductList(): void
    {
        $this->productCollection = $this->product_name ? Product::search(trim($this->product_name))
            ->where('company_id', '=', session()->get('company_id'))
            ->get() : Product::all()->where('company_id', '=', session()->get('company_id'));
    }

    #endregion

    #region[Colour]
    public $colour_name = '';
    public $colour_id = '';
    public Collection $colourCollection;
    public $highlightColour = 0;
    public $colourTyped = false;

    public function decrementColour(): void
    {
        if ($this->highlightColour === 0) {
            $this->highlightColour = count($this->colourCollection) - 1;
            return;
        }
        $this->highlightColour--;
    }

    public function incrementColour(): void
    {
        if ($this->highlightColour === count($this->colourCollection) - 1) {
            $this->highlightColour = 0;
            return;
        }
        $this->highlightColour++;
    }

    public function enterColour(): void
    {
        $obj = $this->colourCollection[$this->highlightColour] ?? null;

        $this->colour_name = '';
        $this->colourCollection = Collection::empty();
        $this->highlightColour = 0;

        $this->colour_name = $obj['vname'] ?? '';
        $this->colour_id = $obj['id'] ?? '';
    }

    public function setColour($name, $id): void
    {
        $this->colour_name = $name;
        $this->colour_id = $id;
        $this->getColourList();
    }

    #[On('refresh-colour')]
    public function refreshColour($v): void
    {
        $this->colour_id = $v['id'];
        $this->colour_name = $v['name'];
        $this->colourTyped = false;
    }

    public function colourSave($name)
    {
        $obj = Colour::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshColour($v);
    }

    public function getColourList(): void
    {
        $this->colourCollection = $this->colour_name ?
            Colour::search(trim($this->colour_name))->get() :
            Colour::all();
    }

    #endregion

    #region[size]
    public $size_name = '';
    public $size_id = '';
    public Collection $sizeCollection;
    public $highlightSize = 0;
    public $sizeTyped = false;

    public function decrementSize(): void
    {
        if ($this->highlightSize === 0) {
            $this->highlightSize = count($this->sizeCollection) - 1;
            return;
        }
        $this->highlightSize--;
    }

    public function incrementSize(): void
    {
        if ($this->highlightSize === count($this->sizeCollection) - 1) {
            $this->highlightSize = 0;
            return;
        }
        $this->highlightSize++;
    }

    public function setSize($name, $id): void
    {
        $this->size_name = $name;
        $this->size_id = $id;
        $this->getSizeList();
    }

    public function enterSize(): void
    {
        $obj = $this->sizeCollection[$this->highlightSize] ?? null;

        $this->size_name = '';
        $this->sizeCollection = Collection::empty();
        $this->highlightSize = 0;

        $this->size_name = $obj['vname'] ?? '';
        $this->size_id = $obj['id'] ?? '';
    }

    #[On('refresh-size')]
    public function refreshSize($v): void
    {
        $this->size_id = $v['id'];
        $this->size_name = $v['name'];
        $this->sizeTyped = false;

    }

    public function sizeSave($name)
    {
        $obj = Size::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshSize($v);
    }

    public function getSizeList(): void
    {
        $this->sizeCollection = $this->size_name ?
            Size::search(trim($this->size_name))->get() :
            Size::all();
    }
    #endregion

    #region[Save]
    public function save(): void
    {
        if ($this->uniqueno != '') {
            if ($this->common->vid == "") {
                $this->validate($this->rules());
                $obj = ExportSale::create([
                    'uniqueno' => session()->get('company_id').'~'.session()->get('acyear').'~'.ExportSale::nextNo(),
                    'acyear' => session()->get('acyear'),
                    'company_id' => session()->get('company_id'),
                    'contact_id' => $this->contact_id,
                    'invoice_no' => ExportSale::nextNo(),
                    'invoice_date' => $this->invoice_date,
                    'sales_type' => $this->sales_type,
                    'currency_type' => $this->currency_type,
                    'order_id' => $this->order_id ?: 1,
                    'style_id' => $this->style_id ?: 1,
                    'pre_carriage' => $this->pre_carriage,
                    'place_of_Receipt' => $this->place_of_Receipt,
                    'vessel_flight_no' => $this->vessel_flight_no,
                    'port_of_loading' => $this->port_of_loading,
                    'port_of_discharge' => $this->port_of_discharge,
                    'final_destination' => $this->final_destination,
                    'total_qty' => $this->total_qty,
                    'total_taxable' => $this->total_taxable,
                    'total_gst' => $this->total_gst,
                    'additional' => $this->additional,
                    'round_off' => $this->round_off,
                    'grand_total' => $this->grand_total,
                    'ex_rate' => $this->ex_rate,
                    'active_id' => $this->common->active_id,
                ]);
                $this->saveItem( $obj->id);
                $this->saveContact( $obj->id);
//                $this->common->logEntry($this->invoice_no,'ExportSale','create','The ExportSale entry has been created for '.$this->contact_name);
                $message = "Saved";
            } else {
                $obj = ExportSale::find($this->common->vid);
                $previousData = $obj->getOriginal();
                $mapping = [
                    'uniqueno' => 'Unique Number',
                    'acyear' => 'Accounting Year',
                    'company_id' => 'Company ID',
                    'contact_id' => 'Contact ID',
                    'invoice_no' => 'Invoice Number',
                    'invoice_date' => 'Invoice Date',
                    'currency_type' => 'Currency Type',
                    'sales_type' => 'Sales Type',
                    'order_id' => 'Order ID',
                    'style_id' => 'Style ID',
                    'pre_carriage' => 'Pre-Carriage Information',
                    'place_of_Receipt' => 'Place of Receipt',
                    'vessel_flight_no' => 'Vessel/Flight Number',
                    'port_of_loading' => 'Port of Loading',
                    'port_of_discharge' => 'Port of Discharge',
                    'final_destination' => 'Final Destination',
                    'total_qty' => 'Total Quantity',
                    'total_taxable' => 'Total Taxable Amount',
                    'total_gst' => 'Total GST Amount',
                    'additional' => 'Additional Information',
                    'ex_rate' => 'Exchange Rate',
                    'round_off' => 'Round Off Amount',
                    'grand_total' => 'Grand Total Amount',
                    'active_id' => 'Active ID'
                ];
                $obj->uniqueno = session()->get('company_id').'~'.session()->get('acyear').'~'.$this->invoice_no;
                $obj->acyear = session()->get('acyear');
                $obj->company_id = session()->get('company_id');
                $obj->contact_id = $this->contact_id;
                $obj->invoice_no = $this->invoice_no;
                $obj->invoice_date = $this->invoice_date;
                $obj->currency_type = $this->currency_type;
                $obj->sales_type = $this->sales_type;
                $obj->order_id = $this->order_id;
                $obj->style_id = $this->style_id;
                $obj->pre_carriage = $this->pre_carriage;
                $obj->place_of_Receipt = $this->place_of_Receipt;
                $obj->vessel_flight_no = $this->vessel_flight_no;
                $obj->port_of_loading = $this->port_of_loading;
                $obj->port_of_discharge = $this->port_of_discharge;
                $obj->final_destination = $this->final_destination;
                $obj->total_qty = $this->total_qty;
                $obj->total_taxable = $this->total_taxable;
                $obj->total_gst = $this->total_gst;
                $obj->additional = $this->additional;
                $obj->ex_rate = $this->ex_rate;
                $obj->round_off = $this->round_off;
                $obj->grand_total = $this->grand_total;
                $obj->active_id = $this->common->active_id;
                $obj->save();
                $this->saveItem( $obj->id);
                DB::table('export_sale_contacts')->where('export_sales_id', '=', $obj->id)->delete();
                $this->saveContact( $obj->id);
                $changes = [];
                foreach ($obj->getChanges() as $key => $newValue) {
                    $oldValue = $previousData[$key] ?? null;
                    $friendlyName = $mapping[$key] ?? $key;
                    $changes[] = "$friendlyName: '$oldValue' Changed to '$newValue'";
                }
                $changesMessage = implode(' , ', $changes);
//                $this->common->logEntry($this->invoice_no,'ExportSale','update',
//                    "The Export Sales entry has been updated for {$this->contact_name}. Changes: {$changesMessage}");
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message.' Successfully']);
            $this->getRoute();
        }

    }
    #endregion

    #region[saveItem]
    public function saveItem($id): void
    {

        foreach ($this->itemList as $sub) {
            if ($sub['export_sales_item_id']===0) {
                ExportSaleItem::create([
                    'export_sales_id' => $id,
                    'pkgs_type' => $sub['pkgs_type'],
                    'no_of_count' => $sub['no_of_count'],
                    'product_id' => $sub['product_id'],
                    'description' => $sub['description'],
                    'colour_id' => $sub['colour_id'] ?: '11',
                    'size_id' => $sub['size_id'] ?: '14',
                    'qty' => $sub['qty'],
                    'gst_percent' => $sub['gst_percent'],
                    'price' => $sub['price'],
                ]);
            }elseif ($sub['export_sales_item_id']!=0){
                $item=ExportSaleItem::find($sub['export_sales_item_id']);
                $item->export_sales_id=$id;
                $item->pkgs_type=$sub['pkgs_type'];
                $item->no_of_count=$sub['no_of_count'];
                $item->product_id=$sub['product_id'];
                $item->description=$sub['description'];
                $item->colour_id=$sub['colour_id'];
                $item->size_id=$sub['size_id'];
                $item->qty=$sub['qty'];
                $item->gst_percent=$sub['gst_percent'];
                $item->price=$sub['price'];
                $item->save();
            }
        }
    }

    public function saveContact($id):void
    {
        foreach ($this->consigneeList as $consignee) {
            ExportSaleContact::create([
                'export_sales_id' => $id,
                'contact_id'=>$consignee['contact_id'],
            ]);
        }
    }
    #endregion

    #region[mount]
    public function mount($id)
    {
        if ($id!=0){
            $obj = ExportSale::find($id);
            $this->common->vid = $obj->id;
            $this->uniqueno = $obj->uniqueno;
            $this->acyear = $obj->acyear;
            $this->contact_id = $obj->contact_id;
            $this->contact_name = $obj->contact->vname;
            $this->invoice_no = $obj->invoice_no;
            $this->invoice_date = $obj->invoice_date;
            $this->currency_type = $obj->currency_type;
            $this->sales_type = $obj->sales_type;
            $this->order_id = $obj->order_id;
            $this->order_name = $obj->order->vname;
            $this->style_id = $obj->style_id;
            $this->style_name = $obj->style->vname;
            $this->pre_carriage = $obj->pre_carriage;
            $this->place_of_Receipt = $obj->place_of_Receipt;
            $this->vessel_flight_no = $obj->vessel_flight_no;
            $this->port_of_loading = $obj->port_of_loading;
            $this->port_of_discharge = $obj->port_of_discharge;
            $this->final_destination = $obj->final_destination;
            $this->total_qty = $obj->total_qty;
            $this->total_taxable = $obj->total_taxable;
            $this->total_gst = $obj->total_gst;
            $this->additional = $obj->additional;
            $this->round_off = $obj->round_off;
            $this->grand_total = $obj->grand_total;
            $this->ex_rate = $obj->ex_rate;
            $this->common->active_id = $obj->active_id;

            $data = DB::table('export_sale_items')->select('export_sale_items.*',
                'products.vname as product_name',
                'colours.vname as colour_name',
                'sizes.vname as size_name',)
                ->join('products', 'products.id', '=', 'export_sale_items.product_id')
                ->join('colours', 'colours.id', '=', 'export_sale_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'export_sale_items.size_id')
                ->where('export_sales_id', '=',$id)
                ->get()
                ->transform(function ($data) {
                    return [
                        'export_sales_item_id'=>$data->id,
                        'pkgs_type' => $data->pkgs_type,
                        'no_of_count' => $data->no_of_count,
                        'product_name' => $data->product_name,
                        'product_id' => $data->product_id,
                        'colour_name' => $data->colour_name,
                        'colour_id' => $data->colour_id,
                        'size_name' => $data->size_name,
                        'size_id' => $data->size_id,
                        'qty' => $data->qty,
                        'price' => $data->price,
                        'gst_percent' => $data->gst_percent,
                        'description' => $data->description,
                        'taxable' => $data->qty * $data->price,
                    ];
                });
            $this->itemList = $data;
            $contact=DB::table('export_sale_contacts')
                ->select('export_sale_contacts.*','contacts.vname as contact_name')
                ->join('contacts', 'contacts.id', '=', 'export_sale_contacts.contact_id')
                ->where('export_sales_id', '=', $id)->get()
                ->transform(function ($contact) {
                    return [
                        'export_sale_contact_id' => $contact->id,
                        'contact_name' => $contact->contact_name,
                        'contact_id' => $contact->contact_id,
                    ];
                });
            $this->consigneeList=$contact;
        }else{
            $this->invoice_no= ExportSale::nextNo();
            $this->uniqueno = session()->get('company_id').'~'.session()->get('acyear').'~'.$this->invoice_no;
            $this->common->active_id = true;
            $this->additional = 0;
            $this->grand_total = 0;
            $this->ex_rate=1;
            $this->sales_type="IGST";
            $this->currency_type=1;
            $this->total_taxable = 0;
            $this->round_off = 0;
            $this->total_gst = 0;
            $this->invoice_date = Carbon::now()->format('Y-m-d');
        }
    }
    #endregion

    #region[getRoute]
    public function getRoute(): void
    {
        $this->redirect(route('exportsales'));
    }
    #endregion

    #region[add items]

    public function addItems(): void
    {
        if ($this->itemIndex == "") {
            if (!(empty($this->product_name)) &&
                !(empty($this->price)) &&
                !(empty($this->qty))
            ) {
                $this->itemList[] = [
                    'export_sales_item_id'=>0,
                    'pkgs_type' => $this->pkgs_type,
                    'no_of_count' => $this->no_of_count,
                    'product_name' => $this->product_name,
                    'product_id' => $this->product_id,
                    'colour_id' => $this->colour_id,
                    'colour_name' => $this->colour_name,
                    'size_id' => $this->size_id,
                    'size_name' => $this->size_name,
                    'qty' => $this->qty,
                    'price' => $this->price,
                    'description' => $this->description,
                    'taxable' => $this->qty * $this->price,
                    'gst_percent'=>$this->gst_percent1,
                ];
            }
        } else {
            $this->itemList[$this->itemIndex] = [
                'export_sales_item_id'=>$this->itemList[$this->itemIndex]['export_sales_item_id'],
                'pkgs_type' => $this->pkgs_type,
                'no_of_count' => $this->no_of_count,
                'product_name' => $this->product_name,
                'product_id' => $this->product_id,
                'colour_id' => $this->colour_id,
                'colour_name' => $this->colour_name,
                'size_id' => $this->size_id,
                'size_name' => $this->size_name,
                'qty' => $this->qty,
                'price' => $this->price,
                'description' => $this->description,
                'taxable' => $this->qty * $this->price,
                'gst_percent'=>$this->gst_percent1,
            ];
        }

        $this->calculateTotal();
        $this->resetsItems();
        $this->render();
    }

    public function resetsItems(): void
    {
        $this->itemIndex = '';
        $this->pkgs_type = '';
        $this->no_of_count = '';
        $this->product_name = '';
        $this->product_id = '';
        $this->colour_name = '';
        $this->colour_id = '';
        $this->size_name = '';
        $this->size_id = '';
        $this->qty = '';
        $this->price = '';
        $this->description = '';
        $this->gst_percent1='';
        $this->calculateTotal();
    }

    public function changeItems($index): void
    {
        $this->itemIndex = $index;

        $items = $this->itemList[$index];
        $this->pkgs_type = $items['pkgs_type'];
        $this->no_of_count = $items['no_of_count'];
        $this->product_name = $items['product_name'];
        $this->product_id = $items['product_id'];
        $this->gst_percent1 = $items['gst_percent'];
        $this->colour_name = $items['colour_name'];
        $this->colour_id = $items['colour_id'];
        $this->size_name = $items['size_name'];
        $this->size_id = $items['size_id'];
        $this->qty = $items['qty'] + 0;
        $this->price = $items['price'] + 0;
        $this->description = $items['description'];
        $this->calculateTotal();
    }

    public function removeItems($index): void
    {
        unset($this->itemList[$index]);
        $this->itemList = collect($this->itemList);
        $this->calculateTotal();
    }

    #endregion

    #region[addConsignee]
    public function addConsignee(): void
    {
        if ($this->consigneeIndex == "") {
            if (!(empty($this->consignee_name))
            ) {
                $this->consigneeList[] = [
                    'contact_id' => $this->consignee_id,
                    'contact_name' => $this->consignee_name,
                ];
            }
        } else {
            $this->consigneeList[$this->consigneeIndex] = [
                'contact_id' => $this->consignee_id,
                'contact_name' => $this->consignee_name,
            ];
        }

        $this->resetsConsignee();
        $this->render();
    }
    public function resetsConsignee(): void
    {
        $this->consigneeIndex = '';
        $this->consignee_id = '';
        $this->consignee_name = '';
    }

    public function changeConsignee($index): void
    {
        $this->consigneeIndex = $index;

        $items = $this->consigneeList[$index];
        $this->consignee_id = $items['contact_id'];
        $this->consignee_name = $items['contact_name'];
    }

    public function removeConsignee($index): void
    {
        unset($this->consigneeList[$index]);
        $this->consigneeList = collect($this->consigneeList);
    }
    #endregion

    #region[Calculate total]

    public function calculateTotal(): void
    {
        if ($this->itemList) {

            $this->total_qty = 0;
            $this->total_taxable = 0;
            $this->total_gst = 0;
            $this->grandtotalBeforeRound = 0;

            foreach ($this->itemList as $row) {
                $this->total_qty += round(floatval($row['qty']), 3);
                $this->total_taxable += round(floatval($row['taxable']), 2);
                $this->total_gst += ((round(floatval($row['taxable']), 2)*$this->ex_rate)*$row['gst_percent']/100);
                $this->grandtotalBeforeRound += (round(floatval($row['taxable']), 2)*$this->ex_rate);
            }
            $this->grand_total = round($this->grandtotalBeforeRound);
            $this->round_off = $this->grandtotalBeforeRound - $this->grand_total;

            if ($this->grandtotalBeforeRound > $this->grand_total) {
                $this->round_off = round($this->round_off, 2) * -1;
            }

            $this->qty = round(floatval($this->qty), 3);
            $this->total_taxable = round(floatval($this->total_taxable), 2);
            $this->total_gst = round(floatval($this->total_gst), 2);
            $this->round_off = round(floatval($this->round_off), 2);
            $this->grand_total = round((floatval($this->grand_total)) + (floatval($this->additional)), 2);
        }
    }


    #endregion
//    public $exportLogs;
//
//    public function getExportLog()
//    {
//        $this->exportLogs = Logbook::where('model_name', 'ExportSale')->where('vname',$this->invoice_no)->get();
////        dd($this->exportLogs);
//    }

    #region[render]
    public function render()
    {
//        $this->getExportLog();
        $this->getContactList();
        $this->getConsigneeList();
        $this->getOrderList();
        $this->getStyleList();
        $this->getProductList();
        $this->getColourList();
        $this->getSizeList();
        return view('entries::ExportSales.upsert');
    }
    #endregion
}
