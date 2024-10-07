


document.querySelectorAll('.slider').forEach(slider => {
    let = isDragging = false,
        startPosition = 0,
        currnetTranslate = 0,
        previousTranslate = 0;

    slider.addEventListener('mousedown', startDrag);
    slider.addEventListener('mousemove', drag);
    slider.addEventListener('mouseup', endDrag);
    slider.addEventListener('mouseleave', endDrag);

    slider.addEventListener('touchstart', startDrag);
    slider.addEventListener('touchmove', drag);
    slider.addEventListener('touchend', endDrag);
    slider.addEventListener('touchcancel', endDrag);

    function startDrag(event) {
        isDragging = true;
        startPosition = getPosition(event);
        slider.style.cursor = 'grabbing';
    }

    function drag(event) {
        if (!isDragging) return;

        const currentPosition = getPosition(event),
        movedBy = currentPosition - startPosition;
        currnetTranslate = previousTranslate + movedBy;

        const sliderWidth = slider.scrollWidth,
        containerWidth = slider.parentElement.clientWidth;

        const maxTranslate = 0,
        minTranslate = containerWidth - sliderWidth;

        currnetTranslate = Math.max(Math.min(currnetTranslate, maxTranslate), minTranslate);

        slider.style.transform = `translateX(${currnetTranslate}px)`;
    }

    function endDrag() {
        isDragging = false;
        previousTranslate = currnetTranslate;
        slider.style.cursor = 'grab';
    }

    function getPosition(event) {
        return event.type.includes('mouse') ? event.clientX : event.touches[0].clientX;
    }

});


document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-box');
    searchInput.addEventListener('keyup', search);
    function search() {
        const query = searchInput.value.toLowerCase(),
        topicItems = document.querySelectorAll('.topic-items');

        topicItems.forEach(topic => {
            const topicName = topic.querySelector('span.text-3xl').textContent.toLowerCase(),
            quizCards = topic.querySelectorAll('.slider li');
            let topicHasVisibleQuiz = false;

            // If the topic name matches the search query, show all quizzes under this topic
            if (topicName.includes(query)) {
                topic.style.display = ''; // Show the entire topic
                quizCards.forEach(card => {
                    card.style.display = ''; // Show all quizzes under this topic
                });
                topicHasVisibleQuiz = true; // Mark that the topic should be visible
            } else {
                // Otherwise, check each quiz card's title, description, and author
                quizCards.forEach(card => {
                    const title = card.querySelector('h2').textContent.toLowerCase();
                    const description = card.querySelector('p').textContent.toLowerCase();
                    const author = card.querySelector('.text-gray-400').textContent.toLowerCase();

                    // If the quiz title, description, or author matches the query, show the card
                    if (title.includes(query) || description.includes(query) || author.includes(query)) {
                        card.style.display = ''; // Show this specific quiz card
                        topic.style.display = ''; // Ensure the topic is visible if any quiz matches
                        topicHasVisibleQuiz = true; // Mark that the topic has at least one matching quiz
                    } else {
                        card.style.display = 'none'; // Hide this quiz card if it doesn't match
                    }
                });

                // If no quizzes under this topic match, hide the entire topic
                if (!topicHasVisibleQuiz) {
                    topic.style.display = 'none';
                }
            }

        });
    }
});


