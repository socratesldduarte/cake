<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CakeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('cakes', CakeController::class)->except(['create', 'edit']);

Route::post('/cakes/{cake}/make', [CakeController::class, 'make'])->name('cakes.make');
Route::post('/cakes/{cake}/order', [CakeController::class, 'order'])->name('cakes.order');
