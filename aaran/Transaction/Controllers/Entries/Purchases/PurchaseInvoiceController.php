<?php

namespace App\Http\Controllers\Entries\Purchases;

use Aaran\Entries\Models\Purchase;
use Aaran\Entries\Models\Sale;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\ContactDetail;
use App\Helper\ConvertTo;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PurchaseInvoiceController extends Controller
{
    public function __invoke($vid)
    {
        if ($vid != '') {

            $purchases = $this->getPurchases($vid);

            Pdf::setOption(['dpi' => 150, 'defaultPaperSize' => 'a4', 'defaultFont' => 'sans-serif','fontDir']);

            $pdf = PDF::loadView('pdf-view.purchases.garment'
                , [
                    'obj' => $purchases,
                    'rupees' => ConvertTo::ruppesToWords($purchases->grand_total),
                    'list' => $this->getPurchaseItems($vid),
                    'cmp' => Company::printDetails(session()->get('company_id')),
                    'billing_address' => ContactDetail::printDetails(ContactDetail::where('contact_id',$purchases->contact_id )->first()->id),
//                    'shipping_address' => ContactDetail::printDetails($purchases->shipping_id),
                ]);
            $pdf->render();
            return $pdf->stream();

        }
        return null;
    }

    public function getPurchases($vid)
    {
        return Purchase::select(
            'purchases.*',
            'contacts.vname as contact_name',
            'contacts.msme_no as msme_no',
            'contacts.msme_type_id as msme_type',
            'orders.vname as order_no',
            'orders.order_name as order_name',
            'transports.vname as transport_name',
            'transports.desc as transport_id',
            'transports.desc_1 as transport_no',
            'ledgers.vname as ledger_name',
        )
            ->join('contacts', 'contacts.id', '=', 'purchases.contact_id')
            ->join('orders', 'orders.id', '=', 'purchases.order_id')
            ->join('commons as transports', 'transports.id', '=', 'purchases.transport_id')
            ->join('commons as ledgers', 'ledgers.id', '=', 'purchases.ledger_id')
            ->where('purchases.id', '=', $vid)
            ->get()
        ->firstOrFail();
    }
    public function getPurchaseItems($vid): Collection
    {
        return DB::table('purchaseitems')
            ->select(
                'purchaseitems.*',
                'products.vname as product_name',
                'units.vname as product_unit',
                'hsncodes.vname as hsncode',
                'colours.vname as colour_name',
                'sizes.vname as size_name',
            )
            ->join('products', 'products.id', '=', 'purchaseitems.product_id')
            ->join('commons as hsncodes', 'hsncodes.id', '=', 'products.hsncode_id')
            ->join('commons as units', 'units.id', '=', 'products.unit_id')
            ->join('commons as colours', 'colours.id', '=', 'purchaseitems.colour_id')
            ->join('commons as sizes', 'sizes.id', '=', 'purchaseitems.size_id')
            ->where('purchase_id', '=', $vid)
            ->get()
            ->transform(function ($data) {
                return [
                    'purchaseitem_id' => $data->id,
                    'product_id' => $data->product_id,
//                    'po_no' => $data->po_no,
//                    'dc_no' => $data->dc_no,
//                    'no_of_roll' => $data->no_of_roll,
                    'product_name' => $data->product_name,
                    'product_unit' => $data->product_unit,
                    'hsncode' => $data->hsncode,
                    'colour_id' => $data->colour_id,
                    'colour_name' => $data->colour_name,
                    'size_id' => $data->size_id,
                    'size_name' => $data->size_name,
                    'description' => $data->description,
                    'qty' => $data->qty,
                    'price' => $data->price,
                    'total_taxable' => number_format($data->qty * $data->price, 2, '.', ''),
                    'gst_percent' => $data->gst_percent/2,
                    'gst_amount' => number_format(($data->qty * $data->price) * (($data->gst_percent) / 100), 2, '.', ''),
                    'sub_total' => number_format((($data->qty * $data->price) * ($data->gst_percent / 100)) + ($data->qty * $data->price), 2, '.', ''),
                ];
            });
    }
//    public function getIrn($vid)
//    {
//        return MasterGstIrn::where('purchase',$vid)->first();
//    }
//    public function getEway($vid)
//    {
//        return MasterGstEway::where('sales_id',$vid)->first();
//    }



}
