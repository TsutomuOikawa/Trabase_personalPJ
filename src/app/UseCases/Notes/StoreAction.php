<?php

namespace App\UseCases\Notes;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreAction
{
    public function __invoke(array $params)
    {
        $params['user_id'] = Auth::id();
        if (isset($params['thumbnail'])) {
            // s3のdirに保存
            $path = Storage::disk('s3')->putFile('thumbnail', $params['thumbnail'], 'public');
            // パスを格納
            $params['thumbnail'] = Storage::disk('s3')->url($path);
        }

        $note = Note::create($params);
        // セッションメッセージを追加
        session()->flash('session_success', 'ノートが公開されました');
        // ajaxにlastInsertIdを返却
        return $note->id;
    }
}
