<?php

use App\Http\Controllers\StatusCommentsController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\StatusLikesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::view('/', 'welcome')->name('home');

Route::get('statuses', [StatusesController::class, 'index'])
    ->name('statuses.index');

Route::post('statuses', [StatusesController::class, 'store'])
    ->name('statuses.store')
    ->middleware('auth');

Route::post('statuses/{status}/likes', [StatusLikesController::class, 'store'])
    ->name('statuses.likes.store')
    ->middleware('auth');

Route::delete('statuses/{status}/likes', [StatusLikesController::class, 'destroy'])
    ->name('statuses.likes.destroy')
    ->middleware('auth');

Route::post('statuses/{status}/comments', [StatusCommentsController::class, 'store'])
    ->name('statuses.comments.store')
    ->middleware('auth');
