<?php

use App\Http\Controllers\ProfileController;
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

// ホーム画面
Route::get('/', function () {
    return view('index');
});
// 都道府県別ページ
 Route::get('/prefecture/', \App\Http\Controllers\PrefectureController::class) -> name('prefectures');

// ノート一覧画面
Route::get('/notes', [\App\Http\Controllers\NotesController::class, 'showList']) -> name('notes.list');
// ノート詳細閲覧
Route::get('/notes/article', [\App\Http\Controllers\NotesController::class, 'showArticle']) -> name('notes.detail');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // ノート作成
    Route::get('/notes/create', [\App\Http\Controllers\NotesController::class, 'showForm']) -> name('notes.showForm');
    Route::post('/notes/create', [\App\Http\Controllers\NotesController::class, 'create']) -> name('notes.create');
});

require __DIR__.'/auth.php';
