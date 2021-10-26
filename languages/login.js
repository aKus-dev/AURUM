const lang = localStorage.getItem('lang');

lang === 'en' && setEnglish();

// Selectores
const loginText = document.querySelector('.form__heading');
const inputCI = document.querySelector('input[name="usuario"]');
const passInput = document.querySelector('input[name="password"]');
const btnSubmit = document.querySelector('button');


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/login.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const { login, ci, pass} = data;

    loginText.textContent = login;
    inputCI.placeholder = ci;
    passInput.placeholder = pass;
    btnSubmit.textContent = login;
    
}


