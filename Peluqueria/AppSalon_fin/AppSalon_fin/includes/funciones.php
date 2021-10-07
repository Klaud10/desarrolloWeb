<?php
declare(strict_types=1);

function obtenerServicios() {
    try {
        // Importar una coneccion
        require 'databases.php';

        var_dump($db);

        // Escribir código SQL

        //Obtener resultados


    } catch (\Throwable $th) {
        //throw $th;

        var_dump($th);
    }
}

obtenerServicios();