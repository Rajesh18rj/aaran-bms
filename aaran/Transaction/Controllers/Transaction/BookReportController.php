<?php

namespace App\Http\Controllers\Transaction;

use Aaran\Common\Models\Common;
use Aaran\Entries\Models\Purchase;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\ContactDetail;
use Aaran\Transaction\Models\AccountBook;
use Aaran\Transaction\Models\Transaction;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BookReportController extends Controller
{
    public $byParty;
    public $transaction;
    public $opening_bal;
    public $accountId;
    public $transId;
    public $transName;
    public $trans_type_id;
    public $startDate;
    public $endDate;
    public $opening_balance;
    public $contact_detail_id;
    public $invoiceDate_first;

    public function __invoke($id,$start_date, $end_date)
    {
        $this->byParty = $id;
//        $this->contact_detail_id=ContactDetail::where('contact_id', '=', $this->byParty)->first()->id;
        $this->transaction = AccountBook::find($id);
        $this->opening_balance = AccountBook::find($id)->opening_balance;
        $this->accountId = $this->transaction->id;
        $this->transId = $this->transaction->trans_type_id;
        if ($this->transId == 108) {
            $this->transName = Common::find(108)->vname;
        } elseif ($this->transId == 109) {
            $this->transName = Common::find(109)->vname;
        } else {
            $this->transName = Common::find(136)->vname;
        }

        Pdf::setOption(['dpi' => 150, 'defaultPaperSize' => 'a4', 'defaultFont' => 'sans-serif', 'fontDir']);

        $this->invoiceDate_first = Carbon::now()->subYear()->format('Y-m-d');

        $pdf = PDF::loadView('pdf-view.Transaction.bookReport'
            , [
                'transaction' => Transaction::where('trans_type_id', $this->transId)
                    ->where('account_book_id', $this->accountId)
                    ->whereDate('vdate', '>=', $start_date ?: $this->invoiceDate_first)
                    ->whereDate('vdate', '<=', $end_date ?: $this->invoiceDate_first)
                    ->get(),
                'cmp' => Company::printDetails(session()->get('company_id')),
                'start_date' => date('d-m-Y', strtotime($start_date)),
                'contact' => Contact::find($id),
                'end_date' => date('d-m-Y', strtotime($end_date)),
                'opening_balance' => $this->opening_balance,
                'party' => $this->byParty,
                'trans_name' => $this->transName,
//                'billing_address' => ContactDetail::printDetails($this->contact_detail_id),
            ]);
        $pdf->render();
        return $pdf->stream();
    }

}
