<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $query = NoteController::setNotesQuery();
        $notes = $query->orderBy('notes.created_at', 'DESC')
                        ->limit(8)
                        ->get();
        foreach ($notes as $note) {
          $note->isFavorite = FavoriteController::isFavorite(Auth::id(), $note->id);
        }

        return view('index')
          ->with('notes', $notes);
    }
}
