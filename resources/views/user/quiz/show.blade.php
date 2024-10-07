@extends('layouts.app')

@php
$jsLinks = ['timer.js']; // JavaScript file names
$cssLinks = []; // CSS file names
$title = 'Quiz';
@endphp

@section('content')
<div class="container mx-auto flex items-center justify-center min-h-screen">
    <div class="bg-gray-200 shadow-lg rounded-lg p-6 w-full max-w-lg mx-auto">
        <h2 class="text-xl font-bold mb-4">{{ $quiz->title }}</h2>
        <p class="mb-4">{{ $quiz->description }}</p>

        <!-- Display Timer Only When Quiz Starts -->

        @if(session()->has('score'))
        <div class="bg-green-300 p-2 rounded mb-4">
            Your score: {{ session('score') }} out of {{ count($quiz->questions) }}
        </div>

        <!-- Retake Quiz Button -->
         @if(session('score') < count($quiz->questions))
        <form action="{{ route('user.quiz.retake', ['studentId' => $studentId, 'quizId' => $quizId]) }}" method="GET">
            <button type="submit" class="w-full bg-green-700 text-white font-semibold py-2 rounded-lg shadow-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                Retake Quiz
            </button>
        </form>
        @endif
        @endif

        @if (!session()->has('score'))
        <div id="timer" class="text-red-600 font-bold mb-4"></div>

        <form id="quizForm" action="{{ route('user.quiz.submit', ['studentId' => $studentId, 'quizId' => $quizId]) }}" method="POST">
            @csrf
            <input type="hidden" name="admin_id" value="{{ old('adminId') }}">
            <input type="hidden" name="quiz_id" value="{{ old('quizId') }}">
            <input type="hidden" name="student_id" value="{{ old('studentId') }}">
            <input type="hidden" name="time_limit" value="{{ old('timeLimit') }}">
            @foreach($quiz->questions as $question)
            <div class="mb-4">
                <label class="block mb-2">{{ $question->question_text }}</label>
                @foreach($question->questionAnswer as $answer)
                <div>
                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->answer_text }}" class="form-radio ml-2 checked:bg-green-500 focus:ring-green-700 focus:bg-green-700">
                    <span>{{ $answer->answer_text }}</span>
                </div>
                @endforeach
            </div>
            @endforeach

            <button type="submit" class="w-full bg-green-700 text-white font-semibold py-2 rounded-lg shadow-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">Submit Answers</button>
        </form>

        @endif
    </div>
</div>
<script>
    let timeLimit = {{ $timeLimit }};
</script>
<script src="{{ asset('JS/timer.js') }}"></script>

@endsection
