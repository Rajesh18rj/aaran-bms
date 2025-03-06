<?php

namespace App\Http\Controllers\Transaction;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Company;
use Aaran\Transaction\Models\Transaction;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use function Spatie\LaravelPdf\Support\pdf;

class TransController extends Controller
{
    public $trans_type_id;
    public $trans_type_name;

    public function __invoke($id)
    {
        if ($id == 1) {
            $this->trans_type_id = 108;
            $this->trans_type_name = Common::find(108)->vname;
        } elseif ($id == 2) {
            $this->trans_type_id = 109;
            $this->trans_type_name = Common::find(109)->vname;
        }

//        return pdf('pdf-view.Transaction.trans', [
        Pdf::setOption(['dpi' => 150, 'defaultPaperSize' => 'a4', 'defaultFont' => 'sans-serif','fontDir']);

        $pdf = PDF::loadView('pdf-view.Transaction.trans'
            , [
            'list' => $this->getList(),
            'cmp' => Company::printDetails(session()->get('company_id')),
            'trans_type_id' => $this->trans_type_id,
            'trans_type_name' => $this->trans_type_name,

        ]);
        $pdf->render();

        return $pdf->stream();

    }

    public function getList()
    {
        return Transaction::where('trans_type_id', $this->trans_type_id)
            ->where('active_id','=','1')->get();
    }

}
