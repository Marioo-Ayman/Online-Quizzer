@extends('layouts.app')

@php
$jsLinks = []; // JavaScript file names
$cssLinks = []; // CSS file names
$title = 'Quiz';
@endphp

@section('content')
<div class="container mx-auto flex items-center justify-center min-h-screen">
    <div class="bg-gray-200 shadow-lg rounded-lg p-6 w-full max-w-lg mx-auto">
        <h2 class="text-xl font-bold mb-4">{{ $quiz->title }}</h2>
        <p class="mb-4">{{ $quiz->description }}</p>

        <!-- Timer -->
        @if (!session()->has('score'))
        <div id="timer" class="text-red-600 font-bold mb-4"></div>
        @endif

        <!-- Score Section -->
        @if(session()->has('score'))
        <div class="bg-green-300 p-2 rounded mb-4">
            Your score: {{ session('score') }} out of {{ count($quiz->questions) }}
        </div>
        <!-- Retake Quiz Button -->
        <form action="{{ route('user.quiz.retake', ['studentId' => $studentId, 'quizId' => $quizId]) }}" method="GET">
            <button type="submit" class="w-full bg-green-700 text-white font-semibold py-2 rounded-lg shadow-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                Retake Quiz
            </button>
        </form>
        @endif

        <!-- Quiz Form -->
        <form id="quizForm" action="{{ route('user.quiz.submit', ['studentId' => $studentId, 'quizId' => $quizId]) }}" method="POST">
            @csrf
            <input type="hidden" name="admin_id" value="{{ $adminId }}">
            <input type="hidden" name="quiz_id" value="{{ $quizId }}">
            <input type="hidden" name="student_id" value="{{ $studentId }}">
            <input type="hidden" name="time_limit" value="{{ $timeLimit }}">

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

        <!-- Timer Script -->
        @if (!session()->has('score'))
        <script>
            let timeLimit = {{ $timeLimit }} * 60; // Convert minutes to seconds

            const timer = setInterval(function() {
                let minutes = Math.floor(timeLimit / 60);
                let seconds = timeLimit % 60;

                document.getElementById('timer').textContent = `Time Left: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

                if (timeLimit <= 0) {
                    clearInterval(timer);
                    document.getElementById('quizForm').submit(); // Auto-submit the form when the time runs out
                }

                timeLimit--;
            }, 1000);
        </script>
        @endif

    </div>
</div>
@endsection
