<?php 
declare(strict_types=1);

function obtenerServicios() : array {
    try {
        
        // Importar una coneccion
        require 'databases.php';

        // escribir el código SQL
        $sql = "SELECT * FROM Servicios;";

        $consulta = mysqli_query($db, $sql);

        // Arreglo vacio
        $servicios = [];

        $i = 0;
        // Obtener resultados
        while( $row = mysqli_fetch_assoc($consulta) ){
            $servicios[$i]['id'] = $row['id'];
            $servicios[$i]['nombre'] = $row['nombre'];
            $servicios[$i]['precio'] = $row['precio'];

            $i++;
    
        }

        // echo "<pre>";
        // var_dump($servicios);
        // echo "</pre>";
        return $servicios;

    } catch (\Throwable $th) {
        //throw $th;

        var_dump($th);
    }
}

obtenerServicios();
