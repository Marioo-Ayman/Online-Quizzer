@extends('layouts.app')

@php
$jsLinks = ['create_quiz']; // JavaScript file names
$cssLinks = []; // CSS file names
$title = 'Edit Quiz';
@endphp

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-gray-200 shadow-lg rounded-lg p-6 w-full max-w-2xl">
        <h2 class="text-xl font-bold mb-4">Edit Quiz</h2>


        <form action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST">
    @csrf
    @method('PUT')


    <label for="title" class="block text-gray-700 font-semibold mb-1">Quiz Title:</label>
    <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50"><br><br>
    @error('title')
    <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
    @enderror

    <label for="description" class="block text-gray-700 font-semibold mb-1">Description:</label>
    <textarea name="description" id="description" rows="4" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50">{{ old('description', $quiz->description) }}</textarea><br><br>
    @error('description')
    <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
    @enderror

    <div class="mb-4">
                <label for="time_limit" class="block text-gray-700 font-semibold mb-2">Time Limit (in minutes):</label>
                <input type="number" id="time_limit" value="{{ old('time_limit', $quiz->time_limit) }}" name="time_limit" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('time_limit')
                <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror
            </div>

    <h3 class="text-lg font-semibold mt-4">Questions</h3>
    @foreach ($quiz->questions as $i => $question)
    <div class="mb-4">
        <label for="question{{ $i }}" class="block text-gray-700 font-semibold mb-1">Question {{ $i + 1 }}:</label>
        <input type="text" name="questions[{{ $i }}][id]" value="{{ $question->id }}" hidden>
        <input type="text" name="questions[{{ $i }}][question_text]" value="{{ old('questions.'.$i.'.question_text', $question->question_text) }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50">
        @error('questions.'.$i.'.question_text')
        <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
        @enderror

        <div class="answers-container" id="answers-container-{{ $i }}">
            @foreach ($question->questionAnswer as $j => $answer)
            <div class="flex items-center mb-1">
                <label for="questions[{{ $i }}][answers][{{ $j }}][answer_text]" class="block text-gray-700 font-semibold">Answer {{ $j + 1 }}:</label>
                <input type="text" name="questions[{{ $i }}][answers][{{ $j }}][id]" value="{{ $answer->id }}" hidden>
                <input type="text" name="questions[{{ $i }}][answers][{{ $j }}][answer_text]"
                       value="{{ old('questions.'.$i.'.answers.'.$j.'.answer_text', $answer->answer_text) }}"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50">
                       <input type="radio" name="questions[{{ $i }}][correct]" value="{{ $answer->id }}"
    {{ old('questions.'.$i.'.correct', $question->questionAnswer->where('is_correct', true)->first()->id ?? null) == $answer->id ? 'checked' : '' }}
    class="ml-2 checked:bg-green-500 focus:ring-green-700">

                @error('questions.'.$i.'.answers.'.$j.'.answer_text')
                <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror
            </div>
            @endforeach
        </div>
    </div>
    @error('questions.' . $i . '.correct')
                    <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                    @enderror
    @endforeach


    <button type="submit" class="mt-4 bg-green-600 text-white font-semibold py-2 px-4 rounded-lg w-full hover:bg-green-700">Update Quiz</button>
</form>





    </div>
</div>
@endsection
