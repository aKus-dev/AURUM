const lang = localStorage.getItem('lang');
lang === 'en' && setEnglish();

// Selectores
const titleText = document.querySelector('h1');
const subtitleText = document.querySelector('#subtitulo');
const bntVerText = document.querySelector('#btn-ver-consultas');
const empezemosText = document.querySelector('.empezemos');
const labelTitleText = document.querySelector('label[for="titulo"]');
const mensajeTitleText = document.querySelector('label[for="mensaje"]');
const inputTitulo = document.querySelector('input[name="titulo"]');
const inputDesc = document.querySelector('textarea');
const selectTeacherText = document.querySelector('#select-teacher');
const btnSubmit = document.querySelector('button');

async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/create.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {title, subtitle, seeAll, start, labelTitle, labelMsg, questionTitle, questionDesc, selectTeacher, send} = data;

    titleText.textContent = title;
    subtitleText.textContent = subtitle;
    bntVerText.textContent = seeAll;
    empezemosText.textContent = start;
    labelTitleText.textContent = labelTitle;
    mensajeTitleText.textContent = labelMsg;
    inputTitulo.placeholder = questionTitle;
    inputDesc.placeholder = questionDesc;
    selectTeacherText.textContent = selectTeacher;
    btnSubmit.textContent = send;
   
}


