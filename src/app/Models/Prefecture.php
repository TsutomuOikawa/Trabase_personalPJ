<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }

    public function constructions()
    {
        return $this->hasMany(construction::class);
    }
}
