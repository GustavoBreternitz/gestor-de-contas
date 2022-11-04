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

// Record Routes
Route::post('/create-record', [App\Http\Controllers\Api\RecordController::class, 'create'])->name('create.record');
Route::get('/list-records', [App\Http\Controllers\Api\RecordController::class, 'list'])->name('list.record');
Route::post('/update-records', [App\Http\Controllers\Api\RecordController::class, 'update'])->name('update.record');
Route::delete('/delete-record', [App\Http\Controllers\Api\RecordController::class, 'delete'])->name('delete.record');
