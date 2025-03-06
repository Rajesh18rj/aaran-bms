<?php

use Illuminate\Support\Facades\Route;

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/cities', Aaran\Common\Livewire\City\CityList::class)->name('cities');
    Route::get('/states', Aaran\Common\Livewire\state\StateList::class)->name('states');
    Route::get('/pin-codes', Aaran\Common\Livewire\pincode\PincodeList::class)->name('pin-codes');
    Route::get('/countries', Aaran\Common\Livewire\country\CountryList::class)->name('countries');
    Route::get('/hsn-codes', Aaran\Common\Livewire\hsncode\HsncodeList::class)->name('hsn-codes');
    Route::get('/units', Aaran\Common\Livewire\unit\UnitList::class)->name('units');
    Route::get('/categories', Aaran\Common\Livewire\category\CategoryList::class)->name('categories');
    Route::get('/colours', Aaran\Common\Livewire\colour\ColourList::class)->name('colours');
    Route::get('/sizes', Aaran\Common\Livewire\size\SizeList::class)->name('sizes');
    Route::get('/department', Aaran\Common\Livewire\department\DepartmentList::class)->name('department');
    Route::get('/transports', Aaran\Common\Livewire\transport\TransportList::class)->name('transports');
    Route::get('/banks', Aaran\Common\Livewire\bank\BankList::class)->name('banks');
    Route::get('/gst-percent', Aaran\Common\Livewire\gst\GstList::class)->name('gst-percent');
    Route::get('/receipt-types', Aaran\Common\Livewire\receipttype\ReceiptTypeList::class)->name('receipt-types');
    Route::get('/dispatches', Aaran\Common\Livewire\dispatch\DispatchList::class)->name('dispatches');
    Route::get('/contact-types', Aaran\Common\Livewire\ContactType\ContactTypeList::class)->name('contact-types');
    Route::get('/payment-modes', Aaran\Common\Livewire\PaymentMode\PaymentModeList::class)->name('payment-modes');
    Route::get('/account-types', Aaran\Common\Livewire\AccountType\AccountTypeList::class)->name('account-types');
    Route::get('/transaction-types', Aaran\Common\Livewire\TransactionType\TransactionTypeList::class)->name('transaction-types');



//    Route::get('/ledgers', App\Livewire\Common\LedgerList::class)->name('ledgers');
//    Route::get('Factory', App\Livewire\Demo\Data\Factory\Index::class)->name('Factory');

});
