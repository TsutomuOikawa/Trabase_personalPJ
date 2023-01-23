<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NoteController;
use App\Models\Prefecture;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MypageController extends Controller
{
    public function mypage() {
        $user = Auth::user();
        $user_id = $user->id;
        $myQuery = NoteController::baseQueryOfGetNotes();

        $myNotes = $myQuery->where('user_id', $user_id)
                            ->orderBy('notes.created_at', 'DESC')
                            ->get();
        foreach ($myNotes as $myNote) {
          $myNote->isFavorite = FavoriteController::isFavorite($user_id, $myNote->note_id);
        }

        $favQuery = NoteController::baseQueryOfGetNotes();
        $favNotes = $favQuery->where('favorites.favUser_id', $user_id)
                              ->orderBy('notes.created_at', 'DESC')
                              ->get();
        foreach ($favNotes as $favNote) {
          $favNote->isFavorite = true;
        }

        $wishes = Wish::with('user')->where('user_id', $user_id)->get();
        $prefs = Prefecture::all();
        return view('mypage')
          ->with('user', $user)
          ->with('myNotes', $myNotes)
          ->with('favNotes', $favNotes)
          ->with('wishes', $wishes)
          ->with('prefs', $prefs);
    }

}
