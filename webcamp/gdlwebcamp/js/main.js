(function(){
  "use strict";
  var regalo = document.getElementById('regalo');

  document.addEventListener('DOMContentLoaded', function(){

    // Campos DATOS DE USUARIO
    var nombre = document.getElementById('nombre');
    var apellido = document.getElementById('apellido');
    var email = document.getElementById('email');

    // Campos PASES
    var pase_dia = document.getElementById('pase_dia');
    var pase_dosdias = document.getElementById('pase_dosdias');
    var pase_completo = document.getElementById('pase_completo');

    // BOTONES Y DIVS
    var calcular = document.getElementById('calcular');
    var errorDiv = document.getElementById('error');
    var botonRegistro = document.getElementById('btnRegistro');
    var lista_productos = document.getElementById('listaProductos');
    var suma = document.getElementById('suma-total');

    // EXTRAS
    var camisas = document.getElementById('camisa_evento');
    var etiquetas = document.getElementById('etiquetas');

    if(document.getElementById('calcular')) {

    calcular.addEventListener('click', calcularMontos);

    pase_dia.addEventListener('blur', mostrarDias);
    pase_dosdias.addEventListener('blur', mostrarDias);
    pase_completo.addEventListener('blur', mostrarDias);
    
    nombre.addEventListener('blur', validarCampos);
    apellido.addEventListener('blur', validarCampos);
    email.addEventListener('blur', validarCampos);
    email.addEventListener('blur', validarMail);

    function validarCampos() {
      if(this.value == '') {
        errorDiv.style = 'block';
        errorDiv.innerHTML = "Este campo es obligatorio";
        this.style.borderBottom = "1px solid #ff0000";
        errorDiv.style.border = "2px solid #ff0000";
      } else {
        errorDiv.style.display = 'none';
        this.style.borderBottom = "1px solid #e1e1e1";
      }
    }

    function validarMail(){
      if(this.value.indexOf("@") >-1) {
        errorDiv.style.display = 'none';
        this.style.borderBottom = "1px solid #e1e1e1";  
      } else {
        errorDiv.innerHTML = "Debe ser un e-mail válido";
        errorDiv.style = 'block';
        this.style.borderBottom = "1px solid #ff0000";
        errorDiv.style.border = "2px solid #ff0000";  
      }
    }

    function calcularMontos(event){
      event.preventDefault();
      if(regalo.value === ''){
        alert('Debes elegir un regalo');
        regalo.focus();
      } else {
        var boletosDia = parseInt (pase_dia.value, 10) || 0,
            boletos2Dias = parseInt (pase_dosdias.value, 10) || 0, 
            boletoCompleto = parseInt (pase_completo.value, 10) || 0,
            cantidadCamisas = parseInt (camisas.value, 10) || 0,
            cantidadEtiquetas = parseInt (etiquetas.value, 10) || 0;
        
        var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletoCompleto * 50) + ((cantidadCamisas * 10) * .93) + (cantidadEtiquetas * 2);
        
        var listadoProductos = [];

        if(boletosDia >= 1) {
          listadoProductos.push(boletosDia + ' Pases por dia');
        }
        if(boletos2Dias >= 1) {
          listadoProductos.push(boletos2Dias + ' Pases por 2 dias');
        }
        if(boletoCompleto >= 1) {
          listadoProductos.push(boletoCompleto + ' Pases completos');
        }
        if(cantidadCamisas >= 1) {
          listadoProductos.push(cantidadCamisas + ' Camisas');
        }
        if(cantidadEtiquetas >= 1) {
          listadoProductos.push(cantidadEtiquetas + ' Etiquetas');
        }
        
        lista_productos.style.display = "block";
        lista_productos.innerHTML = '';
        for(var i = 0; i< listadoProductos.length; i++) {
          lista_productos.innerHTML += listadoProductos[i] + '<br>';
        }
        suma.innerHTML = totalPagar.toFixed(2) + " €";  
      }
    }

    function mostrarDias() {
      var boletosDia = parseInt (pase_dia.value, 10) || 0,
          boletos2Dias = parseInt (pase_dosdias.value, 10) || 0, 
          boletoCompleto = parseInt (pase_completo.value, 10) || 0;      
      
      var diasElegidos = [];
      
      if(boletosDia > 0) {
        diasElegidos.push('viernes');
      }
      
      if(boletos2Dias > 0) {
        diasElegidos.push('viernes', 'sabado');
      }
      
      if(boletoCompleto > 0) {
        diasElegidos.push('viernes', 'sabado', 'domingo');  
      }
      for(var i = 0; i < diasElegidos.length; i++ ) {
        document.getElementById(diasElegidos[i]).style.display = 'block';
      }
    }
  }
  }); //DOM CONTENT LOADED
})();




// ==================================================================================
//Get the button
var mybutton = document.getElementById("myBtn");

//When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 170 || document.documentElement.scrollTop > 170) {
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

// Menú fijo
var windowHeight = $(window).height();
var barraAltura = $('.barra').innerHeight();
$(window).scroll(function(){
  var scroll = $(window).scrollTop();
  if (scroll > windowHeight) {
    $('.barra').addClass('fixed');
    $('body').css({'margin-top': barraAltura+'px'});
  } else {
    $('.barra').removeClass('fixed');
    $('body').css({'margin-top': '0px'});
  }
});

// Menú móvil
$('.menu-movil').on('click', function() {
  $('.navegacion-principal').slideToggle();

});



$(function() {
  // Lettering
  $('.nombre-sitio').lettering();
  
  // Programa de conferencias
  $('.programa-evento .info-curso:first').show();
  $('.menu-programa a:first').addClass('activo');
  $('.menu-programa a').on('click', function() {
    $('.menu-programa a').removeClass('activo');
    $(this).addClass('activo');
    $('.ocultar').fadeOut(500);
    var enlace = $(this).attr('href');
    $(enlace).fadeIn(500);
    return false;
  });

  // Colorbox
  $('a.galeria').colorbox({height:"auto", opacity:".6", rel:"group1"});

  // Animaciones para los numeros
  var resumenLista = $('.resumen-evento');
  if(resumenLista.length > 0) {
    $('.resumen-evento').waypoint(function(){
        $('.resumen-evento li:nth-child(1) p').animateNumber({ number: 6}, 1200);
        $('.resumen-evento li:nth-child(2) p').animateNumber({ number: 15}, 1200);
        $('.resumen-evento li:nth-child(3) p').animateNumber({ number: 3}, 1600);
        $('.resumen-evento li:nth-child(4) p').animateNumber({ number: 9}, 1500);
    },{
      offset: '30%'
    });
  }


  // Cuenta regresiva
  $('.cuenta-regresiva').countdown('2021/10/03 09:00:00', function(event){
    $('#dias').html(event.strftime('%D'));
    $('#horas').html(event.strftime('%H'));
    $('#minutos').html(event.strftime('%M'));
    $('#segundos').html(event.strftime('%S'));
  })



});

