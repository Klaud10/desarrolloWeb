document.addEventListener('DOMContentLoaded', function() {

    eventListener();

    darkMode();

    // sunMode();
});

// ___Dark Mode____
function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    // console.log( prefiereDarkMode.matches );
    
    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode'); 
    } else {
        document.body.classList.remove('dark-mode'); 
    }

    prefiereDarkMode.addEventListener('change', function() {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode'); 
        } else {
            document.body.classList.remove('dark-mode'); 
        }    
    });

// ----------------------------------
    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });

    
}

// --------Menu responsive------------------

function eventListener() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');

    } else {
        navegacion.classList.add('mostrar'); 
    }
}



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



