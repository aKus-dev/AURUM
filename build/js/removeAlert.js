const danger = document.querySelector('#danger');
const success = document.querySelector('#success');

setTimeout(() => {
    
    if(danger) {
        danger.remove();
    } else if(success) {
        success.remove();
    }

},5000)