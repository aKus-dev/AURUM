const lang = localStorage.getItem('lang');
lang === 'en' && setEnglish();

// Selectores
const titleText = document.querySelector('h2');
const notFoundText = document.querySelector('#not-found');


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/clase.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {title, notFound} = data;

    titleText.textContent = title;
    if(notFoundText) notFoundText.textContent = notFound;
    
}


