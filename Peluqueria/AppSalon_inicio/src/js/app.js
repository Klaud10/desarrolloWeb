let pagina = 1

const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    mostrarServicios();

    //___Resalta el DIV actual segun el tab al que se presiona
    mostrarSeccion();

    //__Oculta o muestra una seccion segun el tab que se presiona
    cambiarSeccion();

    //Paginacion siguiente y anterior
    paginaSiguiente();

    paginaAnterior();

    //Comprueba la pagina actual para ocultar o mostrar la paginacion
    botonesPaginador();

    //Muestra el resumen de la cita o mensaje de error (en caso de no pasar la validacion)
    mostrarResumen();

    //Almacena el nombre de la cita en el objeto
    nombreCita();

    //Almacenar la fecha de la cita en el objeto
    fechaCita();

    //Desabilita dias pasados
    desabilitarFechaAnterior();

    //Almacena la hora de la cita en el objeto
    horaCita();
}

function mostrarSeccion() {

    //Eliminar mostrar seccion de la seccion anterior
    const seccionAnterior = document.querySelector('.mostrar-seccion');
    if( seccionAnterior ) {
        seccionAnterior.classList.remove('mostrar-seccion');
    }

    const seccionActual = document.querySelector(`#paso-${pagina}`);
    seccionActual.classList.add('mostrar-seccion');

    //Eliminar la clase de actual en el tab anterior
    const tabAnterior = document.querySelector('.tabs button.actual');
    if( tabAnterior ) {
        tabAnterior.classList.remove('actual');
    }
    
    

    //___Resalta el Tab actual
    const tab = document.querySelector(`[data-paso="${pagina}"]`);
    tab.classList.add('actual');
}

function cambiarSeccion() {
    const enlaces = document.querySelectorAll('.tabs button');

    enlaces.forEach( enlace => {
        enlace.addEventListener('click', e => {
            e.preventDefault();
            pagina = parseInt(e.target.dataset.paso);

           //Llamar la funcion de mostrar seccion
            mostrarSeccion();

            botonesPaginador();
        })
    })
}

async function mostrarServicios() {
    try {

        const url = 'http://localhost:3000/servicios.php'

        const resultado = await fetch(url);
        const db = await resultado.json();

        // console.log(db);
        
        // const { servicios } = db;
        
        //____Generar el HTML____
        db.forEach( servicio => {
            const { id, nombre, precio } = servicio;
        
            //___DOM Scripting___
            //___Generar nombre del servicio
            const nombreServicio = document.createElement('P');
            nombreServicio.textContent = nombre;
            nombreServicio.classList.add('nombre-servicio');

            //__Generar precio
            const precioServicio = document.createElement('P');
            precioServicio.textContent = `€ ${precio}`;
            precioServicio.classList.add('precio-servicio');

            //___Generar DIV contenedor de servicio
            const servicioDiv = document.createElement('DIV');
            servicioDiv.classList.add('servicio');
            servicioDiv.dataset.idServicio = id;

            //___Selecciona un servicio para la cita
            servicioDiv.onclick = seleccionarServicio; 

            //___Inyectar precio y nombre al div class="servicio"__
            servicioDiv.appendChild(nombreServicio);
            servicioDiv.appendChild(precioServicio);

            //___Inyectarlo en el HTML
            document.querySelector('#servicios').appendChild(servicioDiv);

        })
    } catch (error) {
        console.log(error);
    }
}

function seleccionarServicio(e) {
    
    let elemento;
    //Forzar que el elemento al que le damos click sea el DIV
    if (e.target.tagName === 'P') {
        elemento = e.target.parentElement;
    } else {
        elemento = e.target;
    }
    if (elemento.classList.contains('seleccionado')) {
        elemento.classList.remove('seleccionado');

        const id = parseInt(elemento.dataset.idServicio);
        
        eliminarServicio(id);
    } else {
        elemento.classList.add('seleccionado'); 

        const servicioObj = {
            id: parseInt(elemento.dataset.idServicio ),
            nombre: elemento.firstElementChild.textContent,
            precio: elemento.firstElementChild.nextElementSibling.textContent
        }
        // console.log(servicioObj);
        agregarServicio(servicioObj);
    }
}

function eliminarServicio(id) {
    const { servicios } = cita;
    cita.servicios = servicios.filter( servicio => servicio.id !== id );

    console.log(cita);
}

function agregarServicio(servicioObj) {
    const { servicios } = cita;
    cita.servicios = [...servicios, servicioObj];

    console.log(cita);
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', () => {
        pagina++;
        botonesPaginador();
    });
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', () => {
        pagina--;
        botonesPaginador();
    });
}

