<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\CreateRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
  // ノート一覧表示（検索なし）
  public function showList(Request $request) {
    $notes = Note::all();
    return view('notes.list')
      ->with('notes', $notes);
  }
  // ノート検索

  // ノート詳細表示
  public function showArticle() {
    return view('notes.article');
  }

  // ノートフォーム
  public function post() {
    return view('notes.post');
  }
  // ノート投稿
  public function create(CreateRequest $request) {
    $note = new Note;
    // todo:note筆者のユーザーIDも格納
    $note->fill($request->note())->save();
    return redirect()->route('notes.showList')->with('flash_message', __('Registerd.'));
  }
  // ノート編集
  public function edit() {

  }
}
