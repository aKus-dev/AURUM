const lang = localStorage.getItem('lang');
lang === 'en' && setEnglish();

// Selectores
const successbtn = document.querySelector("#success");
const consulta = document.querySelector("#consulta");
const pendientebtn = document.querySelector("#pendiente");
const contestadabtn = document.querySelector("#contestada");
const nocontestadas = document.querySelector("#nocontestadas");
const norecibida = document.querySelector("#norecibida");


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/docente/consultas.json');
    const data = await res.json();


    // Datos JSON (mismo nombre que en el archivo)
    //mismo nombre index.json   
    const { respuestaEnviada, cons, rec, cont, noc, nore } = data;
    consulta.textContent = cons;
    pendientebtn.textContent = rec;
    contestadabtn.textContent = cont;

    if (nocontestadas) {
        nocontestadas.textContent = noc;
    }
    if (norecibida) {
        norecibida.textContent = nore;

    }






}