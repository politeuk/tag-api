<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/{key}/user/{id}', [App\Http\Controllers\UserController::class, 'get'])->name('getuser');
Route::post('/{key}/user/{id}/points', [App\Http\Controllers\UserController::class, 'updatePoints'])->name('update.points');
