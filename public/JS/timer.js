


let timeLimitInSeconds = timeLimit * 60; // converting minutes to seconds

const timer = setInterval(function() {
    let minutes = Math.floor(timeLimitInSeconds / 60);
    let seconds = timeLimitInSeconds % 60;

    document.getElementById('timer').textContent = `Time Left: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

    if (timeLimitInSeconds <= 0) {
        clearInterval(timer);
        document.querySelector('button[type="submit"]').disabled = true;
        document.getElementById('quizForm').submit(); // auto submit the form when the allowed time finish
    }

    timeLimitInSeconds--;
}, 1000);
