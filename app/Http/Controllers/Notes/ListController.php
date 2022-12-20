<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListController extends Controller
{
  public function show()
  {
    return view('Notes.list');
  }
  public function showId( $id )
  {
    return "Hello {$id}";
  }
}
