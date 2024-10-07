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
        );   session()->put([
            'time_limit' => $request->time_limit,
            'number_of_questions' => $request->number_of_questions,
            'user_id' => $request->user_id,
            'topic_id' => $request->topic_id,
        ]);

        return redirect()->route('admin.quiz.createForm');
    }
        public function createQuizForm()
    {
        // dd(session()->all()); // this carries the values correctly
        $time_limit = session('time_limit');
        $number_of_questions = session('number_of_questions');
        $user_id = session('user_id');
        $topic_id = session('topic_id');

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
                'questions.*.options.a' => 'required_if:questions.*.type,multiple_choice',
                'questions.*.options.b' => 'required_if:questions.*.type,multiple_choice',
                'questions.*.options.c' => 'required_if:questions.*.type,multiple_choice',
                'questions.*.options.d' => 'required_if:questions.*.type,multiple_choice',
                'questions.*.options.e' => 'required_if:questions.*.type,true_false',
                'questions.*.options.f' => 'required_if:questions.*.type,true_false',

            ],
            [
                'title.rquired' => 'Title is required!',
                'description.required' => 'Description is required!',
                'questions.*.text.required' => 'Question is required!',
                'questions.*.options.a.required_if' => 'Answer A is required!',
                'questions.*.options.b.required_if' => 'Answer B is required!',
                'questions.*.options.c.required_if' => 'Answer C is required!',
                'questions.*.options.d.required_if' => 'Answer D is required!',



            ]
        );

    $time_limit = session('time_limit');
    $user_id = session('user_id');
    $topic_id = session('topic_id');
    $number_of_questions = session('number_of_questions');


        // dd($request->time_limit);


        // this method does not need $fillable

        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->description = $request->description;
        $quiz->time_limit   = $time_limit;
        $quiz->user_id = $user_id;
        $quiz->topic_id = $topic_id;
        $quiz->save();

        foreach ($request->questions as $questionData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $questionData['text'],
            ]);

            // Handle multiple choice or true/false
            if ($questionData['type'] === 'multiple_choice') {
                foreach (['a', 'b', 'c', 'd'] as $key) {
                    if (isset($questionData['options'][$key])) {
                        Answer::create([
                            'question_id' => $question->id,
                            'answer_text' => $questionData['options'][$key],
                            'is_correct' => ($key == $questionData['correct']),
                        ]);
                    }
                }
            } elseif ($questionData['type'] === 'true_false') {

                foreach (['e', 'f'] as $key) {
                    if (isset($questionData['options'][$key])) {
                        Answer::create([
                            'question_id' => $question->id,
                            'answer_text' => $questionData['options'][$key],
                            'is_correct' => ($key == $questionData['correct']),
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.quiz.selectForm')->with('success', 'Quiz created successfully!');
    }

    public function showQuizzes()
    {
        // Retrieve all quizzes from the database
        $quizzes = Quiz::with(['user', 'topic'])->get(); // Eager load users and topics for display

        return view('admin.quiz.show_quizzes', compact('quizzes'));
    }

    public function showQuiz($studentId, $quizId)
    {
        // Fetch the user by ID and check if the role is 'user' (student)
        $student = User::find($studentId);

        if (!$student || $student->role !== 'user') {
            // Redirect if the user doesn't exist or isn't a student
            return redirect()->route('user.quiz.show')->withErrors('Unauthorized access or user not found.');
        }

        // Retrieve the quiz along with questions and answers
        $quiz = Quiz::with(['questions.questionAnswer'])->find($quizId);



        if (!$quiz) {
            return redirect()->route('user.quiz.selectForm')->withErrors('Quiz not found.');
        }


        $adminId = $quiz->user_id;
        $timeLimit = $quiz->time_limit;


        return view('user.quiz.show', compact('quiz', 'adminId', 'quizId', 'studentId', 'timeLimit'));
    }



    public function submitQuiz(Request $request, $studentId, $quizId)
{
    $startTime = session()->get('quiz_start_time');
    $timeLimitInSeconds = $request->input('time_limit') * 60;
    $currentTime = now();

    // Check if time limit is exceeded
    if ($startTime && $currentTime->diffInSeconds($startTime) > $timeLimitInSeconds) {
        return redirect()->route('user.quiz.show', [$studentId, $quizId])
                         ->with('error', 'Time limit exceeded. Quiz was not submitted.');
    }

    // Existing quiz submission logic
    $score = 0;
    $questions = Quiz::find($quizId)->questions;

    foreach ($questions as $question) {
        $questionId = $question->id;
        $selectedAnswer = $request->answers[$questionId] ?? 'false';

        User_Answer::create([
            'user_id' => $studentId,
            'quiz_id' => $quizId,
            'question_id' => $questionId,
            'user_answer_value' => $selectedAnswer,
        ]);

        $correctAnswer = Answer::where('question_id', $questionId)
                               ->where('is_correct', 1)
                               ->first();

        if ($correctAnswer && $correctAnswer->answer_text === $selectedAnswer) {
            $score++;
        }
    }

    User_Score::create([
        'user_id' => $studentId,
        'quiz_id' => $quizId,
        'user_score' => $score,
    ]);

    return redirect()->route('user.quiz.show', [$studentId, $quizId])->with('score', $score);
}

public function retakeQuiz($studentId, $quizId)
{

    session()->forget('score');
    $quiz = Quiz::findOrFail($quizId);
    $adminId = $quiz->user_id;
    $timeLimit = $quiz->time_limit;


    return view('user.quiz.show', compact('quiz', 'studentId', 'quizId', 'adminId', 'timeLimit'));
}

}
