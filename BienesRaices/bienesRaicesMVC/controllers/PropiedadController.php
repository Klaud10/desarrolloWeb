<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router) {
        
        $propiedades = Propiedad::all();
           // __Muestra un mensaje condicional__
        $resultado = $_GET['resultado'] ?? null;
       
        $router->render('propiedades/admin', [
            'propiedades'=> $propiedades,
            'resultado'=> $resultado
        ]);
    }

    public static function crear(Router $router) {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        // ___Arreglo con mensajes de error ___
        $errores = Propiedad::getErrores();

        // ___Ejecutar el código después de que el usuario envia el formulario___ 
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Crear una nueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);

                    // __Subida de archivos___

       // Generar un nombre único para cada imagen
        $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";

        // setear la imagen
        // ___Realiza un resize a la imagen con INTERVENTION___ 
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }
     
        // Validar
        $errores = $propiedad->validar();

        // __Revisar que el arreglo de errores esté vacio(es decir: que no falte nada)__
        if(empty($errores)) {

                // Crear carpeta
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            // Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            // Guarda en la base de satos
            $propiedad->guardar();  
        }
    }

        $router->render('/propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores'=> $errores
        ]);
    }

    public static function actualizar(Router $router){
        
        $id = validarORedirecionar('/admin'); 
        
        $propiedad = Propiedad::find($id);

        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }
}
