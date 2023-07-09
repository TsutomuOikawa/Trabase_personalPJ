<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function update(Request $request)
    {
        $user_id = Auth::id();
        $note_id = intval($request->note_id);

        // DBに存在するかを判定
        if (Favorite::withTrashed()->where('user_id', $user_id)->where('note_id', $note_id)->doesntExist()) {
            // 存在しない場合->登録
            $favorite = new Favorite;
            $favorite->user_id = $user_id;
            $favorite->note_id = $note_id;
            $favorite->save();

            // ajaxに返却
            echo 'on';
        } elseif (Favorite::onlyTrashed()->where('user_id', $user_id)->where('note_id', $note_id)->exists()) {
            // 論理削除済みだった場合
            $favorite = Favorite::onlyTrashed()
                ->where('user_id', $user_id)
                ->where('note_id', $note_id)
                ->restore();
            echo 'on';

        } else {
            // 存在した場合
            $favorite = Favorite::where('user_id', $user_id)->where('note_id', $note_id)
                ->delete();
            echo 'off';
        }
    }

    // お気に入り状況確認
    public static function isFavorite($user_id, $note_id)
    {
        return Favorite::where('user_id', $user_id)->where('note_id', $note_id)->exists();
    }

    // お気に入り合計数確認
    public static function countFavorites($note_id)
    {
        return Favorite::where('note_id', $note_id)->count();
    }
}
