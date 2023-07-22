<?php

namespace App\Http\Controllers;

use App\UseCases\Mypage\ShowAction;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function show(ShowAction $action, Request $request)
    {
        $user = $action($request->route('user_id'));
        return view('mypage.show', compact('user'));
    }
}
