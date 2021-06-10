let actualSection = 1;

// Enlaces
const leftArrow = document.querySelector(".leftParent");
const rightArrow = document.querySelector(".rightParent");

// Botones
const b1 = document.querySelector(".b1");
const b2 = document.querySelector(".b2");
const b3 = document.querySelector(".b3");

// Actualiza el HREF de los enlaces cuando carga el HTML
document.addEventListener('DOMContentLoaded', () => {
    updateArrows();
})

// Evento cuando se pulse en la flecha derecha
rightArrow.addEventListener('click', () => {

    if(actualSection != 3) {
        actualSection++;
    } else {
        actualSection = 3;
    }

    updateArrows();
})

// Evento cuando se pulse en la flecha izquierda
leftArrow.addEventListener('click', () => {

    if(actualSection != 1) {
        actualSection--;
    } else {
        actualSection = 1;
    }

    console.log(actualSection)

    updateArrows();
})

// Actualiza los enlaces de las flechas
function updateArrows() {
    switch (actualSection) {
        case 1:
            leftArrow.href = '#section1';

             // Le pongo opacidad para simular que no hay mas a la derecha
             leftArrow.classList.add('opacity');

            // Actualizo los botones inferiores
            b1.classList.add('slider__button--active');
            b2.classList.remove('slider__button--active');
            b3.classList.remove('slider__button--active');
            break;
        case 2:
            leftArrow.href = '#section2';
            rightArrow.href = '#section2';

            // Le quito opacidad
            leftArrow.classList.remove('opacity');

            // Le quito la opacidad 
            rightArrow.classList.remove('opacity');

            // Actualizo los botones inferiores
            b1.classList.remove('slider__button--active');
            b2.classList.add('slider__button--active');
            b3.classList.remove('slider__button--active');
            break;
        case 3:
            rightArrow.href = '#section3';

            // Le pongo opacidad para simular que no hay mas a la derecha
            rightArrow.classList.add('opacity');

            // Actualizo los botones inferiores
            b1.classList.remove('slider__button--active');
            b2.classList.remove('slider__button--active');
            b3.classList.add('slider__button--active');
            break;
    }
}


