<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $primaryKey = 'note_id';

    protected $fillable = [
      'pref_id',
      'title',
      'img',
      'text'
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }
    public function prefecture() {
      return $this->belongsTo(Prefecture::class);
    }
}
