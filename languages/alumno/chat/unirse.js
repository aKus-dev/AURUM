lang === 'en' && setEnglish();

// Selectores
const notFoundText = document.querySelector('#not-found');


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/chat/unirse.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {notFound} = data;

    notFoundText.textContent = notFound;
 

}


