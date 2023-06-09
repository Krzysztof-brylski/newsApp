<?php

use App\Events\SendLiveRelationMessage;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiveRelationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\LiveRelationMessage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');;
Auth::routes();

Route::get('/post/list/{tag:name?}',[HomeController::class,'postList'])->name('post.list');
Route::get('/post/{post}', [HomeController::class, 'watchPost'])->name('post.show');

Route::get('/live/relation/{message:prev_message}',[LiveRelationController::class,'index'])->name('relations.index');

Route::get('/relation/{relationMessage:prev_message}',function (LiveRelationMessage $relationMessage){
    return view('guest/live/read',['id'=>$relationMessage->prev_message]);
})->name('relation.read');

Route::middleware(['auth'])->group(function (){
    Route::post('/post/comment/{post}',[PostController::class,'comment'])->name('post.comment');
    Route::post('/post/like/{post}',[PostController::class,'like'])->name('post.like');
//    Route::apiResource('comment', CommentController::class)->except(['show','index','create']);


});



