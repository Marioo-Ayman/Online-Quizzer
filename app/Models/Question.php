<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\User_Answer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function questionQuiz()
    {
        return $this->belongsToMany(Quiz::class,'questions_quizzes');
    }

    public function questionUserAnswer()
    {
        return $this->hasMany(User_Answer::class);
    }

     protected $fillable = ['quiz_id', 'question_text'];

    public function questionAnswer()
    {
        return $this->hasMany(Answer::class);
    }
}
