lang === 'en' && setEnglish();

// Selectores
const notFoundText = document.querySelector('#not-found');
const chatsText = document.querySelector('#chats-creados');

async function setEnglish() {
    // Ruta del archivo JSON
    const res = await fetch('/languages/alumno/chat/hostchats.json');
    const data = await res.json();

    // Datos JSON (mismo nombre que en el archivo)
    const {notFound, chats} = data;

    if(chatsText) chatsText.textContent = chats;
    if(notFoundText) notFoundText.textContent = notFound;
 

}


