<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MypageController extends Controller
{
    public function mypage() {
        $user = Auth::user();
        $myNotes = Auth::user()->notes()->get();

        return view('mypage')
          ->with('user', $user)
          ->with('myNotes', $myNotes);

    }
}
