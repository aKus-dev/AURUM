// Botones
const pendiente = document.querySelector('#pendiente')
const contestada = document.querySelector('#contestada');

// Contenedores *
const pendienteContainer = document.querySelector('#pendiente-container')
const contestadaContainer = document.querySelector('#contestada-container');

pendiente.addEventListener('click', () => {
    // Boton
    pendiente.classList.toggle('btn-pendientes--active');

    // Contenedores
    pendienteContainer.classList.remove('display-none')
    contestadaContainer.classList.add('display-none')


    if(contestada.classList.contains('btn-contestadas--active')) {
        contestada.classList.remove('btn-contestadas--active');
    }
})

contestada.addEventListener('click', () => {
    // Botones
    contestada.classList.toggle('btn-contestadas--active');

    // Contenedores
    contestadaContainer.classList.remove('display-none')
    pendienteContainer.classList.add('display-none')

    if(pendiente.classList.contains('btn-pendientes--active')) {
        pendiente.classList.remove('btn-pendientes--active');
    }
})