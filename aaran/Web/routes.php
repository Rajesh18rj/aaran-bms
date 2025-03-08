<?php

use Illuminate\Support\Facades\Route;

//web

Route::get('/', Aaran\Web\Livewire\Home\Index::class)->name('home');
Route::get('/abouts', Aaran\Web\Livewire\About\Index::class)->name('abouts');
Route::get('/blogs', Aaran\Web\Livewire\Blog\Index::class)->name('blogs');
Route::get('/services', Aaran\Web\Livewire\Service\Index::class)->name('services');
Route::get('/web-contacts', Aaran\Web\Livewire\Contact\Index::class)->name('web-contacts');

Route::get('dashboard', Aaran\Web\Livewire\Dashboard\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
