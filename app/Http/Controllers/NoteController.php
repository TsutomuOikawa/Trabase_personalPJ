<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\CreateRequest;
use App\Http\Requests\Note\UpdateRequest;
use App\Models\Note;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
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
    $note->text = json_decode($note->text, true);

    return view('notes.article')
      ->with('note', $note);
  }

  // ノート新規作成画面
  public function new() {
    $prefs = Prefecture::all();
    return view('notes.editor')
      ->with('editMode', false)
      ->with('prefs', $prefs);
  }

  // 投稿
  public function storeNote(CreateRequest $request) {
    $note = new Note;
    $note->user_id = Auth::id();
    $note->fill($request->all());
    $note->save();

    // セッションメッセージを追加
    session()->flash('session_success', '保存が完了しました');
    // ajaxにlastInsertIdを返却
    echo $note->note_id;
  }

  // ノート編集画面表示
  public function edit($note_id) {
    $prefs = Prefecture::all();
    $note = Note::find($note_id);

    return view('notes.editor')
      ->with('editMode', true)
      ->with('prefs', $prefs)
      ->with('note', $note);
  }

  // テキストデータ取得
  public function getText(Request $request) {
    $text = Note::where('note_id', $request->note_id)->value('text');
    echo $text;
  }

  // ノート更新
  public function update(UpdateRequest $request) {
    $note = Note::find($request->route('note_id'));
    $note->fill($request->all());
    $note->save();

    // セッションメッセージを追加
    session()->flash('session_success', '更新が完了しました');
    echo $note->note_id;
  }

  // ノート削除
  public function delete(Request $request) {
    $login_u_id = Auth::id();
    $note = Note::find($request->route('note_id'));
    $note_u_id = $note->user_id;
    // ログインしている人が筆者なら削除する
    if ($note_u_id === $login_u_id) {
      $note->delete();
      // フラッシュメッセージ追加
      session()->flash('session_success', '投稿を削除しました');
      return redirect()->route('mypage');

    }else {
      // ログインユーザーとノートの筆者が一致しないためエラー（発生しない想定）
      return session()->flash('session_error', 'エラーが発生しました。しばらく経ってから再度お試しください。');
    }
  }
}
