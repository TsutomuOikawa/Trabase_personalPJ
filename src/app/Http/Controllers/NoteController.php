<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Requests\Notes\IndexRequest;
use App\Http\Requests\Notes\StoreRequest;
use App\Models\Note;
use App\UseCases\Notes\IndexAction;
use App\UseCases\Notes\ShowAction;
use App\UseCases\Notes\StoreAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    // ノートに必要な情報を取得する基本クエリ
    public static function setNotesQuery()
    {
        $favorites = DB::table('favorites')
            ->select(DB::raw('count(*) as favNum, user_id as favUser_id, note_id'))
            ->groupBy('favUser_id', 'note_id');
        $comments = DB::table('comments')
            ->select(DB::raw('count(*) as comNum, note_id'))
            ->groupBy('note_id');

        $query = DB::table('notes')
            ->leftJoin('users', 'notes.user_id', '=', 'users.id')
            ->leftJoin('prefectures', 'notes.prefecture_id', '=', 'prefectures.id')
            ->leftJoinSub($favorites, 'favorites', function ($join) {
                $join->on('notes.id', '=', 'favorites.note_id');
            })
            ->leftJoinSub($comments, 'comments', function ($join) {
                $join->on('notes.id', '=', 'comments.note_id');
            })
            ->select('notes.*', 'users.name', 'users.avatar', 'users.introduction', 'prefectures.id', 'prefectures.name', 'favorites.favNum', 'comments.comNum')
            ->where('notes.deleted_at', null);

        return $query;
    }

      // 一覧・検索
      public function index(IndexRequest $request, IndexAction $action)
      {
          $notes = $action($request->validated());

          return view('notes.index', compact('notes'));
      }

      // 登録
      public function store(StoreRequest $request, StoreAction $action)
      {
          $note_id = $action($request->validated());

          return $note_id;
      }

      // 詳細
      public function show(Request $request, ShowAction $action)
      {
          $note = $action($request->route('note_id'));

          return view('notes.show', compact('note'));
      }

    // ノート新規作成画面
    public function new()
    {
        return view('notes.create')
            ->with('editMode', false);
    }

    // ノート編集画面表示
    public function edit($note_id)
    {
        $note = Note::find($note_id);

        return view('notes.create')
            ->with('editMode', true)
            ->with('note', $note);
    }

    // テキストデータ取得
    public function getContent(Request $request)
    {
        $content = Note::where('note_id', $request->note_id)->value('content');
        echo $content;
    }

    // ノート更新
    public function update(NoteRequest $request)
    {
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
    public function delete(Request $request)
    {
        $login_u_id = Auth::id();
        $note = Note::find($request->route('note_id'));
        $note_u_id = $note->user_id;
        // ログインしている人が筆者なら削除する
        if ($note_u_id === $login_u_id) {
            $note->delete();
            // フラッシュメッセージ追加
            session()->flash('session_success', '投稿を削除しました');

            return redirect()->route('mypage.show', Auth::id());

        } else {
            // ログインユーザーとノートの筆者が一致しないためエラー（発生しない想定）
            return session()->flash('session_error', 'エラーが発生しました。しばらく経ってから再度お試しください。');
        }
    }
}
