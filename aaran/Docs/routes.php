<?php

use Illuminate\Support\Facades\Route;

//Master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

//    Route::get('/docs', Aaran\Web\Livewire\Dashboard\Index::class)->name('docs');

});
