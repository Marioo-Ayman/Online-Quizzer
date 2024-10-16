@extends('layouts.app')

@php
    $jsLinks = []; // JavaScript file names
    $cssLinks = []; // CSS file names
    $title = 'Show Quizzes';
@endphp

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-xl font-semibold mb-4">Stored Quizzes</h2>

    <div class="bg-gray-200 shadow-lg rounded-lg p-6">
        @if($quizzes->isEmpty())
            <p>No quizzes available.</p>
        @else
            <ul class="space-y-4">
                @foreach ($quizzes as $quiz)
                <li class="border p-6 rounded-lg bg-white shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <h3 class="text-xl font-bold text-blue-1000">{{ $quiz->title }}</h3>
                    <p class="text-gray-700 mt-2">{{ $quiz->description }}</p>
                    <p class="text-sm text-gray-500 mt-4">Creator: <span class="font-medium text-gray-800">{{ $quiz->user->name ?? 'Unknown' }}</span></p>
                    <p class="text-sm text-gray-500">Topic: <span class="font-medium text-gray-800">{{ $quiz->topic->name ?? 'General' }}</span></p>
                    <p class="text-sm text-gray-500">Time Limit: <span class="font-medium text-gray-800">{{ $quiz->time_limit }} minutes</span></p>
                    <a href="{{ route('admin.quiz.editForm', ['id' => $quiz->id]) }}" class="mt-4 inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                Edit Quiz
            </a>

            <form action="{{ route('admin.quiz.destroy', ['id' => $quiz->id]) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="mt-4 inline-block bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600 transition duration-200"
            onclick="return confirm('Are you sure you want to delete this quiz?')">
        Delete Quiz
    </button>
</form>

                </li>


                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
