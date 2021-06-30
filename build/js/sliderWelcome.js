// Botones siguiente
const btnSiguiente1 = document.querySelector('#btn-siguiente1');
const btnSiguiente2 = document.querySelector('#btn-siguiente2');

// Botones atras
const btnAtras2 = document.querySelector('#btn-atras2');
const btnAtras3 = document.querySelector('#btn-atras3');

// Boton entendido
const btnEntendido = document.querySelector('#btn-entendido');

// Secciones
const section1 = document.querySelector('#section1');
const section2 = document.querySelector('#section2');
const section3 = document.querySelector('#section3');

// Eventos boton siguiente
btnSiguiente1.addEventListener('click', () => {
    section2.scrollIntoView();
})

btnSiguiente2.addEventListener('click', () => {
    section3.scrollIntoView();
})

// Eventos boton atras
btnAtras2.addEventListener('click', () => {
    section1.scrollIntoView();
})

btnAtras3.addEventListener('click', () => {
    section2.scrollIntoView();
})