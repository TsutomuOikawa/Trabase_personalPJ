<?php

namespace App\UseCases\Mypage;

use App\Models\User;

class ShowAction
{
    public function __invoke($user_id)
    {
        $user = User::with([
            'notes',
            'notes.prefecture',
            'favoriteNotes',
            'favoriteNotes.comments',
            'favoriteNotes.favoriteUsers',
            'favoriteNotes.prefecture',
            'favoriteNotes.user',
            'wishes',
            'wishes.prefecture',
        ])
        ->where('users.id', $user_id)
        ->first();

        return $user;
    }
}
