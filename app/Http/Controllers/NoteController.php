<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FavoriteController;
use App\Http\Requests\NoteRequest;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Note;
use App\Models\Prefecture;
// use App\Modules\ImageUpload\ImageManagerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class NoteController extends Controller
{
  // public function __construct(private ImageManagerInterface $imageManager)
  // {}

  // ノートに必要な情報を取得する基本クエリ
  public static function baseQueryOfGetNotes() {
    $favorites = DB::table('favorites')
                   ->select(DB::raw('count(*) as favNum, user_id as favUser_id, note_id'))
                   ->groupBy('favUser_id', 'note_id');
    $comments = DB::table('comments')
                  ->select(DB::raw('count(*) as comNum, note_id'))
                  ->groupBy('note_id');

    $query = DB::table('notes')
                ->leftJoin('users', 'notes.user_id', '=', 'users.id')
                ->leftJoin('prefectures', 'notes.pref_id', '=', 'prefectures.pref_id')
                ->leftJoinSub($favorites, 'favorites', function ($join) {
                    $join->on('notes.note_id', '=', 'favorites.note_id');
                  })
                ->leftJoinSub($comments, 'comments', function ($join) {
                    $join->on('notes.note_id', '=', 'comments.note_id');
                  })
                ->select('notes.*', 'users.name', 'users.avatar', 'users.intro', 'prefectures.pref_id', 'prefectures.pref_name', 'favorites.favNum', 'comments.comNum');
    return $query;
  }

  // ノート一覧表示（検索）
  public function showList(Request $request) {
    $query = $this->baseQueryOfGetNotes();
    // 検索条件セット
    $pref = $request->pref;
    $key = $request->key;
    $sort = $request->sort;
    $num = $request->num;
    //キーワード設定
    if ($pref) {
      $query->where('pref_name', 'like', '%'.$pref.'%');
    }
    if ($key) {
      $query->where(function($query) use($key){
        $query->where('title', 'like', '%'.$key.'%')
              ->orWhere('text', 'like', '%'.$key.'%');
      });
    }
    // ソート設定
    if ($sort === 'bookmarks') {
      $query->orderBy('favNum', 'DESC');
    }
    elseif ($sort === 'comments') {
      $query->orderBy('comNum', 'DESC');
    }
    $query->orderBy('notes.created_at', 'DESC');

    // 表示件数設定
    if ($num === '20') {
      $notes = $query->paginate(20)->withQueryString();
    }
    elseif ($num === '30') {
      $notes = $query->paginate(30)->withQueryString();
    }
    else {
      $notes = $query->paginate(10)->withQueryString();
    }

    // ログインユーザーならお気に入り状況を格納
    if (Auth::user()) {
      foreach ($notes as $note) {
        $note->isFavorite = FavoriteController::isFavorite(Auth::id(), $note->note_id);
      }
    }

    $prefs = Prefecture::all();
    return view('notes.list')
      ->with('key', ['pref'=>$pref, 'key'=>$key])
      ->with('notes', $notes)
      ->with('prefs', $prefs);
  }

  // ノート詳細表示
  public function showArticle(Request $request) {
    $note_id = $request->note_id;
    $query = $this->baseQueryOfGetNotes();
    $note = $query->where('notes.note_id', $note_id)
                  ->first();

    $note->text = json_decode($note->text, true);
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

    if ($request->thumbnail) {
      $dir = 'thumbnail';
      if (!Storage::exists('public/thumbnail')) {
        Storage::makeDirectory('public/thumbnail');
      }
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
