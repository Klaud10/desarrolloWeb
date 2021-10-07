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
