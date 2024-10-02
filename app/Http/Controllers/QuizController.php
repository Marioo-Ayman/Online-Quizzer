<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function selectForm()

    {
        $users = User::all();
        $topics = Topic::all();
        return view('quiz.select_quiz', ['users' => $users, 'topics' => $topics]);
        //   return view('quiz.select_quiz');
    }


    public function setupQuiz(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'time_limit' => 'required|integer|min:1',
            'number_of_questions' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
            'topic_id' => 'required|exists:topics,id',

        ]);


        return redirect()->route('quiz.createForm')
            ->with([
                'time_limit' => $request->time_limit,
                'number_of_questions' => $request->number_of_questions,
                'user_id' => $request->user_id,
                'topic_id' => $request->topic_id,

            ]);
    }


    public function createQuizForm()
    {
        // dd(session()->all());

        $time_limit = session('time_limit');
        $number_of_questions = session('number_of_questions');

        $user_id = session('user_id');
        $topic_id = session('topic_id');

        if (!$time_limit || !$number_of_questions || !$user_id || !$topic_id) {
            return redirect()->route('quiz.selectForm')->withErrors('Please complete the previous step.');
        }

        return view('quiz.create_quiz', compact('time_limit', 'number_of_questions', 'user_id', 'topic_id'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'questions.*.text' => 'required',
            'questions.*.options.a' => 'required',
            'questions.*.options.b' => 'required',
        ]);
        // $quiz = Quiz::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'time_limit' => $request->time_limit,


        // ]);

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

    public function show($id) {
        $quiz = Quiz::find($id);
        $questions = Question::where('quiz_id', '=', $quiz->id)->get();
        $sz = count($questions);
        for ($i = 0; $i < $sz; $i++) {
            $answers[] = [Answer::where('question_id','=', $questions[$i]->id)->get()];
        }
        $topic = Topic::where('id', '=', $quiz->topic_id)->get();
        return view('quiz/quiz', [
            'quiz' => $quiz,
            'topic' => $topic,
            'questions'=> $questions,
            'answers' => $answers
        ]);
    }

}
