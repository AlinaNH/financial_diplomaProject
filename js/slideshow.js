var slideIndex = 1;
showSlides(slideIndex);

var slideIndex = 0;
showSlides();

function showSlides() { // Функция показа слайдов (при нажатии на точки)
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    slides[slideIndex-1].style.display = "block";
    setTimeout(showSlides, 3000); // Анимация меняется каждые три секунды
}