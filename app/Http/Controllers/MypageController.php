<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NoteController;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MypageController extends Controller
{
    public function mypage() {
        $user = Auth::user();
        $user_id = $user->id;
        $myNotes = DB::table('notes')
                    ->leftJoin('users', 'notes.user_id', '=', 'users.id')
                    ->leftJoin('prefectures', 'notes.pref_id', '=', 'prefectures.pref_id')
                    ->where('user_id', $user_id)
                    ->get();
        foreach ($myNotes as $myNote) {
          $myNote->isFavorite = FavoriteController::isFavorite($user_id, $myNote->note_id);
          $myNote = NoteController::countFavsAndComs($myNote);
        }

        $favNotes = DB::table('notes')
                      ->leftJoin('users', 'notes.user_id', '=', 'users.id')
                      ->leftJoin('prefectures', 'notes.pref_id', '=', 'prefectures.pref_id')
                      ->leftJoin('favorites', 'notes.note_id', '=', 'favorites.note_id')
                      ->where('favorites.user_id', $user->id)
                      ->get();
        foreach ($favNotes as $favNote) {
          $favNote->isFavorite = true;
          $favNote = NoteController::countFavsAndComs($favNote);
        }

        $prefs = Prefecture::all();
        return view('mypage')
          ->with('user', $user)
          ->with('myNotes', $myNotes)
          ->with('favNotes', $favNotes)
          ->with('prefs', $prefs);
    }

}
