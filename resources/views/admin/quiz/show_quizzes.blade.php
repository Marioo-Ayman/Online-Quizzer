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
                    <li class="border p-4 rounded-lg bg-white shadow">
                        <h3 class="text-lg font-bold">{{ $quiz->title }}</h3>
                        <p class="text-gray-600">{{ $quiz->description }}</p>
                        <p class="text-sm text-gray-500">Admin is: {{ $quiz->user->name ?? 'Unknown' }}</p>
                        <p class="text-sm text-gray-500">Topic: {{ $quiz->topic->name ?? 'General' }}</p>
                        <p class="text-sm text-gray-500">Time Limit: {{ $quiz->time_limit }} minutes</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
