<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'intro'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notes() {
      return $this->hasMany(Note::class);
    }
    public function comments() {
      return $this->hasMany(Comment::class);
    }
    public function favorites() {
      return $this->hasMany(Favorite::class);
    }
    public function wishes() {
      return $this->hasMany(Wish::class);
    }
    public function constructions() {
      return $this->hasMany(construction::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $url = url("reset-password/${token}");
        $this->notify(new ResetPasswordNotification($url));
    }

}
