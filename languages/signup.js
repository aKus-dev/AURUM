const lang = localStorage.getItem('lang');

lang === 'en' && setEnglish();

// Selectores
const registerText = document.querySelector('#register-text');
const optionText = document.querySelector('#option-text');
const studentText = document.querySelector('#btn-student');
const teacherText = document.querySelector('#btn-teacher');


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/signup.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const { register, option, student, teacher} = data;

    registerText.textContent = register;
    optionText.textContent = option;
    studentText.textContent = student;
    teacherText.textContent = teacher;
    
}


