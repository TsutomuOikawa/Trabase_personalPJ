<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $primaryKey = 'note_id';

    protected $fillable = [
      'user_id',
      'pref_id',
      'title',
    ];
}
