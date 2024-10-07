
    window.onload = function () {
    // Hide the true/false options initially
    var trueAndFalse = document.querySelectorAll('.trueAndFalse');
    trueAndFalse.forEach(function (element) {
        element.style.display = 'none';
    });
};

function toggleOptions(index) {
    // Get the correct type selector and answers container based on the index
    var typeSelect = document.getElementById('type-' + index);
    var answersContainer = document.getElementById('answers-container-' + index);
    var multipleChoiceOptions = answersContainer.querySelector('.multiple-choice-options');
    var trueAndFalse = answersContainer.querySelector('.trueAndFalse');

    if (typeSelect.value === 'true_false') {
        // Show the true/false options and hide multiple choice options
        multipleChoiceOptions.style.display = 'none';
        trueAndFalse.style.display = 'block';

        // Set required fields for true/false questions
        answersContainer.querySelector('input[name="questions[' + index + '][options][e]"]').required = true;
        answersContainer.querySelector('input[name="questions[' + index + '][options][f]"]').required = true;
    } else {
        // Show multiple choice options and hide true/false options
        trueAndFalse.style.display = 'none';
        multipleChoiceOptions.style.display = 'block';

        // Set required fields for multiple choice questions
        answersContainer.querySelector('input[name="questions[' + index + '][options][a]"]').required = true;
        answersContainer.querySelector('input[name="questions[' + index + '][options][b]"]').required = true;
        answersContainer.querySelector('input[name="questions[' + index + '][options][c]"]').required = true;
        answersContainer.querySelector('input[name="questions[' + index + '][options][d]"]').required = true;
    }
}

