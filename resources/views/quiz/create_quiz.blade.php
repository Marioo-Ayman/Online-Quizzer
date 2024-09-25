@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create a New Quiz</h2>

    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf

        <label for="title">Quiz Title:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4"></textarea><br><br>

        <input type="hidden" name="time_limit" value="{{ $time_limit }}">
        <input type="hidden" name="number_of_questions" value="{{ $number_of_questions }}">

        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <input type="hidden" name="topic" value="{{ $topic }}">


        <h3>Questions</h3>
        @for ($i = 0; $i < $number_of_questions; $i++)
            <div class="question">
            <label for="question{{ $i }}">Question {{ $i + 1 }}:</label>
            <input type="text" name="questions[{{ $i }}][text]" required><br><br>

            <label for="type{{ $i }}">Question Type:</label>
            <select name="questions[{{ $i }}][type]" id="type-{{ $i }}" onchange="toggleOptions({{ $i }})" required>
                <option value="multiple_choice">Multiple Choice</option>
                <option value="true_false">True/False</option>
            </select><br><br>

            <div class="answers-container" id="answers-container-{{ $i }}">
                <!-- Default to multiple choice (4 options) -->
                <label for="questions[{{ $i }}][options][a]">Option A:</label>
                <input type="text" name="questions[{{ $i }}][options][a]" required><br><br>
                <input type="radio" name="questions[{{ $i }}][correct]" value="a" required> Correct<br>

                <label for="questions[{{ $i }}][options][b]">Option B:</label>
                <input type="text" name="questions[{{ $i }}][options][b]" required><br><br>
                <input type="radio" name="questions[{{ $i }}][correct]" value="b"> Correct<br>

                <div class="multiple-choice-options">
                    <label for="questions[{{ $i }}][options][c]">Option C:</label>
                    <input type="text" name="questions[{{ $i }}][options][c]"><br><br>
                    <input type="radio" name="questions[{{ $i }}][correct]" value="c"> Correct<br>

                    <label for="questions[{{ $i }}][options][d]">Option D:</label>
                    <input type="text" name="questions[{{ $i }}][options][d]"><br><br>
                    <input type="radio" name="questions[{{ $i }}][correct]" value="d"> Correct<br>
                </div>
            </div>
</div>
@endfor

<button type="submit">Create Quiz</button>
</form>
</div>

<script>
    function toggleOptions(index) {
        var typeSelect = document.getElementById('type-' + index);
        var answersContainer = document.getElementById('answers-container-' + index);
        var multipleChoiceOptions = answersContainer.querySelector('.multiple-choice-options');

        if (typeSelect.value === 'true_false') {
            // Hide options C and D for true/false questions
            multipleChoiceOptions.style.display = 'none';

            // Ensure only two options are required for true/false
            answersContainer.querySelector('input[name="questions[' + index + '][options][a]"]').required = true;
            answersContainer.querySelector('input[name="questions[' + index + '][options][b]"]').required = true;
        } else {
            // Show options C and D for multiple choice questions
            multipleChoiceOptions.style.display = 'block';

            // Make sure all four options are required for multiple choice
            answersContainer.querySelector('input[name="questions[' + index + '][options][a]"]').required = true;
            answersContainer.querySelector('input[name="questions[' + index + '][options][b]"]').required = true;
            answersContainer.querySelector('input[name="questions[' + index + '][options][c]"]').required = true;
            answersContainer.querySelector('input[name="questions[' + index + '][options][d]"]').required = true;
        }
    }
</script>
@endsection
