const lang = localStorage.getItem('lang');
lang === 'en' && setEnglish();

// Selectores
const titleText = document.querySelector('h2');
const materiasText = document.querySelector('#materias');
const horariosText = document.querySelector('#horarios');
const notFoundText = document.querySelector('#not-found');


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/profesores.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {title, materias, horarios, notFound} = data;

    titleText.textContent = title;
    materiasText.textContent = materias;
    horariosText.textContent = horarios;

    if(notFoundText) notFoundText.textContent = notFound;
   
    
}


