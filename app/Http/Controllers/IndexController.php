<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NoteController;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $notes = DB::table('notes')
                    ->leftJoin('users', 'notes.user_id', '=', 'users.id')
                    ->select('notes.*', 'users.id', 'users.name', 'users.avatar', 'users.intro')
                    ->orderBy('notes.created_at', 'DESC')
                    ->limit(8)
                    ->get();
        foreach ($notes as $note) {
          $note->isFavorite = FavoriteController::isFavorite(Auth::id(), $note->note_id);
          $note = NoteController::countFavsAndComs($note);
        }
        $prefs = Prefecture::all();

        return view('index')
          ->with('notes', $notes)
          ->with('prefs', $prefs);
    }
}
