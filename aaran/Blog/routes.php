<?php

use Illuminate\Support\Facades\Route;

//Blog
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/posts', Aaran\Blog\Livewire\blog\Index::class)->name('posts');
    Route::get('/posts/{id}/show', Aaran\Blog\Livewire\blog\Show::class)->name('posts.show');

    Route::get('blogTags',Aaran\Blog\Livewire\blog\Tag::class)->name('blogTags');
    Route::get('blogCategory',Aaran\Blog\Livewire\blog\Category::class)->name('blogCategory');

});
