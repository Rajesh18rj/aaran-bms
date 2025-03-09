<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'ensurePermission:view_users,delete_users'])->group(function () {

    Route::get('/users', \Aaran\Auth\User\Livewire\Users\Index::class)->name('users');
    Route::get('/roles', \Aaran\Auth\User\Livewire\Role\Index::class)->name('roles');
    Route::get('/permissions', \Aaran\Auth\User\Livewire\Role\Index::class)->name('permissions');

});
