<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Topic;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $users=[
            [
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'role'=>'admin',
            'phone'=>'01550668031',
            'password'=>Hash::make('12345678'),
            ],
            [ 
                'name'=>'student1',
                'email'=>'student1@gmail.com',
                'role'=>'user',
                'phone'=>'01550888031',
                'password'=>Hash::make('12345678'),
            ],
            [ 
                'name'=>'student2',
                'email'=>'student2@gmail.com',
                'role'=>'user',
                'phone'=>'01550888031',
                'password'=>Hash::make('12345678'),
            ],
            ];

        User::insert($users);

        $topics = [
            [
                'name' => 'Programming',
            ],
            [
                'name' => 'Mathematics',
            ],
            [
                'name' => 'History',
            ],
        ];

        Topic::insert($topics);

        $quizzes = [
            [
                'title' => 'Python Quiz',
                'description' => 'Test your Python knowledge.',
                'time_limit' => 6,
                'user_id' => 1, 
                'topic_id' => 1, 
            ],
            [
                'title' => 'Calculus Quiz',
                'description' => 'Test your calculus skills.',
                'time_limit' => 9,
                'user_id' => 1, 
                'topic_id' => 2, 
            ],
            [
                'title' => 'World History Quiz',
                'description' => 'Test your knowledge of world history.',
                'time_limit' => 2,
                'user_id' => 1, 
                'topic_id' => 3, 
            ],
        ];

        Quiz::insert($quizzes);

        $questions = [
            [
                'quiz_id' => 1, 
                'question_text' => 'What is the output of the following Python code: print("Hello, world!")',
            ],
            [
                'quiz_id' => 1, 
                'question_text' => 'Python is an interpreted language.',
            ],
            [
                'quiz_id' => 2, 
                'question_text' => 'The derivative of f(x) = x^2? = 2x ',
            ],
            [
                'quiz_id' => 2, 
                'question_text' => 'What is the integral of f(x) = x^2?',
            ],
            [
                'quiz_id' => 3, 
                'question_text' => 'When did World War II start?',
            ],
            [
                'quiz_id' => 3, 
                'question_text' => 'Who was the first president of the United States?',
            ],
        ];

        Question::insert($questions);

        $answers = [
            [
                'question_id' => 1, 
                'answer_text' => 'Hello, world!',
                'is_correct' => 1,
            ],
            [
                'question_id' => 1, 
                'answer_text' => 'Print a message to the console.',
                'is_correct' => 0,
            ],
            [
                'question_id' => 1, 
                'answer_text' => 'Define a function.',
                'is_correct' => 0,
            ],
            [
                'question_id' => 2, 
                'answer_text' => 'True',
                'is_correct' => 1,
            ],
            [
                'question_id' => 2, 
                'answer_text' => 'False',
                'is_correct' => 0,
            ],
            [
                'question_id' => 3, 
                'answer_text' => 'True',
                'is_correct' => 1,
            ],
            [
                'question_id' => 3, 
                'answer_text' => 'False',
                'is_correct' => 0,
            ],
            [
                'question_id' => 4, 
                'answer_text' => 'x^3/3',
                'is_correct' => 1,
            ],
            [
                'question_id' => 4, 
                'answer_text' => 'x^4/4',
                'is_correct' => 0,
            ],
            [
                'question_id' => 4, 
                'answer_text' => 'x^1/1',
                'is_correct' => 0,
            ],
            [
                'question_id' => 4, 
                'answer_text' => 'x^5/4',
                'is_correct' => 0,
            ],
            [
                'question_id' => 5, 
                'answer_text' => '1939',
                'is_correct' => 1,
            ],
            [
                'question_id' => 5, 
                'answer_text' => '1941',
                'is_correct' => 0,
            ],
            [
                'question_id' => 5, 
                'answer_text' => '1945',
                'is_correct' => 0,
            ],
            [
                'question_id' => 6, 
                'answer_text' => 'George Washington',
                'is_correct' => 1,
            ],
            [
                'question_id' => 6, 
                'answer_text' => 'Thomas Jefferson',
                'is_correct' => 0,
            ],
            [
                'question_id' => 6, 
                'answer_text' => 'Abraham Lincoln',
                'is_correct' => 0,
            ],
        ];

        Answer::insert($answers);
    }
}
