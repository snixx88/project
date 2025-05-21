

const slides = document.querySelectorAll('.slide');
const header = document.querySelector('header');
let currentSlide = 0;
onclick="prevSlide"();
onclick="nextSlide"();
function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
    });

    // Change header color based on active slide
    if (index ===2) { // Index 2 corresponds to the third image
        header.classList.add('black-header');
    } else {
        header.classList.remove('black-header');
    }
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
}

// Initialize the first slide
showSlide(currentSlide);














function insta(){
    window.open("https://www.instagram.com/bmw/?hl=en")
}
function facebook(){
    window.open("https://www.facebook.com/BMWEgypt/")
}


function X(){
    window.open("https://x.com/BMW?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor")
}


function linkedin(){
    window.open("https://www.linkedin.com/company/bmw-group/")
}


function youtube(){
    window.open("https://www.youtube.com/user/BMW")
}





function tiktok(){
    window.open("https://www.tiktok.com/@bmw?lang=en/")
}



