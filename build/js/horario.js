// Selecciono los dias
const lunes = document.querySelector('#lunes');
const martes = document.querySelector('#martes');
const miercoles = document.querySelector('#miercoles');
const jueves = document.querySelector('#jueves');
const viernes = document.querySelector('#viernes');
const sabado = document.querySelector('#sabado');
const domingo = document.querySelector('#domingo');

// Selecciono los input
const inputLunes = document.querySelector('#input-lunes');
const inputMartes = document.querySelector('#input-martes');
const inputMiercoles = document.querySelector('#input-miercoles');
const inputJueves = document.querySelector('#input-jueves');
const inputViernes = document.querySelector('#input-viernes');
const inputSabado = document.querySelector('#input-sabado');
const inputDomingo = document.querySelector('#input-domingo');

// Selecciono el formulario 
const formulario = document.querySelector('form');

// Selecciono el botton
const button = document.querySelector('button');
button.classList.add('button-disabled');
button.disabled = true;

lunes.addEventListener('click', markDay);
martes.addEventListener('click', markDay);
miercoles.addEventListener('click', markDay);
jueves.addEventListener('click', markDay);
viernes.addEventListener('click', markDay);
sabado.addEventListener('click', markDay);
domingo.addEventListener('click', markDay);



function markDay(e) {
    e.target.classList.toggle('day--active');
    saveDay(e.target);
    validate();
}

function saveDay(day) {
    if (day.classList.contains('day--active')) {
        switch (day.id) {
            case 'lunes':
                inputLunes.value = 1;
                break;
            case 'martes':
                inputMartes.value = 2;
                break;
            case 'miercoles':
                inputMiercoles.value = 3;
                break;
            case 'jueves':
                inputJueves.value = 4;
                break;
            case 'viernes':
                inputViernes.value = 5;
                break;
            case 'sabado':
                inputSabado.value = 6;
                break;
            case 'domingo':
                inputDomingo.value = 7;
                break;
        }
    } else {
        switch (day.id) {
            case 'lunes':
                inputLunes.value = '';
                break;
            case 'martes':
                inputMartes.value = '';
                break;
            case 'miercoles':
                inputMiercoles.value = '';
                break;
            case 'jueves':
                inputJueves.value = '';
                break;
            case 'viernes':
                inputViernes.value = '';
                break;
            case 'sabado':
                inputSabado.value = '';
                break;
            case 'domingo':
                inputDomingo.value = '';
                break;
        }
    }
}

function validate() {
    if(inputLunes.value === '' && inputMartes.value === '' && inputMiercoles.value === '' && inputJueves.value === '' && inputViernes.value === '' && inputSabado.value === '' && inputDomingo.value === '') {
        button.classList.add('button-disabled');
        button.disabled = true;
    } else {
        button.classList.remove('button-disabled');
        button.disabled = false;
    }

}