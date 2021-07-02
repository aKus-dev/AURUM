// Botones
const pendiente = document.querySelector('#pendiente')
const contestada = document.querySelector('#contestada');
const realizada = document.querySelector('#realizada');

// Contenedores 
const realizadaContainer = document.querySelector('#realizada-container');
const pendienteContainer = document.querySelector('#pendiente-container')
const contestadaContainer = document.querySelector('#contestada-container');


if(realizada) {
    realizada.addEventListener('click', () => {
        // Boton
        realizada.classList.toggle('btn-realizadas--active');
    
        // Contenedores
        realizadaContainer.classList.remove('display-none');
        pendienteContainer.classList.add('display-none')
        contestadaContainer.classList.add('display-none');
    
    
        // Elimino el active (si lo tiene) 
        if(contestada.classList.contains('btn-contestadas--active')) {
            contestada.classList.remove('btn-contestadas--active');
        }
    
        if(pendiente.classList.contains('btn-pendientes--active')) {
            pendiente.classList.remove('btn-pendientes--active');
        }
    })
}


pendiente.addEventListener('click', () => {
    // Boton
    pendiente.classList.toggle('btn-pendientes--active');

    // Contenedores
    pendienteContainer.classList.remove('display-none')
    contestadaContainer.classList.add('display-none')

    if(realizada) {
        realizadaContainer.classList.add('display-none')    

        // Quita la clase activa (si la tiene)
        if(realizada.classList.contains('btn-realizadas--active')) {
            realizada.classList.remove('btn-realizadas--active');
        }
    }


    // Elimino el active (si lo tiene) 
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
    
    if(realizada) {
        realizadaContainer.classList.add('display-none')    

         // Quita la clase activa (si la tiene)
        if(realizada.classList.contains('btn-realizadas--active')) {
            realizada.classList.remove('btn-realizadas--active');
        }
    }

    // Elimino el active (si lo tiene) 
    if(pendiente.classList.contains('btn-pendientes--active')) {
        pendiente.classList.remove('btn-pendientes--active');
    }

    
})