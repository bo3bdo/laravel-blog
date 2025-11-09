<?php

use App\Http\Controllers\PostController;
use App\Livewire\Pages\Post\CreatePost;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('/posts/create', CreatePost::class)->name('posts.create');

Route::resource('posts', PostController::class)->except(['create']);
