<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Prefecture;

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
          $notes = Note::with('user')->with('prefecture')->where('pref_id', $pref_id)->get();
          return view('prefecture')
            ->with('prefs', $prefs)
            ->with('data', $data)
            ->with('notes', $notes);
        }
    }

    public static function getPrefs()
    {
      return Prefecture::all();
    }
}
