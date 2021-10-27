const spanish = document.querySelector('#spanish');
const english = document.querySelector('#english');


spanish.addEventListener('click', () => {
    localStorage.setItem('lang', 'es');
    location.reload();
})

english.addEventListener('click', () => {
    localStorage.setItem('lang', 'en');
    location.reload();
})