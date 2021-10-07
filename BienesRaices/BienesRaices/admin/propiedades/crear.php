<?php 

    require '../../includes/app.php';

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;
    
    estaAutenticado();

    $propiedad = new Propiedad;

    // Consulta para obtener todos los vendedores
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

    //___Header y footer___
    // require '../../includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>
        
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

    </main>
    
<?php 
    incluirTemplate('footer');
?>