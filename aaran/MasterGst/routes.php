<?php

use Illuminate\Support\Facades\Route;

//Demo
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/gstAuth', Aaran\MasterGst\Livewire\Authenticate::class)->name('gstAuth');

});
