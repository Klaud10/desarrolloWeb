<?php

namespace MVC;

class Router {
    
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }
    
    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if ($fn) {
            // La URL existe y tiene una función asociada
            call_user_func($fn, $this);
        } else {
            echo "<h1> ERROR 404 Página no encontrada (Boludo!!!) </h1>";
        }
    }

    // ___Muestra una vista___
    public function render($view, $datos = []) {

        foreach($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();    // Almacena un momento en memoria

        include __DIR__ . "/views/$view.php"; 
        $contenido = ob_get_clean();   // Limpia el buffer
        include __DIR__ . "/views/layout.php";
        }
}