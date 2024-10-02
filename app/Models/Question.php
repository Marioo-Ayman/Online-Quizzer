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

    protected $fillable = ['quiz_id', 'question_text'];

    public function questionQuiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function questionUserAnswer()
    {
        return $this->hasMany(User_Answer::class);
    }

    public function questionAnswer()
    {
        return $this->hasMany(Answer::class);
    }
}
