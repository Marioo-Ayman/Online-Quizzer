@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Select Quiz Settings</h2>

    <form action="{{ route('quiz.setup') }}" method="POST">
        @csrf

        <label for="time_limit">Time Limit (in minutes):</label>
        <input type="number" id="time_limit" name="time_limit" min="1" required><br><br>

        <label for="number_of_questions">Number of Questions:</label>
        <input type="number" id="number_of_questions" name="number_of_questions" min="1" required><br><br>


        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Admin</label>
            <select name="user_id" class="form-input mt-1 block w-full rounded-md shadow-sm focus:outline-none border border-black/15 p-2">
                @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="topic_id" class="block text-gray-700 text-sm font-bold mb-2">Topic</label>
            <select name="topic_id" multiple class="form-input mt-1 block w-full rounded-md shadow-sm focus:outline-none border border-black/15 p-2">
                @foreach ($topics as $topic)
                <option value="{{$topic->id}}">{{$topic->name}}</option>
                @endforeach
            </select>
            @error('topic_id')
            <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Next</button>
    </form>
</div>
@endsection
