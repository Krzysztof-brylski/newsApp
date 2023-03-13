<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::resource('post', PostController::class);
Route::resource('tag', TagController::class);
