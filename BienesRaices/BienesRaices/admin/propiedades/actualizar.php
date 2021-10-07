<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';

    estaAutenticado();
    
    // __Validar URL por ID válido__
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('location: /admin');
    }


    // ___Obtener datos de la propiedad___
    $propiedad = Propiedad::find($id);

    // ___Consulta para obtener todos los vendedores___
    $vendedores = Vendedor::all();

    // ___Arreglo con mensajes de error ___
    $errores = Propiedad::getErrores();

    // ___Ejecutar el código después de que el usuario envia el formulario___ 
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar los atributos
        $args = $_POST['propiedad'];
           
        $propiedad->sincronizar($args);   

        // Validacion
        $errores = $propiedad->validar();

        // Subida de archivos
        $nombreImagen = md5( uniqid( rand(), true )) . ".jpg"; //Genera el nombre del archivo    

        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }
        
        if(empty($errores)) {
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                // Almacenar la Imagen
                $image->save(CARPETA_IMAGENES . $nombreImagen); 
            }
            $propiedad->guardar();
        }
    }

    //___Header y footer___
   
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>
        
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST"  enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>

    </main>
    
<?php 
    incluirTemplate('footer');
?>