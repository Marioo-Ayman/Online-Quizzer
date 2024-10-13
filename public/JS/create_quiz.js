window.onload = function () {

    var questionTypes = document.querySelectorAll('select[name^="questions"][name$="[type]"]');

    questionTypes.forEach(function (typeSelect, index) {

        toggleOptions(index);


        typeSelect.addEventListener('change', function () {
            toggleOptions(index);
        });
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

        // Clear required fields for multiple choice options
        answersContainer.querySelector('input[name="questions[' + index + '][options][a]"]').required = false;
        answersContainer.querySelector('input[name="questions[' + index + '][options][b]"]').required = false;
        answersContainer.querySelector('input[name="questions[' + index + '][options][c]"]').required = false;
        answersContainer.querySelector('input[name="questions[' + index + '][options][d]"]').required = false;

    } else {
        // Show multiple choice options and hide true/false options
        trueAndFalse.style.display = 'none';
        multipleChoiceOptions.style.display = 'block';

        // Set required fields for multiple choice questions
        answersContainer.querySelector('input[name="questions[' + index + '][options][a]"]').required = true;
        answersContainer.querySelector('input[name="questions[' + index + '][options][b]"]').required = true;
        answersContainer.querySelector('input[name="questions[' + index + '][options][c]"]').required = true;
        answersContainer.querySelector('input[name="questions[' + index + '][options][d]"]').required = true;

        // Clear required fields for true/false options
        answersContainer.querySelector('input[name="questions[' + index + '][options][e]"]').required = false;
        answersContainer.querySelector('input[name="questions[' + index + '][options][f]"]').required = false;
    }
}
