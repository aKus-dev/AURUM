const lang = localStorage.getItem('lang');

lang === 'en' && setEnglish();

// Selectores
const inicioHeaderText = document.querySelector('#inicio-header');
const consultaHeaderText = document.querySelector('#consulta-header');
const perfilHeaderText = document.querySelector('#perfil-header');
const salirHeaderText = document.querySelector('#salir-header');

async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/header.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {inicio, consulta, perfil, salir} = data;

    inicioHeaderText.textContent = inicio;
    consultaHeaderText.textContent = consulta;
    perfilHeaderText.textContent = perfil;
    salirHeaderText.textContent = salir;
 
    
}


