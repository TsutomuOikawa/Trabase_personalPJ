<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notes', [\App\Http\Controllers\Notes\ListController::class, 'show']);
Route::get('/notes/{id}', [\App\Http\Controllers\Notes\ListController::class, 'showId']);
