const lang = localStorage.getItem('lang');
lang === 'en' && setEnglish();

// Selectores
const RegistraH=document.querySelector("#RegistraH");
const selectDays=document.querySelector("#selectDays");
const SeleHorario = document.querySelector("#SeleHorario");
const desde = document.querySelector("#desde");
const hasta = document.querySelector("#hasta");
const envHorario = document.querySelector("#envHorario");





async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/docente/horarios.json');
    const data = await res.json();


    // Datos JSON (mismo nombre que en el archivo)
    //mismo nombre index.json
    const {reghor,selectDias,lu,mar,mier,jue,vier,sab,dom,selHor,des,has,envHor} = data;
   RegistraH.textContent=reghor;
   selectDays.textContent=selectDias;
   lunes.textContent=lu;
   martes.textContent=mar;
   miercoles.textContent=mier;
   jueves.textContent=jue;
   viernes.textContent=vier;
   sabado.textContent=sab;
   domingo.textContent=dom;
   SeleHorario.textContent=selHor;
   desde.textContent=des;
   hasta.textContent=has;
   envHorario.textContent=envHor;
   


    




}
