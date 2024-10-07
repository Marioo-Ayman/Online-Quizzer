@extends('layouts.app')

@php
$jsLinks = []; // JavaScript file names
$cssLinks = []; // CSS file names
$title = 'Select Quiz Settings';
@endphp

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-gray-100 p-8 shadow-lg rounded-lg w-full max-w-md">
        <h2 class="text-center text-xl font-bold mb-6">Select Quiz Settings</h2>

        <form action="{{ route('admin.quiz.setup') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="time_limit" class="block text-gray-700 font-semibold mb-2">Time Limit (in minutes):</label>
                <input type="number" id="time_limit" name="time_limit" value="{{ old('time_limit') }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('time_limit')
                <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-4">
                <label for="number_of_questions" class="block text-gray-700 font-semibold mb-2">Number of Questions:</label>
                <input type="number" id="number_of_questions" name="number_of_questions" value="{{ old('number_of_questions') }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('number_of_questions')
                <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-4">
    <label for="user_id" class="block text-gray-700 font-semibold mb-2">Admin:</label>
    <select name="user_id" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
        <option class="custom-option" value="">Choose admin!</option>
        @foreach ($users as $user)
            <option class="custom-option" value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
    @error('user_id')
        <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
    @enderror
</div>


<div class="mb-4">
    <label for="topic_id" class="block text-gray-700 font-semibold mb-2">Topic:</label>
    <select name="topic_id" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 overflow-y-auto scrollbar-thin scrollbar-thumb-green-500 scrollbar-track-green-500">
        <option value="" class="hover:bg-green-700 hover:text-white focus:bg-green-700 focus:text-white">Choose a topic!</option>
        @foreach ($topics as $topic)
            <option class="hover:bg-green-700 hover:text-white focus:bg-green-700 focus:text-white"
                    value="{{ $topic->id }}"
                    {{ old('topic_id') == $topic->id ? 'selected' : '' }}>
                {{ $topic->name }}
            </option>
        @endforeach
    </select>
    @error('topic_id')
        <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
    @enderror
</div>


            <button type="submit" class="w-full bg-green-700 text-white font-semibold py-2 rounded-lg shadow-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">Next</button>
        </form>
    </div>
</div>
@endsection
