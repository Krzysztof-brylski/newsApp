<?php

use App\Http\Controllers\LogsController;
use Illuminate\Support\Facades\Route;


Route::get('/',[LogsController::class,'index'])->name('log.index');
