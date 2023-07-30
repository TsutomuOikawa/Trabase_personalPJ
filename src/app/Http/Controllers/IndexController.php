<?php

namespace App\Http\Controllers;

use App\Models\Note;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $notes = Note::query()
        ->with([
            'user',
            'prefecture',
        ])
        ->withCount([
            'comments',
            'favoriteUsers',
        ])
        ->orderBy('notes.id', 'DESC')
        ->limit(8)
        ->get();

        return view('index')
            ->with('notes', $notes);
    }
}
