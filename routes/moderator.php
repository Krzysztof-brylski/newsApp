<?php

use App\Http\Controllers\LiveRelationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::resource('post', PostController::class)->except('show');
Route::resource('tag', TagController::class)->except(['show']);

Route::post('/live/relation/create',[LiveRelationController::class,'store'])->name('relations.store');
Route::post('/live/relation/update/{message:prev_message}',[LiveRelationController::class,'update'])->name('relations.update');

Route::get('/live/relation/create',[LiveRelationController::class,'create'])->name('relations.create');
Route::get('/live/relation/update/{message:prev_message}',[LiveRelationController::class,'edit'])->name('relations.edit');
Route::get('/live/relation',[LiveRelationController::class,'list'])->name('relations.index');
