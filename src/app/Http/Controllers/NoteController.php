<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PrefectureController;
use App\Http\Requests\NoteRequest;
use App\Http\Requests\Notes\IndexRequest;
use App\Http\Requests\Notes\StoreRequest;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Note;
use App\Models\Prefecture;
use App\UseCases\Notes\IndexAction;
use App\UseCases\Notes\StoreAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class NoteController extends Controller
{

  // ノートに必要な情報を取得する基本クエリ
  public static function setNotesQuery() {
	$favorites = DB::table('favorites')
				   ->select(DB::raw('count(*) as favNum, user_id as favUser_id, note_id'))
				   ->groupBy('favUser_id', 'note_id');
	$comments = DB::table('comments')
				  ->select(DB::raw('count(*) as comNum, note_id'))
				  ->groupBy('note_id');

	$query = DB::table('notes')
				->leftJoin('users', 'notes.user_id', '=', 'users.id')
				->leftJoin('prefectures', 'notes.pref_id', '=', 'prefectures.id')
				->leftJoinSub($favorites, 'favorites', function ($join) {
					$join->on('notes.id', '=', 'favorites.note_id');
				  })
				->leftJoinSub($comments, 'comments', function ($join) {
					$join->on('notes.id', '=', 'comments.note_id');
				  })
				->select('notes.*', 'users.name', 'users.avatar', 'users.intro', 'prefectures.id', 'prefectures.name', 'favorites.favNum', 'comments.comNum')
				->where('notes.deleted_at', null);
	return $query;
  }

	// ノート一覧表示（検索）
	public function index(IndexRequest $request, IndexAction $action)
	{
		$notes = $action($request->validated());
		$prefs = Prefecture::all();
		return view('notes.index', compact('notes', 'prefs'));
	}

  // ノート詳細表示
  public function showArticle(Request $request) {
	$note_id = $request->note_id;
	$query = $this->setNotesQuery();
	$note = $query->where('notes.id', $note_id)
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
	return view('notes.create')
	  ->with('editMode', false)
	  ->with('prefs', $prefs);
  }

	// 投稿
	public function store(StoreRequest $request, StoreAction $action)
	{
		$note_id = $action($request->validated());
		return $note_id;
	}

  // ノート編集画面表示
  public function edit($note_id) {
	$note = Note::find($note_id);
	$prefs = Prefecture::all();

	return view('notes.create')
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

	if ($request->file('thumbnail')) {
	  // s3のdirに保存
	  $path = Storage::disk('s3')->putFile('thumbnail', $request->file('thumbnail'), 'public');
	  // パスを格納
	  $note->thumbnail = Storage::disk('s3')->url($path);
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
