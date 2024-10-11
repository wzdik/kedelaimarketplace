document.addEventListener('scroll', function() {
    const elements = document.querySelectorAll('.fade-in');
    const viewportHeight = window.innerHeight;

    elements.forEach(element => {
        const position = element.getBoundingClientRect().top;
        if (position < viewportHeight - 100) {
            element.classList.add('in-view');
        }
    });
});
