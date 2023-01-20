<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'note_id';

    protected $fillable = [
      'user_id',
      'pref_id',
      'title',
      'thumbnail',
      'text'
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }
    public function prefecture() {
      return $this->belongsTo(Prefecture::class, 'pref_id');
    }
    public function comments() {
      return $this->hasMany(Comment::class);
    }
    public function favorites() {
      return $this->hasMany(Favorite::class);
    }
}
