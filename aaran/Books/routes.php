<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('accountHeads', Aaran\Books\Livewire\accountHead\Index::class)->name('accountHeads');

    Route::get('ledgerGroups', Aaran\Books\Livewire\ledgerGroup\Index::class)->name('ledgerGroups');

    Route::get('ledgers', Aaran\Books\Livewire\ledger\Index::class)->name('ledgers');

});
