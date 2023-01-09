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
Route::get('/prefecture/{id}', [\App\Http\Controllers\PrefectureController::class, 'showPref'])->whereNumber('id')->name('prefecture');

// ノート一覧画面
Route::get('/notes', [\App\Http\Controllers\NoteController::class, 'showList'])->name('notes.list');
// ノート詳細閲覧
Route::get('/notes/{note_id}', [\App\Http\Controllers\NoteController::class, 'showArticle'])->whereNumber('note_id')->name('notes.article');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ノート投稿画面
    Route::get('/notes/new', [\App\Http\Controllers\NoteController::class, 'new'])->name('notes.new');
    Route::post('/notes/new', [\App\Http\Controllers\NoteController::class, 'storeNote'])->name('notes.store');
    // ノート削除機能
    Route::delete('/notes/{note_id}/delete', [\App\Http\Controllers\NoteController::class, 'delete'])->whereNumber('note_id')->name('notes.delete');

    // ノート再編集画面
    Route::get('/notes/{note_id}/edit', [\App\Http\Controllers\NoteController::class, 'edit'])->whereNumber('note_id')->name('notes.edit');
    Route::post('/notes/{note_id}/edit', [\App\Http\Controllers\NoteController::class, 'getText'])->whereNumber('note_id')->name('notes.getText');
    Route::put('/notes/{note_id}/edit', [\App\Http\Controllers\NoteController::class, 'update'])->whereNumber('note_id')->name('notes.update');

    // コメント投稿
    Route::post('/notes/{note_id}', [\App\Http\Controllers\CommentController::class, 'storeComment'])->whereNumber('note_id')->name('comment.storeComment');

    // マイページ
    Route::get('mypage', [\App\Http\Controllers\MypageController::class, 'mypage'])->name('mypage');
});

require __DIR__.'/auth.php';
