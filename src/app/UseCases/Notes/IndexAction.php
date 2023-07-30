<?php

namespace App\UseCases\Notes;

use App\Models\Note;

class IndexAction
{
    public function __invoke(array $params)
    {
        $query = Note::query()
        ->with([
            'user',
            'prefecture',
        ])
        ->withCount([
            'favoriteUsers',
            'comments',
        ])

        // 検索条件セット
        ->when(isset($params['prefecture_name']), fn ($query) => $query->where('prefectures.name', 'like', "%{$params['prefecture_name']}%"))
        ->when(isset($params['keyword']), fn ($query) => 
            $query->where(fn ($query) => 
                $query->where('title', 'like', "%{$params['keyword']}%")
                ->orWhere('content', 'like', "%{$params['keyword']}%")
            )
        );

        if (isset($params['sort']) && $params['sort'] === 'bookmarks') {
            $query->orderBy('favNum', 'DESC');
        } elseif (isset($params['sort']) && $params['sort'] === 'comments') {
            $query->orderBy('comNum', 'DESC');
        } else {
            $query->orderBy('notes.created_at', 'DESC');
        }

        if (isset($params['num']) && $params['num'] === '20') {
            $notes = $query->paginate(20)->withQueryString();
        } elseif (isset($params['num']) && $params['num'] === '30') {
            $notes = $query->paginate(30)->withQueryString();
        } else {
            $notes = $query->paginate(10)->withQueryString();
        }

        // TODO:ログインユーザーのお気に入り状況取得
        return $notes;
    }
}
