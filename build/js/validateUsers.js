// Alertas
const alertPassword = document.querySelector('#alert-password');
const alertCedula = document.querySelector('#alert-cedula');

// Inputs
const password = document.querySelector('#password');
const passwordValidate = document.querySelector('#validatePassword');
const cedula = document.querySelector('#cedula');

// Botones
const btnSubmit = document.querySelector('#submit');

passwordValidate.addEventListener('blur', validate) 
password.addEventListener('blur', () => {
    if(passwordValidate.value) {
        validate();
    }
})

cedula.addEventListener('input', trimText);
cedula.addEventListener('input', validateCI);

function validateCI() {
    const ci = cedula.value;

    // Si NO Es un numero...
    if(isNaN(ci) || ci.includes('.')) {
        alertCedula.classList.remove('display-none');

        // Despues de 5 segundos la oculto
        setTimeout(() => {
            alertCedula.classList.add('display-none');
        },5000)

        btnSubmit.disabled = true;
        btnSubmit.classList.add('disabled');
    } else {
        alertCedula.classList.add('display-none');
        btnSubmit.disabled = false;
        btnSubmit.classList.remove('disabled');
    }
}

function trimText() {
    const text = cedula.value;
    cedula.value = text.trim();
}


function validate() {
    if(password.value !== passwordValidate.value) {
        // La muestro
        alertPassword.classList.remove('display-none');

        // Despues de 5 segundos la oculto
        setTimeout(() => {
            alertPassword.classList.add('display-none');
        },5000)

        btnSubmit.disabled = true;
        btnSubmit.classList.add('disabled');
    } else {
        alertPassword.classList.add('display-none');
        btnSubmit.disabled = false;
        btnSubmit.classList.remove('disabled');
    }
}

