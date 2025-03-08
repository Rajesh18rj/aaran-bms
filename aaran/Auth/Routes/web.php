<?php

use Illuminate\Support\Facades\Route;

//Core
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/users', Aaran\Core\Livewire\Users\Index::class)->name('users');
    Route::get('/roles', Aaran\Core\Livewire\Role\Index::class)->name('roles');

});
