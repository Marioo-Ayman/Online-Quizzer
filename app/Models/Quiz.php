<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public function userAnswerQuiz()
    {
        return $this->hasMany(User_Answer::class);
    }

    protected $fillable = ['title', 'description', 'time_limit', 'user_id', 'topic'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }



    // Define the relationship with Topic
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
