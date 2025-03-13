<?php

use Illuminate\Support\Facades\Route;

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/cities', Aaran\Common\Livewire\City\CityList::class)->name('cities');
    Route::get('/states', Aaran\Common\Livewire\State\StateList::class)->name('states');
    Route::get('/pin-codes', Aaran\Common\Livewire\Pincode\PincodeList::class)->name('pin-codes');
    Route::get('/countries', Aaran\Common\Livewire\Country\CountryList::class)->name('countries');
    Route::get('/hsn-codes', Aaran\Common\Livewire\Hsncode\HsncodeList::class)->name('hsn-codes');
    Route::get('/units', Aaran\Common\Livewire\Unit\UnitList::class)->name('units');
    Route::get('/categories', Aaran\Common\Livewire\Category\CategoryList::class)->name('categories');
    Route::get('/colours', Aaran\Common\Livewire\Colour\ColourList::class)->name('colours');
    Route::get('/sizes', Aaran\Common\Livewire\Size\SizeList::class)->name('sizes');
    Route::get('/department', Aaran\Common\Livewire\Department\DepartmentList::class)->name('department');
    Route::get('/transports', Aaran\Common\Livewire\Transport\TransportList::class)->name('transports');
    Route::get('/banks', Aaran\Common\Livewire\Bank\BankList::class)->name('banks');
    Route::get('/gst-percent', Aaran\Common\Livewire\Gst\GstList::class)->name('gst-percent');
    Route::get('/receipt-types', Aaran\Common\Livewire\ReceiptType\ReceiptTypeList::class)->name('receipt-types');
    Route::get('/dispatches', Aaran\Common\Livewire\Dispatch\DispatchList::class)->name('dispatches');
    Route::get('/contact-types', Aaran\Common\Livewire\ContactType\ContactTypeList::class)->name('contact-types');
    Route::get('/payment-modes', Aaran\Common\Livewire\PaymentMode\PaymentModeList::class)->name('payment-modes');
    Route::get('/account-types', Aaran\Common\Livewire\AccountType\AccountTypeList::class)->name('account-types');
    Route::get('/transaction-types', Aaran\Common\Livewire\TransactionType\TransactionTypeList::class)->name('transaction-types');



//    Route::get('/ledgers', App\Livewire\Common\LedgerList::class)->name('ledgers');
//    Route::get('Factory', App\Livewire\Demo\Data\Factory\Index::class)->name('Factory');

});
