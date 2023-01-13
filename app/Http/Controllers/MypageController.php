<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MypageController extends Controller
{
    public function mypage() {
        $user = Auth::user();
        $notes = DB::table('notes')
                    ->leftJoin('users', 'notes.user_id', '=', 'users.id')
                    ->leftJoin('prefectures', 'notes.pref_id', '=', 'prefectures.pref_id')
                    ->where('user_id', $user->id)
                    ->get();

        return view('mypage')
          ->with('user', $user)
          ->with('notes', $notes);
    }

}
