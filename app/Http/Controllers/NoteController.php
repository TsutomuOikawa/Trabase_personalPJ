<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FavoriteController;
use App\Http\Requests\NoteRequest;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Note;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
  // お気に入り数とコメント数を取得する関数
  public static function countFavsAndComs($note) {
    $note->favNum = FavoriteController::countFavorites($note->note_id);
    $note->comNum = CommentController::countComments($note->note_id);;
    return $note;
  }

  // ノート一覧表示（検索）
  public function showList(Request $request) {
    $pref = $request->pref;
    $key = $request->key;

    $query = DB::table('notes')
                ->leftJoin('users', 'notes.user_id', '=', 'users.id')
                ->leftJoin('prefectures', 'notes.pref_id', '=', 'prefectures.pref_id');
    if ($pref) {
      $query->where('pref_name', 'like', '%'.$pref.'%');
    }
    if ($key) {
      $query->where(function($query) use($key){
        $query->where('title', 'like', '%'.$key.'%')
              ->orWhere('text', 'like', '%'.$key.'%');
      });
    }
    // データを取得
    $notes = $query->select('notes.*', 'users.id', 'users.name', 'users.avatar', 'users.intro', 'prefectures.pref_name', 'prefectures.pref_id')
                    ->orderBy('note_id', 'DESC')
                    ->get();
    // お気に入り状況等を格納
    foreach ($notes as $note) {
      $note = $this->countFavsAndComs($note);
      $note->isFavorite = FavoriteController::isFavorite(Auth::id(), $note->note_id);
    }
    $prefs = Prefecture::all();

    return view('notes.list')
      ->with('key', [$pref, $key])
      ->with('notes', $notes)
      ->with('prefs', $prefs);
  }

  // ノート詳細表示
  public function showArticle(Request $request) {
    $note_id = $request->note_id;
    $note = DB::table('notes')
                ->leftJoin('users', 'notes.user_id', '=', 'users.id')
                ->leftJoin('prefectures', 'notes.pref_id', '=', 'prefectures.pref_id')
                ->where('note_id', $note_id)
                ->select('notes.*', 'users.id', 'users.name', 'users.avatar', 'users.intro', 'prefectures.pref_name')
                ->orderBy('note_id', 'DESC')
                ->first();

    $note->text = json_decode($note->text, true);
    $note = $this->countFavsAndComs($note);
    $note->isFavorite = FavoriteController::isFavorite(Auth::id(), $note_id);

    $comments = Comment::where('note_id', $note_id)->with('user')->get();
    $prefs = Prefecture::all();

    return view('notes.article')
      ->with('note', $note)
      ->with('comments', $comments)
      ->with('prefs', $prefs);
  }

  // ノート新規作成画面
  public function new() {
    $prefs = Prefecture::all();
    return view('notes.editor')
      ->with('editMode', false)
      ->with('prefs', $prefs);
  }

  // 投稿
  public function storeNote(NoteRequest $request) {
    $note = new Note;
    $note->user_id = Auth::id();
    $note->fill($request->all());

    if ($note->thumbnail) {
      $dir = 'thumbnail';
      $path = $request->thumbnail->store('public/'.$dir);
      $note->thumbnail = str_replace('public/', 'storage/', $path);
    }
    $note->save();

    // セッションメッセージを追加
    session()->flash('session_success', 'ノートが公開されました');
    // ajaxにlastInsertIdを返却
    echo $note->note_id;
  }

  // ノート編集画面表示
  public function edit($note_id) {
    $note = Note::find($note_id);
    $prefs = Prefecture::all();

    return view('notes.editor')
      ->with('editMode', true)
      ->with('note', $note)
      ->with('prefs', $prefs);
  }

  // テキストデータ取得
  public function getText(Request $request) {
    $text = Note::where('note_id', $request->note_id)->value('text');
    echo $text;
  }

  // ノート更新
  public function update(NoteRequest $request) {
    $note = Note::find($request->route('note_id'));
    $note->fill($request->all());

    if ($note->thumbnail) {
      $dir = 'thumbnail';
      $path = $request->thumbnail->store('public/'.$dir);
      $note->thumbnail = str_replace('public/', 'storage/', $path);
    }
    $note->save();

    // セッションメッセージを追加
    session()->flash('session_success', 'ノートを更新しました');
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
