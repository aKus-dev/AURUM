const lang = localStorage.getItem('lang');
lang === 'en' && setEnglish();

// Selectores
const titleText = document.querySelector('h2')
const realizadaText = document.querySelector('#realizada')
const contestadaText = document.querySelector('#pendiente')
const recibidaText = document.querySelector('#contestada')

const notFoundContestadaText = document.querySelector('#not-found-contestada');
const notFoundRealizadaText = document.querySelector('#not-found-realizada');
const notFoundRecibidaText = document.querySelector('#not-found-recibida');

async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/consultas.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {title, realizadas, contestadas, recibidas, notFoundContestada, notFoundRealizada, notFoundRecibida} = data;

    titleText.textContent = title;
    realizadaText.textContent = realizadas;
    contestadaText.textContent = contestadas;
    recibidaText.textContent = recibidas;

    if(notFoundContestadaText) notFoundContestadaText.textContent = notFoundContestada;
    if(notFoundRealizadaText) notFoundRealizadaText.textContent = notFoundRealizada;
    if(notFoundRecibidaText) notFoundRecibidaText.textContent = notFoundRecibida;
   
}


