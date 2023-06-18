<?php

namespace App\UseCases\notes;

use App\Models\Note;
use Illuminate\Database\Eloquent\Builder;

class IndexAction
{
    public function __invoke(array $params)
    {
        $query = Note::with([
            'users',
            'prefectures',
        ])
        ->withcount([
            'favorites' => function(Builder $query) {
                $query->groupBy('favorites.user_id', 'favorites.note_id');
            },
            'comments' => function(Builder $query) {
                $query->groupBy('comments.note_id');
            },
        ])
        ->where('notes.deleted_at', null)

        // 検索条件セット
        ->when(isset($params['pref']), fn($query) => $query->where('pref_name', 'like', "%{$params['pref']}%"))
        ->when(isset($params['keyword']), fn($query) => $query->where( fn($query) =>
            $query->where('title', 'like', "%{$params['keyword']}%")
                ->orWhere('text', 'like', "%{$params['keyword']}%")
            )
        );

        if (isset($params['sort']) && $params['sort'] === 'bookmarks') {
            $query->orderBy('favNum', 'DESC');
        }
        elseif (isset($params['sort']) && $params['sort'] === 'comments') {
            $query->orderBy('comNum', 'DESC');
        }
        else {
            $query->orderBy('notes.created_at', 'DESC');
        }

        if (isset($params['num']) && $params['num'] === '20') {
            $notes = $query->paginate(20)->withQueryString();
        }
        elseif (isset($params['num']) && $params['num'] === '30') {
            $notes = $query->paginate(30)->withQueryString();
        }
        else {
            $notes = $query->paginate(10)->withQueryString();
        }

        // TODO:ログインユーザーのお気に入り状況取得
        return $notes;
    }
}
