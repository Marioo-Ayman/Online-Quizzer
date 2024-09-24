<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Routing\Controllers\HasMiddleware;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // public function getRoleAttribute()
    // {
    //     return $this->attributes['role'];
    // }



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function userScore()
    {
        return $this->hasMany(User_Score::class);
    }
    public function userAnswer()
    {
        return $this->hasMany(User_Answer::class);
    }
    public function userQuizzes()
    {
        return $this->belongsToMany(Quiz::class,'quizzes_users');
    }
}
