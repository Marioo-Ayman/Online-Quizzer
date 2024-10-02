// Countdown timer function
let timeLimit = {{ $timeLimit }} * 60; // Convert minutes to seconds

const timer = setInterval(function() {
    let minutes = Math.floor(timeLimit / 60);
    let seconds = timeLimit % 60;

    document.getElementById('timer').textContent = `Time Left: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

    if (timeLimit <= 0) {
        clearInterval(timer);
        document.getElementById('quizForm').submit(); // Auto-submit the quiz form
    }

    timeLimit--;
}, 1000);
