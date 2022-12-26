<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;
    protected $primaryKey = 'pref_id';

    public function notes() {
      return $this->hasMany(Note::class);
    }
}
