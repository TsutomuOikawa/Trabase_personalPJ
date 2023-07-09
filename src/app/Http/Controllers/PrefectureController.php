<?php

namespace App\Http\Controllers;

use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;

class PrefectureController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($prefecture_id)
    {
        if (ctype_digit($prefecture_id)) {
            $data = Prefecture::find($prefecture_id);
            // ノートデータ
            $query = NoteController::setNotesQuery();
            $notes = $query->where('notes.prefecture_id', $prefecture_id)
                ->orderBy('note_id', 'DESC')
                ->limit(8)
                ->get();
            foreach ($notes as $note) {
                $note->isFavorite = FavoriteController::isFavorite(Auth::id(), $note->note_id);
            }

            $wishQuery = WishController::setWishesQuery();
            $wishes = $wishQuery->where('wishes.prefecture_id', $prefecture_id)
                ->get();

            return view('prefecture')
                ->with('data', $data)
                ->with('notes', $notes)
                ->with('wishes', $wishes);
        }
    }
}
