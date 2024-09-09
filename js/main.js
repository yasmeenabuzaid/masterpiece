document.addEventListener('DOMContentLoaded', () => {
    const sliderWrapper = document.querySelector('.slider-wrapper');
    const slides = document.querySelectorAll('.slide');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    
    if (!sliderWrapper || !slides.length || !prevButton || !nextButton) {
        console.error('Slider elements are missing');
        return;
    }

    let currentIndex = 0;
    let slideWidth = slides[0].offsetWidth; // تأكد من حساب العرض بشكل صحيح
    const totalSlides = slides.length;

    function updateSlider() {
        sliderWrapper.style.transform = `translateX(${-currentIndex * slideWidth}px)`;
        console.log('Current index:', currentIndex, 'TranslateX:', -currentIndex * slideWidth);
    }

    function toggleControls() {
        if (totalSlides <= 1) {
            prevButton.classList.add('disabled');
            nextButton.classList.add('disabled');
            prevButton.disabled = true;
            nextButton.disabled = true;
        } else {
            prevButton.classList.remove('disabled');
            nextButton.classList.remove('disabled');
            prevButton.disabled = false;
            nextButton.disabled = false;
        }
    }

    nextButton.addEventListener('click', () => {
        if (currentIndex < totalSlides - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // loop back to the first slide
        }
        updateSlider();
    });

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = totalSlides - 1; // loop back to the last slide
        }
        updateSlider();
    });

    window.addEventListener('resize', () => {
        slideWidth = slides[0].offsetWidth;
        updateSlider();
    });

    updateSlider(); // Initialize slider position on page load
    toggleControls(); // Disable controls if there are not enough slides
});
