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
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class QuizController extends Controller
{

    public function selectForm()

    {

        $topics = Topic::all();
        return view('admin.quiz.select_quiz', ['topics' => $topics]);
        //   return view('quiz.select_quiz');
    }


    public function setupQuiz(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'time_limit' => 'required|integer',
                'number_of_questions' => 'required|integer',
            ],
            [
                'time_limit.required' => 'Required time limit!',
                'number_of_questions.required' => 'Required number of questions!',
                'user_id.required' => 'Required admin!',
            ]
        );
        if (empty($request->topic_id)) {
            $request->validate(
                [
                    'newTopic' => 'required'
                ], [
                    'newTopic.required' => 'Required topic type! (Add or Choose)',
                ]
                );
            $topic = new Topic;
            $topic->name = $request->newTopic;
            $topic->save();
            $topicId = $topic->id;
        } else {
            $request->validate(
                [
                    'topic_id' => 'required|exists:topics,id',
                ],
                [
                    'topic_id.required' => 'Required topic type! (Add or Choose)',
                ]
            );
            $topicId = $request->topic_id;
        }

        session()->put([
            'time_limit' => $request->time_limit,
            'number_of_questions' => $request->number_of_questions,
            'user_id' => Auth::user()->id,
            'topic_id' => $topicId,
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
        // Step 1: Basic validation
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
                'title.required' => 'Title is required!',
                'description.required' => 'Description is required!',
                'questions.*.text.required' => 'Question text is required!',
                'questions.*.options.a.required_if' => 'Answer A is required for multiple choice!',
                'questions.*.options.b.required_if' => 'Answer B is required for multiple choice!',
                'questions.*.options.c.required_if' => 'Answer C is required for multiple choice!',
                'questions.*.options.d.required_if' => 'Answer D is required for multiple choice!',
            ]
        );


        foreach ($request->questions as $index => $questionData) {

            if ($questionData['type'] === 'multiple_choice') {
                if (!isset($questionData['correct']) || !in_array($questionData['correct'], ['a', 'b', 'c', 'd'])) {
                    return redirect()->back()->withErrors([
                        "questions.$index.correct" => 'For question ' . ($index + 1) . ', you must choose a correct answer from A, B, C, or D.'
                    ])->withInput();
                }
            }


            if ($questionData['type'] === 'true_false') {
                if (!isset($questionData['correct']) || !in_array($questionData['correct'], ['e', 'f'])) {
                    return redirect()->back()->withErrors([
                        "questions.$index.correct" => 'For question ' . ($index + 1) . ', you must choose the correct answer (True or False).'
                    ])->withInput();
                }
            }
        }

        // Proceed to save quiz and questions if validation passes
        $time_limit = session('time_limit');
        $user_id = session('user_id');
        $topic_id = session('topic_id');
        $number_of_questions = session('number_of_questions');

        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->description = $request->description;
        $quiz->time_limit = $time_limit;
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



        return view('admin.quiz.show_quizzes', compact('quizzes'));
    }

    public function showQuiz($studentId, $quizId)
    {

        $student = User::find($studentId);

        if (!$student || $student->role !== 'user') {

            return redirect()->route('user.quiz.show')->withErrors('Unauthorized access or user not found.');
        }


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


}
