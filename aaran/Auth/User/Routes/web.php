<?php

use Illuminate\Support\Facades\Route;

//Core
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/users', \Aaran\Auth\User\Livewire\Users\Index::class)->name('users');
    Route::get('/roles', \Aaran\Auth\User\Livewire\Role\Index::class)->name('roles');

});
