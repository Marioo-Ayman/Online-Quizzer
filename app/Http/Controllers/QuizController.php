<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Topic;
use App\Models\User;
use App\Models\User_Answer;
use App\Models\User_Score;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class QuizController extends Controller
{

    public function selectForm()

    {
        $users = User::all();
        $topics = Topic::all();
        return view('admin.quiz.select_quiz', ['users' => $users, 'topics' => $topics]);
        //   return view('quiz.select_quiz');
    }


    public function setupQuiz(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'time_limit' => 'required|integer',
                'number_of_questions' => 'required|integer',
                'user_id' => [
                    'required',
                    Rule::exists('users', 'id')->where(function ($query) {
                        $query->where('role', 'admin');
                    }),
                ],

                'topic_id' => 'required|exists:topics,id',

            ],
            [
                'time_limit.required' => 'Required time limit!',
                'number_of_questions.required' => 'Required number of questions!',
                'user_id.required' => 'Required admin!',
                'user_id.exists' => 'Admin should be chosen!',
                'topic_id.required' => 'Required topic type!',
            ]
        );



        return redirect()->route('admin.quiz.createForm')
            ->with([
                'time_limit' => $request->time_limit,
                'number_of_questions' => $request->number_of_questions,
                'user_id' => $request->user_id,
                'topic_id' => $request->topic_id,

            ]);
    }


    public function createQuizForm()
    {
        $time_limit = old('time_limit', session('time_limit'));
        $number_of_questions = old('number_of_questions', session('number_of_questions'));
        $user_id = old('user_id', session('user_id'));
        $topic_id = old('topic_id', session('topic_id'));

        // Optional: Uncomment if you want to enforce previous step completion
        // if (!$time_limit || !$number_of_questions || !$user_id || !$topic_id) {
        //     return redirect()->route('quiz.selectForm')->withErrors('Please complete the previous step.');
        // }

        return view('admin.quiz.create_quiz', compact('time_limit', 'number_of_questions', 'user_id', 'topic_id'));
    }


    public function store(Request $request)
    {
        // this validate fn takes assoc array with the name that exist in my form
        $request->validate(
            [
                'title' => 'required|max:50',
                'description' => 'required|max:250',
                'questions.*.text' => 'required',
                'questions.*.options.a' => 'required',
                'questions.*.options.b' => 'required',
                'questions.*.options.c' => 'required_if:questions.*.type,multiple_choice',
                'questions.*.options.d' => 'required_if:questions.*.type,multiple_choice',
            ],
            [
                'title.rquired' => 'Title is required!',
                'description.required' => 'Description is required!',
                'questions.*.text.required' => 'Question is required!',
                'questions.*.options.a.required' => 'Answer A is required!',
                'questions.*.options.b.required' => 'Answer B is required!',
                'questions.*.options.c.required_if' => 'Answer C is required!',
                'questions.*.options.d.required_if' => 'Answer D is required!',

            ]
        );


        // this method does not need $fillable

        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->description = $request->description;
        $quiz->time_limit   = $request->time_limit;
        $quiz->user_id = $request->user_id;
        $quiz->topic_id = $request->topic_id;
        $quiz->save();

        foreach ($request->questions as $questionData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $questionData['text'],
            ]);

            // Handle multiple choice or true/false
            if ($questionData['type'] === 'multiple_choice') {
                foreach (['a', 'b', 'c', 'd'] as $key) {
                    if (!empty($questionData['options'][$key])) {
                        Answer::create([
                            'question_id' => $question->id,
                            'answer_text' => $questionData['options'][$key],
                            'is_correct' => ($key == $questionData['correct']),
                        ]);
                    }
                }
            } elseif ($questionData['type'] === 'true_false') {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => 'True',
                    'is_correct' => ($questionData['correct'] === 'true'),
                ]);
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => 'False',
                    'is_correct' => ($questionData['correct'] === 'false'),
                ]);
            }
        }

        return redirect()->route('quiz.selectForm')->with('success', 'Quiz created successfully!');
    }
}
