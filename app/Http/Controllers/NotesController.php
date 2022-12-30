<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\CreateRequest;
use App\Models\Note;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
  // ノート一覧表示（検索なし）
  public function showList(Request $request) {
    $notes = Note::with('user')->get();
    return view('notes.list')
      ->with('notes', $notes);
  }
  // ノート検索

  // ノート詳細表示
  public function showArticle($note_id) {
    $note = Note::with('user')->find($note_id);
    return view('notes.article')
      ->with('note', $note);
  }

  // ノート新規作成画面
  public function new() {
    $prefs = Prefecture::all();
    return view('notes.editor')
    ->with('prefs', $prefs);
  }

  // 投稿
  public function store(CreateRequest $request) {
    $note = new Note;
    $note->user_id = Auth::id();
    $note->fill($request->all());
    $note->save();

    // セッションメッセージを追加
    session()->flash('session_success', '保存が完了しました');
  }
  // ノート編集
  public function edit() {

  }
}
