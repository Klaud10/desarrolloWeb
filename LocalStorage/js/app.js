
//___Variables___
const formulario = document.querySelector('#formulario');
const listaTweets = document.querySelector('#lista-tweets');
let tweets = [];
const diaHoy = moment().format('L');

// console.log(diaHoy);

//___EventListeners___
eventListener()

function eventListener() {
    //Cuando el usuario agrega un nuevo tweet
    formulario.addEventListener('submit', agregarTweet);

    //Cuando el documento esta listo
    document.addEventListener('DOMContentLoaded', () => {
        tweets = JSON.parse(localStorage.getItem ('tweets')) || [];

        console.log(tweets);

        crearHTML();
    });
}

//___Funciones___
function agregarTweet(e) {
    e.preventDefault();

    //Textarea, donde el usuario escribe
    const tweet = document.querySelector('#tweet').value;

    //Validación
    if (tweet === '') {
        mostrarError('Debes escribir algo');
       return; 
    }

    const tweetObj = {
        id : Date.now(),
        tweet, //___esto es igual a tweet:tweet
    };
    //Añadir al arreglo de tweets
    tweets = [...tweets, tweetObj];
   
    //Una vez agregado
    crearHTML();

    // Reiniciar el formulario
    formulario.reset();
};

//___Mostrar msj de error
function mostrarError(error) {
    const mensajeError = document.createElement('p');
    mensajeError.textContent = error;
    mensajeError.classList.add('error');

    //Insertar el contenido
    const contenido = document.querySelector('#contenido');
    contenido.appendChild(mensajeError);

    //Elimina la alerta
    setTimeout(() => {
        mensajeError.remove();    
    }, 3000);
};

//___Mostrar un listado de los tweets
function crearHTML() {

    limpiarHTML();

    if (tweets.length > 0) {
        tweets.forEach( tweet => {
            //Agregar un boton de eliminar
            const btnEliminar = document.createElement('a');
            btnEliminar.classList.add('borrar-tweet');
            btnEliminar.innerText = 'x';

            //Añadir al btn la funcion de eliminar
            btnEliminar.onclick = () => {
                borrarTweet(tweet.id);   
            };

            //Borra los tweets despues de x cantidad de segundos
            // setTimeout(() => {  
            //     borrarTweet(tweet.id);
            // }, 3600000);
 
            
            //Crear todo el HTML
            const li = document.createElement('li');
            
            //Añadir texto
            li.innerText = `${diaHoy} : ${tweet.tweet}`;

            //Insertar el boton en el HTML
            li.appendChild(btnEliminar);

            //Insertarlo en el HTML
            listaTweets.appendChild(li);
        });
    }
    sincronizarStorage();
};

//___Agrega los tweets actuales al Local Storage
function sincronizarStorage() {
    localStorage.setItem('tweets', JSON.stringify(tweets));
};

//___Eliminar un tweet
function borrarTweet(id) {
    tweets = tweets.filter( tweet => tweet.id !== id);
    crearHTML();

};

//___Limpiar el HTML

function limpiarHTML() {
    while (listaTweets.firstChild) {
        listaTweets.removeChild(listaTweets.firstChild);
    }


};


