<?php

use Illuminate\Support\Facades\Route;

//Core
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/tenants', Aaran\Core\Livewire\Tenant\Index::class)->name('tenants');

});
