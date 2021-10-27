const lang = localStorage.getItem('lang');

lang === 'en' && setEnglish();

// Selectores
const inputName = document.querySelector('input[name="nombre"]');
const inputLastName = document.querySelector('input[name="apellido"]');
const inputPass = document.querySelector('input[name="password"]');
const inputPassAgain = document.querySelector('input[name="passwordValidate"]');
const changeText = document.querySelector('#change');
const deleteText = document.querySelector('#btn-delete');
const inputSubmit = document.querySelector('#submit');
const msgText = document.querySelector('.msg');

const btnConfirmar = document.querySelector('#btn-confirm');

async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/perfil.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {name, lastname, password, passwordAgain, changePhoto, save, deleteAccount, msg, cancel, confirmar} = data;

    inputName.placeholder = name;
    inputLastName.placeholder = lastname;
    inputPass.placeholder = password;
    inputPassAgain.placeholder = passwordAgain;
    changeText.textContent = changePhoto;
    inputSubmit.textContent = save;
    deleteText.textContent = deleteAccount;
    msgText.textContent = msg;
    btnCancelar.textContent = cancel;
    btnConfirmar.textContent = confirmar;

 
    
}


