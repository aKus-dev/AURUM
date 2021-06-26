// Secciones
const section1 = document.querySelector('#section1')
const section2 = document.querySelector('#section2')
const section3 = document.querySelector('#section3')

// Flechas
const leftArrow = document.querySelector(".leftParent");
const rightArrow = document.querySelector(".rightParent");

leftArrow.classList.add('opacity');

// Botones
const b1 = document.querySelector(".b1");
const b2 = document.querySelector(".b2");
const b3 = document.querySelector(".b3");


let actualSection = 1;

rightArrow.addEventListener('click', () => {
    updateRightSection();
})

function updateRightSection() {
    switch (actualSection) {
        case 1:
            section2.scrollIntoView();

            // Estilo botones inferiores
            b2.classList.add('slider__button--active');
            b1.classList.remove('slider__button--active');

            leftArrow.classList.remove('opacity');

            actualSection = 2;
            break;
        case 2:
            section3.scrollIntoView();

             // Estilo botones inferiores
             b3.classList.add('slider__button--active');
             b2.classList.remove('slider__button--active');

            // Le pongo opacidad para simular que no hay mas a la derecha
            rightArrow.classList.add('opacity');

            actualSection = 3;
            break;
    }
}

leftArrow.addEventListener('click', () => {
    updateLeftSection();
})

function updateLeftSection() {
    switch (actualSection) {
        case 2:
            section1.scrollIntoView();

            // Estilo botones inferiores
            b1.classList.add('slider__button--active');
            b2.classList.remove('slider__button--active');

            leftArrow.classList.add('opacity');

            actualSection = 1;
            break;
        case 3:
            section2.scrollIntoView();

            // Estilo botones inferiores
            b2.classList.add('slider__button--active');
            b3.classList.remove('slider__button--active');

            rightArrow.classList.remove('opacity');

            actualSection = 2;
            break;
    }
}
