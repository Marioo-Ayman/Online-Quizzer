<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Answer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'quiz_id', 'question_id', 'user_answer_value'];
    // Explicitly set the table name

    protected $table = 'users_answers';
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answerUserQuestion()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
