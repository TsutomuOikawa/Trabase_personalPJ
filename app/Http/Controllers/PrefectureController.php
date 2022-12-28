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
    public function showPref($id)
    {
        if (ctype_digit($id)) {
          // 都道府県データ
          $prefs = Prefecture::all();
          $data = $prefs->find($id);
          // ノートデータ
          $notes = Note::with('user')->where('pref_id', $id)->get();
          return view('prefecture')
            ->with('prefs', $prefs)
            ->with('data', $data)
            ->with('notes', $notes);
        }
    }
}
