@extends('layouts.app')

@php
$jsLinks = ['create_quiz']; // JavaScript file names
$cssLinks = []; // CSS file names
$title = 'Create Quiz';
@endphp

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-gray-200 shadow-lg rounded-lg p-6 w-full max-w-2xl">
        <h2 class="text-xl font-bold mb-4">Create a New Quiz</h2>

        <form action="{{ route('admin.quiz.store') }}" method="POST">
            @csrf

            <label for="title" class="block text-gray-700 font-semibold mb-1">Quiz Title:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50"><br><br>
            @error('title')
            <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
            @enderror


            <label for="description" class="block text-gray-700 font-semibold mb-1">Description:</label>
            <textarea name="description" id="description" rows="4" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50">{{ old('description') }}</textarea><br><br>
            @error('description')
            <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
            @enderror


            <input type="hidden" name="time_limit" value="{{ old('time_limit') }}">
            <input type="hidden" name="number_of_questions" value="{{ old('number_of_questions') }}">
            <input type="hidden" name="user_id" value="{{ old('user_id') }}">
            <input type="hidden" name="topic_id" value="{{ old('topic_id') }}">

            <h3 class="text-lg font-semibold mt-4">Questions</h3>
            @for ($i = 0; $i < $number_of_questions; $i++)
                <div class="mb-4">
                <label for="question{{ $i }}" class="block text-gray-700 font-semibold mb-1">Question {{ $i + 1 }}:</label>
                <input type="text" name="questions[{{ $i }}][text]" value="{{ old('questions.'.$i.'.text') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50">
                @error('questions.'.$i.'.text')
                <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror

                <label for="type{{ $i }}" class="block text-gray-700 font-semibold mb-1">Question Type:</label>
                <select name="questions[{{ $i }}][type]" id="type-{{ $i }}" onchange="toggleOptions({{ $i }})" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50">
                    <option value="multiple_choice" {{ old('questions.'.$i.'.type') == 'multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
                    <option value="true_false" {{ old('questions.'.$i.'.type') == 'true_false' ? 'selected' : '' }}>True/False</option>
                </select>


                <div class="answers-container" id="answers-container-{{ $i }}">
                    <!-- Default to multiple choice (4 options) -->
                    <div class="multiple-choice-options">
                    <div class="flex items-center mb-1">
                        <label for="questions[{{ $i }}][options][a]" class="block text-gray-700 font-semibold">Option A:</label>
                        <input type="text" name="questions[{{ $i }}][options][a]" value="{{ old('questions.'.$i.'.options.a') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50">
                        <input type="radio" name="questions[{{ $i }}][correct]" value="a" {{ old('questions.'.$i.'.correct') == 'a' ? 'checked' : '' }} class="ml-2 checked:bg-green-500 focus:ring-green-700">
                        @error('questions.'.$i.'.options.a')
                        <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                        @enderror
                    </div>




                    <div class="flex items-center mb-1">
                        <label for="questions[{{ $i }}][options][b]" class="block text-gray-700 font-semibold">Option B:</label>
                        <input type="text" name="questions[{{ $i }}][options][b]" value="{{ old('questions.'.$i.'.options.b') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50">
                        <input type="radio" name="questions[{{ $i }}][correct]" value="b" {{ old('questions.'.$i.'.correct') == 'b' ? 'checked' : '' }} class="ml-2 checked:bg-green-500 focus:ring-green-700">
                        @error('questions.'.$i.'.options.b')
                        <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                        @enderror
                    </div>





                        <div class="flex items-center mb-1">
                            <label for="questions[{{ $i }}][options][c]" class="block text-gray-700 font-semibold">Option C:</label>
                            <input type="text" name="questions[{{ $i }}][options][c]" value="{{ old('questions.'.$i.'.options.c') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50">
                            <input type="radio" name="questions[{{ $i }}][correct]" value="c" {{ old('questions.'.$i.'.correct') == 'c' ? 'checked' : '' }} class="ml-2 checked:bg-green-500 focus:ring-green-700">
                            @error('questions.'.$i.'.options.c')
                            <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="flex items-center mb-1">
                            <label for="questions[{{ $i }}][options][d]" class="block text-gray-700 font-semibold">Option D:</label>
                            <input type="text" name="questions[{{ $i }}][options][d]" value="{{ old('questions.'.$i.'.options.d') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-opacity-50">
                            <input type="radio" name="questions[{{ $i }}][correct]" value="d" {{ old('questions.'.$i.'.correct') == 'd' ? 'checked' : '' }} class="ml-2 checked:bg-green-500 focus:ring-green-700">
                            @error('questions.'.$i.'.options.d')
                            <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>


                    <div class="trueAndFalse" style="display: none">
                    <div class="flex items-center mb-1">
                        <label for="questions[{{ $i }}][options][e]" class="block text-gray-700 font-semibold">True</label>
                        <input type="hidden" name="questions[{{ $i }}][options][e]" value="true">
                        <input type="radio" name="questions[{{ $i }}][correct]" value="e" {{ old('questions.'.$i.'.correct') == 'e' ? 'checked' : '' }} class="ml-2 checked:bg-green-500 focus:ring-green-700">
                        @error('questions.'.$i.'.options.e')
                        <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                        @enderror
                    </div>




                    <div class="flex items-center mb-1">
                        <label for="questions[{{ $i }}][options][f]" class="block text-gray-700 font-semibold">False</label>
                        <input type="hidden" name="questions[{{ $i }}][options][f]" value="false">
                        <input type="radio" name="questions[{{ $i }}][correct]" value="f" {{ old('questions.'.$i.'.correct') == 'f' ? 'checked' : '' }} class="ml-2 checked:bg-green-500 focus:ring-green-700">
                        @error('questions.'.$i.'.options.f')
                        <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    </div>
    @endfor

    <button type="submit" class="mt-4 bg-green-600 text-white font-semibold py-2 px-4 rounded-lg w-full hover:bg-green-700">Create Quiz</button>
    </form>
</div>
</div>

<script src="{{ asset('js/quiz.js') }}"></script>
@endsection
