<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{
  public function show()
  {
    return 'Hello';
  }
  public function showId($id)
  {
    return "Hello {$id}";
  }
}
