<?php

namespace App\Http\Controllers\Entries\ExportSales;

use Aaran\Entries\Models\ExportSale;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\ContactDetail;
use App\Helper\ConvertTo;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class ExportInvoiceController extends Controller
{
    public function __invoke($vid)
    {
        $export_sales = $this->getExportSales($vid);
        pdf::setOption(['dpi' => 150, 'defaultPaperSize' => 'a4', 'defaultFont' => 'sans-serif', 'fontDir']);
        $pdf = PDF::loadView('pdf-view.export.invoice',
            [
                'obj' => $export_sales,
                'currency' => ConvertTo::currencyToWords($export_sales->total_taxable),
                'rupees' => ConvertTo::ruppesToWords($export_sales->total_gst),
                'list' => $this->getExportSalesItem($vid),
                'cmp' => Company::printDetails(session()->get('company_id')),
                'consignee_address' => ContactDetail::printDetails(ContactDetail::where('contact_id', $export_sales->contact_id)->first()->id),
                'consignees' => $this->getExportConsignee($vid),
                'packingList' => $this->getExportPackingList($vid),

            ]);
        $pdf->render();
        return $pdf->stream();
    }

    public function getExportSales($vid)
    {
        return ExportSale::select(
            'export_sales.*',
            'contacts.vname as contact_name',
            'contacts.msme_no as msme_no',
            'contacts.msme_type_id as msme_type',
            'orders.vname as order_no',
            'orders.order_name as order_name',
            'styles.vname as style_name',
            'styles.desc as style_desc',
        )
            ->join('contacts', 'contacts.id', '=', 'export_sales.contact_id')
            ->join('orders', 'orders.id', '=', 'export_sales.order_id')
            ->join('styles', 'styles.id', '=', 'export_sales.style_id')
            ->where('export_sales.id', '=', $vid)
            ->get()->firstOrFail();
    }

    public function getExportSalesItem($vid)
    {
        return DB::table('export_sale_items')
            ->select('export_sale_items.*',
                'products.vname as product_name',
                'colours.vname as colour_name',
                'sizes.vname as size_name',)
            ->join('products', 'products.id', '=', 'export_sale_items.product_id')
            ->join('commons as colours', 'colours.id', '=', 'export_sale_items.colour_id')
            ->join('commons as sizes', 'sizes.id', '=', 'export_sale_items.size_id')
            ->where('export_sales_id', '=', $vid)
            ->get()
            ->transform(function ($data) {
                return [
                    'export_sales_id' => $data->id,
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
    }

    public function getExportConsignee($vid)
    {
        return DB::table('export_sale_contacts')
            ->select('export_sale_contacts.*',
                'contacts.vname as contact_name',
                'contact_details.address_1 as address_1',
                'contact_details.address_2 as address_2',
                'city.vname as city_name',
                'state.vname as state_name',
                'pincode.vname as pincode_name',
                'country.vname as country_name',)
            ->join('contacts', 'contacts.id', '=', 'export_sale_contacts.contact_id')
            ->join('contact_details', 'contact_details.contact_id', '=', 'export_sale_contacts.contact_id')
            ->join('commons as city', 'city.id', '=', 'contact_details.city_id')
            ->join('commons as state', 'state.id', '=', 'contact_details.state_id')
            ->join('commons as pincode', 'pincode.id', '=', 'contact_details.pincode_id')
            ->join('commons as country', 'country.id', '=', 'contact_details.contact_id')
            ->where('export_sales_id', '=', $vid)->get()
            ->transform(function ($contact) {
                return [
                    'export_sale_contact_id' => $contact->id,
                    'contact_name' => $contact->contact_name,
                    'contact_id' => $contact->contact_id,
                    'address_1' => $contact->address_1,
                    'address_2' => $contact->address_2,
                    'city_name' => $contact->city_name,
                    'state_name' => $contact->state_name,
                    'pincode_name' => $contact->pincode_name,
                    'country_name' => $contact->country_name,
                ];
            });
    }

    public $exportSalesItem;
    public function getExportPackingList($vid)
    {
        $this->exportSalesItem = DB::table('export_sale_items')
            ->select(
                'export_sale_items.*',
                'products.vname as product_name',
                'sizes.vname as size_name',
                'colours.vname as colour_name',
            )
            ->join('products', 'export_sale_items.product_id', '=', 'products.id')
            ->join('commons as sizes', 'export_sale_items.size_id', '=', 'sizes.id')
            ->join('commons as colours', 'export_sale_items.colour_id', '=', 'colours.id')
            ->where('export_sale_items.export_sales_id', $vid)
            ->get();

        return DB::table('packing_lists')
            ->select('packing_lists.*')
            ->where('export_sales_id', $vid)
            ->get()
            ->transform(function ($obj) {
                $index = $this->exportSalesItem->search(function ($item) use ($obj) {
                    return $item->id == $obj->export_sales_item_id;
                });

                return [
                    'export_sales_item_id' => $obj->id,
                    'exportSalesItem_index' => $index !== false ? $index : null,
                    'nos' => $obj->nos,
                    'net_wt' => $obj->net_wt,
                    'grs_wt' => $obj->grs_wt,
                    'dimension' => $obj->dimension,
                    'cbm' => $obj->cbm,
                ];
            });
//        return  DB::table('packing_lists')
//            ->select('packing_lists.*')
//            ->where('export_sales_id', $vid)
//            ->get()
//            ->transform(function ($obj) {
//                return [
//                    'export_sales_id' => $obj->export_sales_id,
//                    'export_sales_item_id' => $obj->export_sales_item_id,
//                    'nos' => $obj->nos,
//                    'net_wt' => $obj->net_wt,
//                    'grs_wt' => $obj->grs_wt,
//                    'dimension' => $obj->dimension,
//                    'cbm' => $obj->cbm,
//                ];
//            });
    }
}
