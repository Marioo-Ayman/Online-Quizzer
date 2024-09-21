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
}
