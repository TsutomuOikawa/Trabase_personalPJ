<?php

use App\Http\Controllers\NoteController;
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

// ホーム
Route::get('/', \App\Http\Controllers\IndexController::class) -> name('index');
// 都道府県別ページ
Route::get('/pref/{pref_id}', [\App\Http\Controllers\PrefectureController::class, 'showPref'])->whereNumber('pref_id')->name('pref');

// ノート関連
Route::controller(NoteController::class)->group(function() {
    // ノート一覧画面
    Route::get('/notes', 'showList')->name('notes.list');
    // ノート詳細閲覧
    Route::get('/notes/detail/{note_id}', 'showArticle')->whereNumber('note_id')->name('notes.article');

    // ログインユーザーのみ
    Route::middleware('auth')->group(function () {
        // ノート投稿画面
        Route::get('/notes/new', 'new')->name('notes.new');
        Route::post('/notes/new', 'storeNote')->name('notes.store');
        // ノート再編集画面
        Route::get('/notes/detail/{note_id}/edit', 'edit')->whereNumber('note_id')->name('notes.edit');
        Route::post('/notes/detail/{note_id}/edit', 'getText')->whereNumber('note_id')->name('notes.getText');
        Route::put('/notes/detail/{note_id}/edit', 'update')->whereNumber('note_id')->name('notes.update');
        // ノート削除機能
        Route::delete('/notes/detail/{note_id}/delete', 'delete')->whereNumber('note_id')->name('notes.delete');

        // コメント投稿
        Route::post('/notes/detail/{note_id}', 'storeComment')->whereNumber('note_id')->name('comment.storeComment');
    });
});


Route::middleware('auth')->group(function () {
    // マイページ
    Route::get('mypage', [\App\Http\Controllers\MypageController::class, 'mypage'])->name('mypage');
    // プロフィール編集
    Route::get('mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('mypage/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
