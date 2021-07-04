// Selecciono cada Imagen
const perfil1 = document.querySelector('#perfil1');
const perfil2 = document.querySelector('#perfil2');
const perfil3 = document.querySelector('#perfil3');
const perfil4 = document.querySelector('#perfil4');
const perfil5 = document.querySelector('#perfil5');
const perfil6 = document.querySelector('#perfil6');
const perfil7 = document.querySelector('#perfil7');
const perfil8 = document.querySelector('#perfil8');
const perfil9 = document.querySelector('#perfil9');

const images = [perfil1, perfil2, perfil3, perfil4, perfil5, perfil6, perfil7, perfil8, perfil9]

// Selecciono el input
const input = document.querySelector('#src-image');

// Les agrego un evento
perfil1.addEventListener('click', active);
perfil2.addEventListener('click', active);
perfil3.addEventListener('click', active);
perfil4.addEventListener('click', active);
perfil5.addEventListener('click', active);
perfil6.addEventListener('click', active);
perfil7.addEventListener('click', active);
perfil8.addEventListener('click', active);
perfil9.addEventListener('click', active);


function active(e) {
    e.target.classList.toggle('profile-active')
    input.value = e.target.src;
    uniqueImagesSelected(e.target.id);
}

function uniqueImagesSelected(id) {
    images.forEach(image => {
        if(image.id !== id) {
            image.classList.remove('profile-active');
        }
    })
}
