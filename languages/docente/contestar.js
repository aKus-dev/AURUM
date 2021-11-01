const lang = localStorage.getItem('lang');
lang === 'en' && setEnglish();

// Selectores
const enviadoX=document.querySelector("#enviadoX");
const escribeRes=document.querySelector("#escribeRes");
const responder=document.querySelector("#responder");






async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/docente/contestar.json');
    const data = await res.json();


    // Datos JSON (mismo nombre que en el archivo)
    //mismo nombre index.json
    const {enviX,escRes,respo} = data;
   enviadoX.textContent=enviX;
   escribeRes.textContent=escRes;
   responder.textContent=respo;
    




}
