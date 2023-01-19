<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PrefectureController;
use App\Models\Note;
use App\Models\Prefecture;
use Illuminate\Http\Request;


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
        $notes = Note::with('user')->with('prefecture')->orderBy('note_id', 'DESC')->take(8)->get();
        $prefs = PrefectureController::getPrefs();

        return view('index')
          ->with('notes', $notes)
          ->with('prefs', $prefs);
    }
}
