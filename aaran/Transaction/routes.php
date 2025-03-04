<?php

use Illuminate\Support\Facades\Route;

//Temp
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

//    Route::get('trans/{id}/print', App\Http\Controllers\Transaction\TransController::class)->name('trans.print');
//
//
    Route::get('accBooks', Aaran\Transaction\Livewire\AccountBook\Index::class)->name('accBooks');
    Route::get('trans/{id?}', Aaran\Transaction\Livewire\AccountBook\Trans::class)->name('trans');
//
//
    Route::get('bankBooks/{id?}', Aaran\Transaction\Livewire\AccountBook\Index::class)->name('bankBooks');
    Route::get('cashBooks/{id?}', Aaran\Transaction\Livewire\AccountBook\Index::class)->name('cashBooks');
    Route::get('UPI/{id?}', Aaran\Transaction\Livewire\AccountBook\Index::class)->name('UPI');
//
//    Route::get('reports/{id?}', App\Livewire\Reports\Transaction\Bank::class)->name('reports');
//    Route::get('cashReports/{id?}', App\Livewire\Reports\Transaction\Bank::class)->name('cashReports');
//    Route::get('report/print/{party}/{start_date?}/{end_date?}', App\Http\Controllers\Transaction\BookReportController::class)->name('report.print');


});
