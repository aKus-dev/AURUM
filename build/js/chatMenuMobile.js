const usuariosContainer = document.querySelector('#usuarios-mobile');
const chatsContainer = document.querySelector('#chats-mobile');
const container = document.querySelector('.chat-mobile-menu');
const showMenu = document.querySelector('#showMenu');

const chatsBtn = document.querySelector('#chatsBtn');
const usuariosBtn = document.querySelector('#usuariosBtn');

usuariosBtn.addEventListener('click', () => {
    usuariosContainer.classList.remove('display-none')
    chatsContainer.classList.add('display-none');
})

chatsBtn.addEventListener('click', () => {
    chatsContainer.classList.remove('display-none')
    usuariosContainer.classList.add('display-none');
})

showMenu.addEventListener('click', () => {
    container.classList.toggle('hiddeMenuMobileChat')
})

