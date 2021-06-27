const alertPassword = document.querySelector('#alert-password');
const password = document.querySelector('#password');
const passwordValidate = document.querySelector('#validatePassword');

const btnSubmit = document.querySelector('#submit');

passwordValidate.addEventListener('change', validate) 
password.addEventListener('blur', () => {
    if(passwordValidate.value) {
        validate();
    }
})


function validate() {
    if(password.value !== passwordValidate.value) {
        alertPassword.classList.remove('display-none');

        setTimeout(() => {
            alertPassword.classList.add('display-none');
        },3500)

        btnSubmit.disabled = true;
        btnSubmit.classList.add('disabled');
    } else {
        alertPassword.classList.add('display-none');
        btnSubmit.disabled = false;
        btnSubmit.classList.remove('disabled');
    }
}

