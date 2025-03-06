<?php

namespace App\Http\Controllers\Entries\Sales;

use Aaran\Entries\Models\Sale;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\ContactDetail;
use Aaran\MasterGst\Models\MasterGstEway;
use Aaran\MasterGst\Models\MasterGstIrn;
use App\Helper\ConvertTo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelPdf\Facades\Pdf;
use function Spatie\LaravelPdf\Support\pdf;

class InvController extends Controller
{
    public function __invoke($vid)
    {
        $sale = $this->getSales($vid);
        return pdf('pdf-view.sales.spatie.garment', [
            'obj' => $sale,
            'rupees' => ConvertTo::ruppesToWords($sale->grand_total),
            'list' => $this->getSaleItems($vid),
            'cmp' => Company::printDetails(session()->get('company_id')),
            'billing_address' => ContactDetail::printDetails($sale->billing_id),
            'shipping_address' => ContactDetail::printDetails($sale->shipping_id),
            'irn'=>$this->getIrn($vid),
            'eWay'=>$this->getEway($vid),
        ]);
    }
    public function getSales($vid): ?Sale
    {
        return Sale::select(
            'sales.*',
            'contacts.vname as contact_name',
            'contacts.msme_no as msme_no',
            'contacts.msme_type_id as msme_type',
            'orders.vname as order_no',
            'orders.order_name as order_name',
            'styles.vname as style_name',
            'styles.desc as style_desc',
            'despatches.vname as despatch_name',
//            'despatches.vdate as despatch_date',
            'transports.vname as transport_name',
            'transports.desc as transport_id',
            'transports.desc_1 as transport_no',
            'ledgers.vname as ledger_name',
        )
            ->join('contacts', 'contacts.id', '=', 'sales.contact_id')
            ->join('orders', 'orders.id', '=', 'sales.order_id')
            ->join('styles', 'styles.id', '=', 'sales.style_id')
            ->join('commons as despatches', 'despatches.id', '=', 'sales.despatch_id')
            ->join('commons as transports', 'transports.id', '=', 'sales.transport_id')
            ->join('commons as ledgers', 'ledgers.id', '=', 'sales.ledger_id')
            ->where('sales.id', '=', $vid)
            ->get()->firstOrFail();
    }
    public function getSaleItems($vid): Collection
    {
        return DB::table('saleitems')
            ->select(
                'saleitems.*',
                'products.vname as product_name',
                'units.vname as product_unit',
                'hsncodes.vname as hsncode',
                'colours.vname as colour_name',
                'sizes.vname as size_name',
            )
            ->join('products', 'products.id', '=', 'saleitems.product_id')
            ->join('commons as hsncodes', 'hsncodes.id', '=', 'products.hsncode_id')
            ->join('commons as units', 'units.id', '=', 'products.unit_id')
            ->join('commons as colours', 'colours.id', '=', 'saleitems.colour_id')
            ->join('commons as sizes', 'sizes.id', '=', 'saleitems.size_id')
            ->where('sale_id', '=', $vid)
            ->get()
            ->transform(function ($data) {
                return [
                    'saleitem_id' => $data->id,
                    'product_id' => $data->product_id,
                    'po_no' => $data->po_no,
                    'dc_no' => $data->dc_no,
                    'no_of_roll' => $data->no_of_roll,
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
    public function getIrn($vid)
    {
        return MasterGstIrn::where('sales_id',$vid)->first();
    }
    public function getEway($vid)
    {
        return MasterGstEway::where('sales_id',$vid)->first();
    }
}
