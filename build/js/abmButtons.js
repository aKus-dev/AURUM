// Selecciono los botones y su contenedor
const create = document.querySelector('#create');
const createContainer = document.querySelector('#create-container');

const update = document.querySelector('#update');
const updateForm = document.querySelector('#update-form');
const updateContainer = document.querySelector('#update-container');

const remove = document.querySelector('#delete');
const removeContainer = document.querySelector('#remove-container');



// Evento para el boton de crear
create.addEventListener('click', () => {
    updateContainer.classList.add('display-none')
    removeContainer.classList.add('display-none')
    updateForm.classList.add('display-none')

    createContainer.classList.remove('display-none')
})

// Evento para el boton de actualizar
update.addEventListener('click', () => {
    createContainer.classList.add('display-none')
    removeContainer.classList.add('display-none')

    updateContainer.classList.remove('display-none')
    updateForm.classList.remove('display-none')
})

// Evento para el boton de eliminar
remove.addEventListener('click', () => {
    createContainer.classList.add('display-none')
    updateContainer.classList.add('display-none')
    updateForm.classList.add('display-none')

    removeContainer.classList.remove('display-none')
})