<?php

namespace App\Models;

use App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'time_limit'];

    public function userAnswerQuiz()
    {
        return $this->hasMany(User_Answer::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Assuming the user_id is the foreign key
    }

    public function score()
    {
        return $this->hasMany(User_Score::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'quizzes_users')
            ->where('role', 'user'); // Only users with the role of 'user' are considered students
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
