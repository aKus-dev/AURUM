const btnDelete = document.querySelector('#btn-delete');
const btnCancelar = document.querySelector('#btn-cancelar');


const modal = document.querySelector('#modal');

btnDelete.addEventListener('click', () => {
    modal.classList.remove('hide-modal');
    document.body.style = 'overflow: hidden';
})

btnCancelar.addEventListener('click', () => {
    modal.classList.add('hide-modal');
    document.body.style = 'overflow: auto';
})