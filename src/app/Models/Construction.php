<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Construction extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'construction_id';

    protected $fillable = [
      'user_id',
      'pref_id',
      'place',
      'matter',
      'long',
      'completed'
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }
    public function prefecture() {
      return $this->belongsTo(Prefecture::class);
    }
}
