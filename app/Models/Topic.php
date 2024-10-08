<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;


    protected $fillable = ['name'];

    // Define the relationship with Quiz
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

}
