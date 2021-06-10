/* Menus */ 
const menu = document.querySelector(".hamburguer");
const menuMobile = document.querySelector(".header__menu-mobile");

/* Links */
const allLinks = document.querySelectorAll(".header__link");

/* Spans */
const span1 = document.querySelector(".span1");
const span2 = document.querySelector(".span2");
const span3 = document.querySelector(".span3");

/* Eventos y funciones */
menu.addEventListener('click', () =>  {
    span1.classList.toggle("openSpan1");
    span2.classList.toggle("hideSpan2");
    span3.classList.toggle("openSpan3");

    showMenu();
    showLinks();
})

/* Mostrar menu */ 
function showMenu() {
    menuMobile.classList.toggle('showMenu');
}

/* Muesra los links despues de 250ms */ 
function showLinks(){

    setTimeout(() => {
        allLinks.forEach((link) => {
            link.classList.toggle('showLink');
        })
    },250)

}