<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\WishController;
use App\Models\Prefecture;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrefectureController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showPref($pref_id)
    {
        if (ctype_digit($pref_id)) {
          // 都道府県データ
          $prefs = Prefecture::all();
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

          // Wish::with('user')->where('pref_id', $pref_id)->get();
          return view('prefecture')
            ->with('prefs', $prefs)
            ->with('data', $data)
            ->with('notes', $notes)
            ->with('wishes', $wishes);
        }
    }
}
