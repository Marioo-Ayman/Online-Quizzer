const toogle = document.querySelector('.toogle'),
    nav = document.querySelector('nav');
    // topics = document.querySelector('');

toogle.addEventListener('click', () => {
    nav.classList.toggle('hidden');
});
