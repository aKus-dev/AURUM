const imgs = document.querySelectorAll('.animation-100');

document.addEventListener('DOMContentLoaded', () => {
    animateImg();
})

window.onscroll = () => {
    animateImg();
}

function animateImg() {
    imgs.forEach(img => {
        const rectImg = img.getBoundingClientRect();
        
        if(rectImg.top < (window.innerHeight - 100)) {
            img.classList.remove('animation-100');
        }
    })
}