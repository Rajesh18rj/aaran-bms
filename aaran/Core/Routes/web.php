<?php

use Illuminate\Support\Facades\Route;

//Core
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/tenants', Aaran\Core\Livewire\Tenant\Index::class)->name('tenants');
    Route::get('/versions', Aaran\Core\Livewire\Versions\Index::class)->name('versions');
    Route::get('/defaults', Aaran\Core\Livewire\DefaultCompany\Index::class)->name('defaults');

});
