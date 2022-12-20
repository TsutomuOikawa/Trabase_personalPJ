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

// ノート閲覧
Route::get('/notes', [\App\Http\Controllers\NotesController::class, 'showList']) -> name('notes.showList');
// ノート作成
Route::get('/notes/create', [\App\Http\Controllers\NotesController::class, 'showForm']) -> name('notes.showForm');
Route::post('/notes/create', [\App\Http\Controllers\NotesController::class, 'create']) -> name('notes.create');
