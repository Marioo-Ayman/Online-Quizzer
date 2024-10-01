<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Score extends Model
{
    use HasFactory;
    protected $table = 'users_score'; // Correct table name

    protected $fillable = ['quiz_id', 'user_id', 'score'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
