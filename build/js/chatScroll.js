const msgContainer = document.querySelector('.messages');
const inputMsg = document.querySelector('#msg');

inputMsg.select();

scrollHeight = '';

setTimeout(() => {
    scrollContainer();
    scrollHeight = msgContainer.scrollHeight;
}, 300)

setInterval(() =>  {
   if(scrollHeight !== msgContainer.scrollHeight) {
        scrollContainer();
        scrollHeight = msgContainer.scrollHeight;
   }
},300)

// Toma la altura del contenedor y hace scroll top con esa altura
function scrollContainer() {
    totalScroll = msgContainer.scrollHeight;
    msgContainer.scrollTop = totalScroll;
}
