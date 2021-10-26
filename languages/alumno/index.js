const lang = localStorage.getItem('lang');

lang === 'en' && setEnglish();

// Selectores
const consultasText = document.querySelector('#consultas');
const profesoresText = document.querySelector('#profesores');
const claseText = document.querySelector('#clase');

const consultasContentText = document.querySelector('#consultasContent');
const profesoresContentText = document.querySelector('#profesoresContent');
const classContentText = document.querySelector('#classContent');


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/index.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {consultas, consultasContent, profesores, profesoresContent, clase, classContent} = data;

    consultasText.textContent = consultas;
    profesoresText.textContent = profesores;
    claseText.textContent = clase;
    consultasContentText.textContent = consultasContent;
    profesoresContentText.textContent = profesoresContent;
    classContentText.textContent = classContent;
 
    
}


