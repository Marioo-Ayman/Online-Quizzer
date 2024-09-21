<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function questionQuiz()
    {
        return $this->belongsToMany(Quiz::class,'questions_quizzes');
    }
    public function questionAnswer()
    {
        return $this->hasMany(Answer::class);
    }
    public function questionUserAnswer()
    {
        return $this->hasMany(User_Answer::class);
    }
}
