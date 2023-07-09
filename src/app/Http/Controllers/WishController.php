<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishRequest;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishController extends Controller
{
    public function storeWish(WishRequest $request)
    {
        $wish = new Wish;
        $wish->fill($request->all());
        $wish->user_id = Auth::id();

        $wish->save();
        session()->flash('session_success', '新しいリストが登録されました');

        return back();
    }

    // 削除
    public function delete(Request $request)
    {
        $wish_id = $request->route('wish_id');
        $wish = Wish::find($wish_id);
        $spot = $wish->spot;
        $thing = $wish->thing;
        // ログイン者とwishの作成者の整合
        if ($wish->user_id === Auth::id()) {
            $wish->delete();
            session()->flash('session_success', $spot.'/'.$thing.'を削除しました');

            return back();

        } else {
            session()->flash('session_error', 'エラーが発生しました。しばらく経ってから再度お試しください。');

            return back();
        }
    }

    public static function setWishesQuery()
    {
        $query = DB::table('wishes')
            ->leftJoin('users', 'wishes.user_id', '=', 'users.id')
            ->leftJoin('prefectures', 'wishes.prefecture_id', '=', 'prefectures.id')
            ->select('wishes.*', 'users.name', 'users.avatar', 'prefectures.name')
            ->where('wishes.deleted_at', null);

        return $query;
    }
}
