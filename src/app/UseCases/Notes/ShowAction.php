<?php

namespace App\UseCases\Notes;

use App\Models\Note;
use Illuminate\Database\Eloquent\Builder;

class ShowAction
{
    public function __invoke(int $note_id)
    {
        $query = Note::with([
            'user',
            'prefecture',
            'comments',
        ])
            ->withCount([
                'favorites' => function (Builder $query) {
                    $query->groupBy('favorites.user_id', 'favorites.note_id');
                },
                'comments' => function (Builder $query) {
                    $query->groupBy('comments.note_id');
                },
            ])
            ->where('notes.id', $note_id)
            ->where('notes.deleted_at', null);

        $note = $query->first();
        $note->content = json_decode(note->content, true);

        // TODO:お気に入り状況チェック
        return $note;
    }
}
