let items = document.querySelectorAll('.slider .item'); //meken .slider eke thiyen items gaana count wenw
let prevBtn = document.getElementById('prev'); //prev button ekth ekk link wenw
let nextBtn = document.getElementById('next'); //same
let lastPosition = items.length - 1;
let firstPosition = 0;
let active = 0;

nextBtn.onclick = () => { //button ek click weddi active index eka wadi krgnnw
    active++;
    setSlider();
}

prevBtn.onclick = () => {
    active--;
    setSlider();
}

const setSlider = () => {
    let oldActive = document.querySelector('.slider .item.active'); // danata active thiyen item ek adungnnw
    if(oldActive) oldActive.classList.remove('active'); //eke class names wlin active ain krnw
    items[active].classList.add('active'); //ilgt enn thiyen item ekt active class name ek add krnw

    nextBtn.classList.remove('d-none');
    prevBtn.classList.remove('d-none');
    if(active == lastPosition) nextBtn.classList.add('d-none');
    if(active == firstPosition) prevBtn.classList.add('d-none');
}
setSlider();


const setDiameter = () => {
    let slider = document.querySelector('.slider');
    let widthSlider = slider.offsetWidth;
    let heightSlider = slider.offsetHeight;
    let diameter = Math.sqrt(Math.pow(widthSlider, 2) + Math.pow(heightSlider, 2));
    document.documentElement.style.setProperty('--diameter', diameter + 'px');
}

setDiameter();
window.addEventListener('resize', setDiameter);