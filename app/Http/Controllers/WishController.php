<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishRequest;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishController extends Controller
{
    public function storeWish(WishRequest $request) {
      $wish = new Wish;
      $wish->fill($request->all());
      $wish->user_id = Auth::id();

      $wish->save();
      session()->flash('session_success', '新しい「イキタイ」が登録されました');
      return back();
    }

    public static function setWishesQuery() {
      $query = DB::table('wishes')
                  ->leftJoin('users', 'wishes.user_id', '=', 'users.id')
                  ->leftJoin('prefectures', 'wishes.pref_id', '=', 'prefectures.pref_id')
                  ->select('wishes.*', 'users.name', 'users.avatar', 'prefectures.pref_name');
      return $query;
    }
}
