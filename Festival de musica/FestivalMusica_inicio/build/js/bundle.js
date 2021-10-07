document.addEventListener('DOMContentLoaded',  function() {
    scrollNav();

    navegacionFija();
});

function navegacionFija() {

    const barra = document.querySelector('.header');

    // Registra el Intersection observer
    const observer = new IntersectionObserver( function(entries) {
        if(entries[0].isIntersecting) {
            barra.classList.remove('fijo'); 
        } else {
            barra.classList.add('fijo');
        }
        
    });

    //Elemento a observar
    observer.observe(document.querySelector('.video'));
}
//----------------------------------------------------------------------------



//__________Scroll smooth_________________
function scrollNav() {
    const enlaces = document.querySelectorAll('.navegacion-principal a');
    
    enlaces.forEach( function( enlace ) {
        enlace.addEventListener('click', function(e) {
            e.preventDefault();
            const seccion = document.querySelector(e.target.attributes.href.value);
            seccion.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
}
//--------------------------------------------------------------------------------



//Get the button

var mybutton = document.getElementById("myBtn");

//When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

//When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

document.addEventListener('DOMContentLoaded', function(){
    crearGaleria();
});

function crearGaleria() {
    const galeria = document.querySelector('.galeria-imagenes');

    for( let i = 1; i <= 12; i ++ ) {
        const imagen = document.createElement('IMG');
        imagen.src = `build/img/thumb/${i}.webp`;
        imagen.dataset.imagenId = i;
        
        //Añadir la funcion mostrarImagen
        imagen.onclick = mostrarImagen;

        const lista = document.createElement('LI');
        lista.appendChild(imagen);

        galeria.appendChild(lista);
    }
}

function mostrarImagen(e) {
   
    const id = parseInt(e.target.dataset.imagenId);

    // Generar la imagen
    const imagen = document.createElement('IMG');
    imagen.src = `build/img/grande/${id}.webp`;

    const overlay = document.createElement('DIV');
    overlay.appendChild(imagen);
    overlay.classList.add('overlay');

    //Boton para cerrar la imagen
    const cerrarImagen = document.createElement('P');
    cerrarImagen.textContent = 'X'
    cerrarImagen.classList.add('btn-cerrar');

    //Cerrar la imagen
    overlay.onclick = function() {
        overlay.remove();
    }

    //Cerrar imagen al hacer click sobre el boton
    cerrarImagen.onclick = function() {
        overlay.remove();
    }

    overlay.appendChild(cerrarImagen);

    //Mostrarlo en el HTML
    const body = document.querySelector('body');
    body.appendChild(overlay);
    body.classList.add('fijar-body');
}