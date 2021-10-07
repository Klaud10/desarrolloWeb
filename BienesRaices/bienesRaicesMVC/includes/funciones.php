<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ .'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate( string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/${nombre}.php";
}
function estaAutenticado() : bool {
    
    session_start();
    
   if(!$_SESSION['login']) {
        header('Location: /');
    }
    return false;
} 

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// __Escapa / sanitizar el HTML ___
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// ___Validar tipo de contenido___
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

// ___Muestra los mensajes___
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch($codigo) {
        case 1 : 
            $mensaje = 'Creado Correctamente';
            break;
        case 2 : 
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3 : 
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;        
    }
    return $mensaje;
}

function validarORedirecionar(string $url) {
        // __Validar URL por ID válido__
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
    
        if(!$id) {
            header("location: ${url}");
        }
    return $id;
}