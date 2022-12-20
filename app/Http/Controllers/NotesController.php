<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\CreateRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
  // ノート一覧表示（検索なし）
  public function showList(Request $request)
  {
    $notes = Note::all();
    return view('notes.list')
      -> with('notes', $notes);
  }
  // ノート検索

  // ノートフォーム
  public function showForm()
  {
    return view('notes.form');
  }
  public function create(CreateRequest $request)
  {


  }

}
