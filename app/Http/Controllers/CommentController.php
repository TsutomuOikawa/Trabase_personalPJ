<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeComment(CommentRequest $request) {
      $comment = new Comment;
      $comment->note_id = $request->route('note_id');
      $comment->user_id = Auth::id();
      $comment->comment = $request->comment;

      $comment->save();
      session()->flash('session_success', 'コメントが投稿されました');
      return back();
    }
}
