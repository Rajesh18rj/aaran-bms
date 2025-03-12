<?php

namespace Aaran\Reports\Livewire\Sales;

use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Entries\Models\Purchase;
use Aaran\Entries\Models\Sale;
use Illuminate\Support\Carbon;
use Livewire\Component;

class GstReport extends Component
{
    use CommonTraitNew;

    #region[properties]
    public $month;
    public $year;

    #endregion
    public function getSales()
    {
        return Sale::whereMonth('invoice_date', '=', $this->month ?: Carbon::now()->format('m'))
            ->whereYear('invoice_date', '=', $this->year ?: Carbon::now()->format('Y'))
            ->where('company_id', '=', session()->get('company_id'))->get();
    }

    public function getPurchase()
    {
        return Purchase::whereMonth('purchase_date', '=', $this->month ?: Carbon::now()->format('m'))
            ->whereYear('purchase_date', '=', $this->year ?: Carbon::now()->format('Y'))
            ->where('company_id', '=', session()->get('company_id'))->get();
    }

    public function salesReport()
    {
        // to-do
        return $this->redirect(route('monthlySalesReport.print',
            ['month' => $this->month ?: Carbon::now()->format('m'), 'year' => $this->year ?: Carbon::now()->format('Y')]));
    }

    public function purchaseReport()
    {
        // to-do
        return $this->redirect(route('monthlyPurchaseReport.print', ['month' => $this->month ?: Carbon::now()->format('m'), 'year' => $this->year ?: Carbon::now()->format('Y')]));

    }

    public function GstPrint()
    {
        // to-do
        return $this->redirect(route('gstReport.print', ['month' => $this->month ?: Carbon::now()->format('m'), 'year' => $this->year ?: Carbon::now()->format('Y')], '_blank'));
    }

    public function render()
    {
        return view('reports::Sales.gst-report')->with([
            'sales' => $this->getSales(), 'purchase' => $this->getPurchase()
        ]);
    }
}