function botonesPaginador() {
    const paginaSiguiente = document.querySelector('#siguiente');
    const paginaAnterior = document.querySelector('#anterior');

    if(pagina === 1) {
        paginaAnterior.classList.add('ocultar');
    } else if (pagina === 3) {
        paginaSiguiente.classList.add('ocultar');
        paginaAnterior.classList.remove('ocultar');
    
        mostrarResumen(); //Estamos en la pag 3, carga el resumen de la cita  
    
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion(); // Cambia la seccion que se muestra por la de la pagina
}

function mostrarResumen() {
    
    //Destructuring
    const { nombre, fecha, hora, servicios } = cita;

    //Seleccionar el resumen
    const resumeDiv = document.querySelector('.contenido-resumen');

    //Limpia el HTML previo
    while ( resumeDiv.firstChild ) {
        resumeDiv.removeChild( resumeDiv.firstChild );
    }
    
    //Validacion de objeto
    if(Object.values(cita).includes('')) {
        const noServicios = document.createElement('P');
        noServicios.textContent = 'Faltan datos de servicios, cita o nombre';
        noServicios.classList.add('invalidar-cita');

        //Agregar a resumenDiv
        resumeDiv.appendChild(noServicios);

        return;
    }

    //Mostrar el resumen
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de la Cita';

    const nombreCita = document.createElement('P');
    nombreCita.innerHTML = `<span>Nombre:</span> ${nombre}`;

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fecha}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Hs.`;

    const serviciosCita = document.createElement('DIV');
    serviciosCita.classList.add('resumen-servicios');

    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de los Servicios';

    serviciosCita.appendChild(headingServicios);

    let cantidad = 0;

    //Iterar sobre el arreglo de servicios
    servicios.forEach( servicio => {
        
        const { nombre, precio } = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.textContent = precio;
        precioServicio.classList.add('precio');

        const totalServicio = precio.split('€');
        // console.log(parseInt(totalServicio[1].trim() )); 

        cantidad += parseInt(totalServicio[1].trim());

        //Colocar texto y precio en el div
        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        serviciosCita.appendChild(contenedorServicio);

    } );
    
    resumeDiv.appendChild(headingCita);
    resumeDiv.appendChild(nombreCita);
    resumeDiv.appendChild(fechaCita);
    resumeDiv.appendChild(horaCita);
    resumeDiv.appendChild(serviciosCita);

    const cantidadPagar = document.createElement('P');
    cantidadPagar.classList.add('total');
    cantidadPagar.innerHTML = `<span>Total a pagar: </span>€ ${cantidad}`;
    resumeDiv.appendChild(cantidadPagar);

}

function nombreCita() {
    const nombreInput = document.querySelector('#nombre');
    
    nombreInput.addEventListener('input', e => {
        const nombreTexto = e.target.value.trim();
        
        //Validacion de que nombreTexto tiene algo
        if( nombreTexto === '' || nombreTexto.length < 3 ) {
            mostrarAlerta('Nombre no valido', 'error')
        } else {
            const alerta = document.querySelector('.alerta');
            if(alerta) {
                alerta.remove();
            }
            cita.nombre = nombreTexto;
        }
    });
}

function mostrarAlerta(mensaje, tipo) {

    //Si hay una alerta previa, entonces no crear otra
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        return;
    }  
    
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');

    if(tipo === 'error') {
        alerta.classList.add('error');
    }
    //Insertar en el HTML
    const formulario = document.querySelector('.formulario');
    formulario.appendChild( alerta );

    //Eliminar la alerta después de 3seg.
    setTimeout(() => {
        alerta.remove();
    }, 3000);
}

//Almacenar la fecha de la cita en el objeto

function fechaCita() {
    const fechaInput = document.querySelector('#fecha');
    fechaInput.addEventListener('input', e => {
        
        const dia = new Date(e.target.value).getUTCDay();

        if([0,1].includes(dia)){
            e.preventDefault();
            fechaInput.value ='';
            mostrarAlerta('Domingos y lunes, descanso del personal', 'error');
        } else {
            cita.fecha = fechaInput.value;
            console.log(cita);
        }
    })
}

function desabilitarFechaAnterior() {
    const inputFecha = document.querySelector('#fecha');
    
    const fechaAhora = new Date();
    const year = fechaAhora.getFullYear();
    const mes = fechaAhora.getMonth() + 1;
    const dia = fechaAhora.getDate() ;
    //Formato deseado AAAA-MM-DD
    const fechaDesabilitar = `${year}-${mes < 10? `0${mes}`:mes}-${dia < 10? `0${dia}` :dia}`;
    
    inputFecha.min = fechaDesabilitar;
}

function horaCita() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', e => {
        
        const horaCita = e.target.value;
        const hora = horaCita.split(':');
        
        if(hora[0] < 10 || hora[0] > 19 ) {
            mostrarAlerta('Hora no válida', 'error');
            setTimeout(() => {
                inputHora.value = '';
            }, 3000);
        } else{
            cita.hora = horaCita;
            // console.log(cita);
        }
    });
}