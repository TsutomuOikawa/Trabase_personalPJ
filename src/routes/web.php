<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\NoteController;
USE App\Http\Controllers\PrefectureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishController;
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
Route::get('/', \App\Http\Controllers\IndexController::class)->name('index');
// 都道府県別ページ
Route::get('/prefectures/{prefecture_id}', [PrefectureController::class, 'show'])->where('prefecture_id', '^([1-9]|[1-3][0-9]|4[0-7])$')->name('prefectures.show');
// マイページ
Route::get('/mypage/{user_id}', [MypageController::class, 'show'])->name('mypage.show');

// ノート関連
Route::controller(NoteController::class)->group(function () {
    // ノート一覧画面
    Route::get('/notes', 'index')->name('notes.index');
    // ノート詳細閲覧
    Route::get('/notes/{note_id}', 'show')->whereNumber('note_id')->name('notes.show');

    // ログインユーザーのみ
    Route::middleware('auth')->group(function () {
        // ノート投稿画面
        Route::get('/notes/new', 'new')->name('notes.new');
        Route::post('/notes/new', 'store')->name('notes.store');
        // ノート再編集画面
        Route::get('/notes/article/{note_id}/edit', 'edit')->whereNumber('note_id')->name('notes.edit');
        Route::post('/notes/article/{note_id}/edit', 'getText')->whereNumber('note_id')->name('notes.getText');
        Route::put('/notes/article/{note_id}/edit', 'update')->whereNumber('note_id')->name('notes.update');
        // ノート削除機能
        Route::delete('/notes/article/{note_id}/delete', 'delete')->whereNumber('note_id')->name('notes.delete');
        // お気に入り登録
        Route::post('/notes/favorite/{note_id}', [App\Http\Controllers\FavoriteController::class, 'update'])->whereNumber('note_id')->name('favorite.update');
    });
});

// ログインユーザー専用
Route::middleware('auth')->group(function () {
    // プロフィール編集
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/mypage/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // コメント投稿
    Route::post('/notes/article/{note_id}', [CommentController::class, 'storeComment'])->whereNumber('note_id')->name('comment.storeComment');
    // マイリスト登録
    Route::post('/wish', [WishController::class, 'storeWish'])->name('wish.storeWish');
    Route::delete('/wish/complete/{wish_id}', [WishController::class, 'delete'])->whereNumber('wish_id')->name('wish.delete');
});

Route::get('/tweet', [App\Http\Controllers\TwitterController::class, 'getTweet']);

require __DIR__.'/auth.php';
