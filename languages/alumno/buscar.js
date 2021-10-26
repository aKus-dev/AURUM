const lang = localStorage.getItem('lang');
lang === 'en' && setEnglish();

// Selectores
const titleText = document.querySelector('h2');
const recommendText = document.querySelector('.guia-buscar');
const notFoundText = document.querySelector('#not-found');
const input = document.querySelector('input');


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/buscar.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {title, notFound, recommend, placeholder} = data;

    titleText.textContent = title;
    recommendText.textContent = recommend;
    input.placeholder = placeholder;
    if(notFoundText) notFoundText.textContent = notFound;
    
}


