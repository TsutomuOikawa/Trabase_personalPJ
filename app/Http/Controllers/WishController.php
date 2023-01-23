<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishRequest;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
