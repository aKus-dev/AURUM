const lang = localStorage.getItem('lang');

lang === 'en' && setEnglish();

// Selectores
const titleText = document.querySelector('.form__heading');

const inputNombre = document.querySelector('input[name="nombre"]');
const inputApellido = document.querySelector('input[name="apellido"]');
const inputPass = document.querySelector('#password');
const inputPassAgain = document.querySelector('#validatePassword');
const inputCi = document.querySelector('input[name="ci"]');
const gruposText = document.querySelector('label[for="grupos"');


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno.json');
    const data = await res.json();


    // Datos JSON (mismo nombre que en el archivo)
    const {title, name, lastname, pass, passAgain, ci, grupos, register} = data;

    titleText.textContent = title;
    inputNombre.placeholder = name;
    inputApellido.placeholder = lastname;
    inputPass.placeholder = pass;
    inputPassAgain.placeholder = passAgain;
    inputCi.placeholder = ci;
    gruposText.textContent = grupos;
    btnSubmit.textContent = register;
    
}


