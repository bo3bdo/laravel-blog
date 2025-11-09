<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Livewire\Pages\Post\CreatePost;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/posts/create', CreatePost::class)->name('posts.create');
});

Route::resource('posts', PostController::class)->except(['create']);
