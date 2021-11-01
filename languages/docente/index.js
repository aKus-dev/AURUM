const lang = localStorage.getItem('lang');
lang === 'en' && setEnglish();

// Selectores
const consu=document.querySelector("#consu");
const vizuA=document.querySelector("#vizuA");
const botones=document.querySelectorAll('.admin-button');
const grupos=document.querySelector("#grupos");
const listaG=document.querySelector("#listaG");
const registraH=document.querySelector("#regsitraH");
const regiMod=document.querySelector("#regiMod");





async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/docente/index.json');
    const data = await res.json();

    const {consulta,visu,Visualizar,grupos1,listaGr,registra,regiModi,regis} = data;
    consu.textContent=consulta;
    vizuA.textContent=visu;
    botones.forEach(btn => btn.textContent = Visualizar);
    grupos.textContent=grupos1;
    listaG.textContent=listaGr;
    registraH.textContent=registra;
    regiMod.textContent=regiModi;

}

