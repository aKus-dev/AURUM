const lang = localStorage.getItem('lang');

lang === 'en' && setEnglish();

// Selectores
const finalizar = document.querySelectorAll('.finalizar');
const finalizarText = document.querySelectorAll('.finalizarText');
const btns = document.querySelectorAll('.btn-end');
const usersTexts = document.querySelectorAll('.usuarios');
const finishMobile = document.querySelector('#chatsBtn');
const input = document.querySelector('#msg');


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/chat/host.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {end, endDesc, btnEnd, users, message} = data;

    finalizar.forEach(f => f.textContent = end)
    finalizarText.forEach(f => f.textContent = endDesc)
    btns.forEach(btn => btn.textContent = btnEnd)
    usersTexts.forEach(u => u.textContent = users)
    finishMobile.textContent = btnEnd;
    input.placeholder = message;
 

}


