<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Auth;

class PrefectureController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPref($pref_id)
    {
        if (ctype_digit($pref_id)) {
          $data = $prefs->find($pref_id);
          // ノートデータ
          $query = NoteController::setNotesQuery();
          $notes = $query->where('notes.pref_id', $pref_id)
                          ->orderBy('note_id', 'DESC')
                          ->limit(8)
                          ->get();
          foreach ($notes as $note) {
            $note->isFavorite = FavoriteController::isFavorite(Auth::id(), $note->note_id);
          }

          $wishQuery = WishController::setWishesQuery();
          $wishes = $wishQuery->where('wishes.pref_id', $pref_id)
                              ->get();

          return view('prefecture')
            ->with('data', $data)
            ->with('notes', $notes)
            ->with('wishes', $wishes);
        }
    }
}
