<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'favorite_id';

    protected $fillable = [
      'user_id',
      'note_id'
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }
    public function note() {
      return $this->belongsTo(Note::class);
    }

}
