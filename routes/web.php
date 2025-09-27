<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'welcome'])->name('home');

Route::resource('/posts', PostController::class);
