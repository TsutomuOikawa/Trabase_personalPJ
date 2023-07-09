<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $myQuery = NoteController::setNotesQuery();

        $myNotes = $myQuery->where('user_id', $user_id)
            ->orderBy('notes.created_at', 'DESC')
            ->get();
        foreach ($myNotes as $myNote) {
            $myNote->isFavorite = FavoriteController::isFavorite($user_id, $myNote->note_id);
        }

        $favQuery = NoteController::setNotesQuery();
        $favNotes = $favQuery->where('favorites.favUser_id', $user_id)
            ->orderBy('notes.created_at', 'DESC')
            ->get();
        foreach ($favNotes as $favNote) {
            $favNote->isFavorite = true;
        }

        $wishQuery = WishController::setWishesQuery();
        $wishes = $wishQuery->where('user_id', $user_id)
            ->get();

        return view('mypage')
            ->with('user', $user)
            ->with('myNotes', $myNotes)
            ->with('favNotes', $favNotes)
            ->with('wishes', $wishes);
    }
}
