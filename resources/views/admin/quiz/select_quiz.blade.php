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
                <label for="time_limit" class="block text-gray-700 font-semibold mb-2">* Time Limit (in minutes):</label>
                <input type="number" id="time_limit" name="time_limit" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('time_limit')
                <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-4">
                <label for="number_of_questions" class="block text-gray-700 font-semibold mb-2">* Number of Questions:</label>
                <input type="number" id="number_of_questions" name="number_of_questions" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('number_of_questions')
                <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror

            </div>


            <div class="mb-4">
                <label for="topic_id" class="block text-gray-700 font-semibold mb-2">Topic:</label>
                <select name="topic_id" multiple class="w-full p-2 border rounded-lg focus:outline-none  focus:ring-2 focus:ring-green-500">
                    @foreach ($topics as $topic)
                        <option class="overflow-y-auto scrollbar-thin scrollbar-thumb-green-500 scrollbar-track-green-500
                        hover:bg-green-700 hover:text-white focus:bg-green-700 foucs:bg-white" value="{{$topic->id}}">{{$topic->name}}</option>
                    @endforeach
                </select>
                @error('topic_id')
                <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror
                @error('newTopic')
                <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="add topic" class="block text-gray-700 font-semibold mb-2">Add Topic: <br>
                    <span class="text-sm">if you don't found your topic you can add topic here.</span></label>
                <input type="text" name="newTopic" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>


            <button type="submit" class="w-full bg-green-700 text-white font-semibold py-2 rounded-lg shadow-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">Next</button>
        </form>
    </div>
</div>
@endsection
