<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wish extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'wish_id';

    protected $fillable = [
      'user_id',
      'pref_id',
      'spot',
      'thing'
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }
    public function prefecture() {
      return $this->belongsTo(Prefecture::class);
    }
}
