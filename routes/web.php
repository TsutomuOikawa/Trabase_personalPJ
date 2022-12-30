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
Route::get('/', \App\Http\Controllers\IndexController::class) -> name('index');
// 都道府県別ページ
Route::get('/prefecture/{id}', [\App\Http\Controllers\PrefectureController::class, 'showPref']) -> name('prefecture');

// ノート一覧画面
Route::get('/notes', [\App\Http\Controllers\NotesController::class, 'showList']) -> name('notes.list');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // ノート投稿画面
    Route::get('/notes/new', [\App\Http\Controllers\NotesController::class, 'new']) -> name('notes.new');
    Route::post('/notes/new', [\App\Http\Controllers\NotesController::class, 'store']) -> name('notes.store');
});

require __DIR__.'/auth.php';

// ノート詳細閲覧
Route::get('/notes/{id}', [\App\Http\Controllers\NotesController::class, 'showArticle']) -> name('notes.article');

Route::get('mypage', [\App\Http\Controllers\MypageController::class, 'mypage'])->name('mypage');
