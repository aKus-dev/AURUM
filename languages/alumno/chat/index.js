const lang = localStorage.getItem('lang');

lang === 'en' && setEnglish();

// Selectores
const createText = document.querySelector('#create');
const createDesc = document.querySelector('#create-desc');
const joinText = document.querySelector('#join');
const joinDesc = document.querySelector('#join-desc');
const buttons = document.querySelectorAll('.admin-button');

async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/chat/index.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {create, createContent, join, joinContent, visualize} = data;

    buttons.forEach(btn => btn.textContent = visualize)

    createText.textContent = create;
    createDesc.textContent = createContent;
    joinText.textContent = join;
    joinDesc.textContent = joinContent;
    
}


