/* Sự kiến slider */
const myslide = document.querySelectorAll('.slide'),
	dot = document.querySelectorAll('.dot');
let counter = 1;
slidefun(counter);

let timer = setInterval(autoSlide, 5000);

function autoSlide() {
	counter += 1;
	slidefun(counter);
}

function plusSlides(n) {
	counter += n;
	slidefun(counter);
	resetTimer();
}

function currentSlide(n) {
	counter = n;
	slidefun(counter);
	resetTimer();
}

function resetTimer() {
	clearInterval(timer);
	timer = setInterval(autoSlide, 5000);
}

function slidefun(n) {

	let i;
	for (i = 0; i < myslide.length; i++) {
		myslide[i].style.display = "none";
	}
	for (i = 0; i < dot.length; i++) {
		dot[i].className = dot[i].className.replace(' active', '');
	}
	if (n > myslide.length) {
		counter = 1;
	}
	if (n < 1) {
		counter = myslide.length;
	}
	myslide[counter - 1].style.display = "flex";
	dot[counter - 1].className += " active";
}
/* Kết thúc sự kiện slider */