lang === 'en' && setEnglish();

// Selectores
const inicioHeaderText = document.querySelector('#inicio-header');
const perfilHeaderText = document.querySelector('#perfil-header');
const salirHeaderText = document.querySelector('#salir-header');

async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/header.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {inicio, perfil, salir} = data;

    inicioHeaderText.textContent = inicio;
    perfilHeaderText.textContent = perfil;
    salirHeaderText.textContent = salir;
 
    
}


