<?php

namespace Aaran\Entries\Livewire\Sales;

use Aaran\Assets\LivewireForms\MasterGstApi;
use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Common\Models\City;
use Aaran\Common\Models\Pincode;
use Aaran\Common\Models\State;
use Aaran\Common\Models\Transport;
use Aaran\Entries\Models\Sale;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\ContactDetail;
use Aaran\Master\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EwayBill extends Component
{
    use CommonTraitNew;

    #region[E-invoice properties]
    public MasterGstApi $masterGstApi;
    public $token;
    public $irnData;
    public $successMessage;
    public $e_wayBillDetails;
    public $showModel=false;
    public $CnlRsn;
    public $CnlRem;
    public $e_way_no;
    #endregion

    #region[Properties]
    public $itemList = [];
    public $salesData;
    public $contactDetails;
    public $companyDetails;
    public $addressDetails;
    #endregion

    #region[mount]
    public function mount($id): void
    {
        $this->e_wayBillDetails= \Aaran\MasterGst\Models\EwayBill::where('sales_id',$id)->first();
        if ($id != 0) {
            $obj = Sale::find($id);
            $this->salesData=$obj;
            $this->companyDetails=Company::find($obj->company_id);
            $this->contactDetails=Contact::find($obj->contact_id);
            $this->addressDetails=ContactDetail::find($obj->billing_id);
            $data = DB::table('saleitems')->select('saleitems.*',
                'products.vname as product_name',
                'colours.vname as colour_name',
                'sizes.vname as size_name',)->join('products', 'products.id', '=', 'saleitems.product_id')
                ->join('colours', 'colours.id', '=', 'saleitems.colour_id')
                ->join('sizes', 'sizes.id', '=', 'saleitems.size_id')->where('sale_id', '=',
                    $id)->get()->transform(function ($data) {
                    return [
                        'saleitem_id' => $data->id,
                        'po_no' => $data->po_no,
                        'dc_no' => $data->dc_no,
                        'no_of_roll' => $data->no_of_roll,
                        'product_name' => $data->product_name,
                        'product_id' => $data->product_id,
                        'colour_name' => $data->colour_name,
                        'colour_id' => $data->colour_id,
                        'size_name' => $data->size_name,
                        'size_id' => $data->size_id,
                        'qty' => $data->qty,
                        'price' => $data->price,
                        'description' => $data->description,
                        'gst_percent' => $data->gst_percent,
                        'taxable' => $data->qty * $data->price,
                        'gst_amount' => ($data->qty * $data->price) * ($data->gst_percent) / 100,
                        'subtotal' => $data->qty * $data->price + (($data->qty * $data->price) * $data->gst_percent / 100),
                    ];
                });
            $this->itemList = $data;
        }

    }

    #endregion


    #region[EwayBill]
    public function EwayBill()
    {
        $company = Company::find(session()->get('company_id'));
        $contact = Contact::find($this->salesData->contact_id);
        $contactDetail = ContactDetail::find($this->salesData->billing_id);
        $transport=Transport::find($this->salesData->transport_id);
        $bodyData = [
            "supplyType" => "O",
            "subSupplyType" => "1",
            "subSupplyDesc" => " ",
            "docType" => "INV",
            "docNo" => (string)($this->salesData->invoice_no),
            "docDate" => date('d/m/Y', strtotime($this->salesData->invoice_date)),
            "fromGstin" => $company->gstin,
            "fromTrdName" => $company->vname,
            "fromAddr1" => $company->address_1,
            "fromAddr2" =>$company->address_2,
            "fromPlace" => City::find($company->city_id)->vname,
            "actFromStateCode" => (int)(State::find($company->state_id)->desc),
            "fromPincode" =>(int)( Pincode::find($company->pincode_id)->vname),
            "fromStateCode" => (int)(State::find($company->state_id)->desc),
            "toGstin" => $contact->gstin,
            "toTrdName" =>$contact->vname,
            "toAddr1" => $contactDetail->address_1,
            "toAddr2" => $contactDetail->address_2,
            "toPlace" => City::find($contactDetail->city_id)->vname,
            "toPincode" =>(int) (Pincode::find($contactDetail->pincode_id)->vname),
            "actToStateCode" =>(int)(State::find($contactDetail->state_id)->desc),
            "toStateCode" =>(int)(State::find($contactDetail->state_id)->desc),
            "transactionType" => 4,
            "dispatchFromGSTIN" => $company->gstin,
            "dispatchFromTradeName" => $company->vname,
            "shipToGSTIN" => $contact->gstin,
            "shipToTradeName" =>$contact->vname,
            "totalValue" => (int)($this->salesData->total_taxable),
            "totInvValue" =>(int)($this->salesData->grand_total),
            "transMode" =>  (string)($this->salesData->TransMode),
            "transDistance" => $this->salesData->distance,
            "transDocNo" => $transport->desc_1,
            "transDocDate" => date('d/m/Y', strtotime($this->salesData->TransdocDt)),
            "vehicleNo" =>  $this->salesData->Vehno,
            "vehicleType" => $this->salesData->Vehtype,
            "itemList" => []
        ];
        if ($this->salesData->sales_type == '1') {
            $bodyData["sgstValue"] = $this->salesData->total_gst/2;
            $bodyData["cgstValue"] = $this->salesData->total_gst/2;
            $bodyData["igstValue"] = 0;
        } else {
            $bodyData["igstValue"] = $this->salesData->total_gst;
            $bodyData["sgstValue"] =0;
            $bodyData["cgstValue"] = 0;
        }
        foreach ($this->itemList as $index => $row) {
            $productData = Product::find($row['product_id']);
            $itemData = [
                "productName"=>$productData->vname,
                "productDesc"=>$productData->vname,
//                "hsnCode" => Sale::commons($productData->hsncode_id),
                "hsnCode" => $productData->hsncode_id,
                "quantity" => (int)($row['qty']),
//                "qtyUnit" => Sale::commons($productData->unit_id),
                "qtyUnit" => $productData->unit_id,
                "taxableAmount" => $row['taxable'],
            ];
            if ($this->salesData->sales_type == '1') {
                $itemData["sgstRate"] = $row['gst_percent'] / 2;
                $itemData["cgstRate"] = $row['gst_percent'] / 2;
                $itemData["igstRate"] = 0;
            } else {
                $itemData["igstRate"] = $row['gst_percent'];
                $itemData["sgstRate"] =0;
                $itemData["cgstRate"] = 0;
            }

            $bodyData["itemList"][] = $itemData;
        }
//        $result=$this->masterGstApi->EwayBillGenerate(new Request(),$bodyData,$this->salesData->id);
        $response = $this->masterGstApi->EwayBillGenerate(new Request(), $bodyData, $this->salesData->id);
        $result = $response->getData(true); // Convert JsonResponse to an array


        if (isset($result['data']['ewayBillNo'])) {
            $this->successMessage = 'E-wayBill generated successfully: ' . $result['data']['ewayBillNo'];
        } else {
            $this->successMessage = 'Failed to generate E-wayBill.';
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $this->successMessage]);
        $this->getRoute();
    }
    #endregion

    #region[cancelEway]
    public function cancelEway(): void
    {
        $this->showModel=true;
        $obj=\Aaran\MasterGst\Models\EwayBill::where('sales_id',$this->salesData->id)->first();
        $this->e_way_no=$obj->ewayBillNo;
        $this->CnlRsn=1;
        $this->CnlRem="Wrong entry";
    }
    public function getCancelEway(): void
    {
        $IrnCancel=[
            'ewbNo'=>(int)($this->e_way_no),
            'cancelRsnCode'=> (int)($this->CnlRsn),
            'cancelRmrk'=>$this->CnlRem,
        ];
        $this->masterGstApi->EwayBillCancel(new Request(),$IrnCancel,$this->salesData->id);
        $this->getRoute();
    }
    #endregion

    #region[render]
    public function getRoute():void
    {
        $this->redirect(route('sales'));
    }
    public function render()
    {
        return view('entries::Sales.eway-bill');
    }
    #endregion
}
