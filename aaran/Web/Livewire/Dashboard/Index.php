<?php

namespace Aaran\Web\Livewire\Dashboard;

use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Master\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;


class Index extends Component
{

    use CommonTraitNew;

    public $transactions;
    public $entries;
    public $contacts;
    public $blogs;
    public $user;

    public $monthlyTotals = [];


    public function mount():void
    {
//
//        $this->transactions = $this->getTransactions();
//        $this->entries = $this->getEntries();
//        $this->monthlyTotals=$this->fetchMonthlyTotals();
    }

    public function getTransactions()
    {
        $first = date('Y-m-01');
        $last = date('Y-m-t');

        $total_sales = Sale::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )
            ->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_sales = Sale::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )->where('acyear', '=', session()->get('acyear'))
            ->WhereBetween('invoice_date', [$first, $last])
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $total_purchase = Purchase::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_purchase = Purchase::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->WhereBetween('purchase_date', [$first, $last])
            ->firstOrFail();

        $total_receivable = Transaction::select(
            DB::raw("SUM(vname) as receipt_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('mode_id', '=', 111)
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_receivable = Transaction::select(
            DB::raw("SUM(vname) as receipt_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('mode_id', '=', 111)
            ->WhereBetween('vdate', [$first, $last])
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $total_payable = Transaction::select(
            DB::raw("SUM(vname) as payment_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('mode_id', '=', 110)
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_payable = Transaction::select(
            DB::raw("SUM(vname) as payment_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('mode_id', '=', 110)
            ->where('company_id', '=', session()->get('company_id'))
            ->WhereBetween('vdate', [$first, $last])
            ->firstOrFail();

        return Collection::make([
            'total_sales' => ConvertTo::rupeesFormat($total_sales->grand_total ?? 0),
            'month_sales' => ConvertTo::rupeesFormat($month_sales->grand_total ?? 0),
            'total_purchase' => ConvertTo::rupeesFormat($total_purchase->grand_total ?? 0),
            'month_purchase' => ConvertTo::rupeesFormat($month_purchase->grand_total ?? 0),
            'total_receivable' => ConvertTo::rupeesFormat($total_receivable->receipt_amount ?? 0),
            'month_receivable' => ConvertTo::rupeesFormat($month_receivable->receipt_amount ?? 0),
            'total_payable' => ConvertTo::rupeesFormat($total_payable->payment_amount ?? 0),
            'month_payable' => ConvertTo::rupeesFormat($month_payable->payment_amount ?? 0),
            'net_profit' => ConvertTo::rupeesFormat($total_sales->grand_total - $total_purchase->grand_total ?? 0),
            'month_profit' => ConvertTo::rupeesFormat($month_sales->grand_total - $month_purchase->grand_total ?? 0),
        ]);
    }

    public function getEntries()
    {
        $sales = Sale::latest()->first();
        $purchase = Purchase::latest()->first();
        $payment = Transaction::latest()->where('mode_id', '=', 110)->first();
        $receipt = Transaction::latest()->where('mode_id', '=', 111)->first();

        return Collection::make([
            'sales' => ConvertTo::rupeesFormat($sales->grand_total ?? 0),
            'sales_no' => $sales->invoice_no ?? 0,
            'sales_date' => $sales->invoice_date ?? '-',
            'purchase' => ConvertTo::rupeesFormat($purchase->grand_total ?? 0),
            'purchase_no' => $purchase->purchase_no ?? 0,
            'purchase_date' => $purchase->purchase_date ?? '-',
            'payment' => ConvertTo::rupeesFormat($payment->vname ?? 0),
            'payment_date' => $payment->vdate ?? '-',
            'receipt' => ConvertTo::rupeesFormat($receipt->vname ?? 0),
            'receipt_date' => $receipt->vdate ?? '-',
        ]);
    }

    public function getCustomer($id)
    {
        $openingbalance = Contact::find($id)->opening_balance;

        $sales = Sale::select(DB::raw("SUM(grand_total) as grand_total"))
            ->where('contact_id', '=', $id)
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $transactions = Transaction::select(DB::raw("SUM(vname) as receipt_total"))
            ->where('contact_id', '=', $id)
            ->where('company_id', '=', session()->get('company_id'))
            ->where('mode_id', '=', 111)
            ->firstOrFail();

        return $sales->grand_total - $transactions->receipt_total + $openingbalance;
    }

    public function getContact()
    {
        $this->contacts = Contact::all();
    }

    public function getBlog()
    {
//        $response = Http::get('https://cloud.aaranassociates.com/api/v1/blog');
//        $this->blogs = $response->json();

        try {
            $response = Http::get('https://cloud.aaranassociates.com/api/v1/blog');

            // Check if the response is successful
            if ($response->successful()) {
                // Process the response
                $this->blogs= $response->json();
                // Handle your data here
            } else {
                // Handle different response codes
                switch ($response->status()) {
                    case 404:
                        echo "Error 404: Not Found. The requested resource could not be found.";
                        break;
                    case 503:
                        echo "Error 503: Service Unavailable. Please try again later.";
                        break;
                    default:
                        echo "Error {$response->status()}: Something went wrong.";
                        break;
                }
            }
        } catch (\Exception $e) {
            // Log the exception message
            error_log($e->getMessage());
//            echo "An error occurred while trying to access the API: " . $e->getMessage();
        }
    }


    public function fetchMonthlyTotals()
    {
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;

// Define the start and end dates
        $startDate = "{$currentYear}-04-01"; // April 1st of the current year
        $endDate = "{$nextYear}-03-31"; // March 31st of the next year

        $monthlyTotals = Sale::selectRaw('MONTH(invoice_date) as month, YEAR(invoice_date) as year, SUM(grand_total) as total')
            ->where('company_id', '=', session()->get('company_id'))
            ->whereBetween('invoice_date', [$startDate, $endDate]) // Filter for April to March
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        return $monthlyTotals;
    }



    #region[getList]
    private function getList()
    {
        return 'web';
    }
    #endregion

    #region[render]
    public function render()
    {
        $this->getContact();
        $this->getBlog();

        return view('web::Dashboard.index')->with([
            'list' => $this->getList()
        ]);
    }

    #endregion
}
