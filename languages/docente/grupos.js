const lang = localStorage.getItem('lang');
lang === 'en' && setEnglish();

// Selectores
const tusGrupos=document.querySelector("#tusGrupos");


async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/docente/grupos.json');
    const data = await res.json();


    // Datos JSON (mismo nombre que en el archivo)
    //mismo nombre index.json
    const {tg} = data;
    tusGrupos.textContent=tg;
 

}
