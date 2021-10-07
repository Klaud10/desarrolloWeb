<?php 

    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }

    //___Base de Datos___
    require '../../includes/config/database.php';
    $db = conectarDB();

    // ___Consultar BD para obtener vendedores___
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // ___Arreglo con mensajes de error ___
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    // ___Ejecutar el código después de que el usuario envia el formulario___ 
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";

            // echo "<pre>";
            // var_dump($_FILES);
            // echo "</pre>";
             
        $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
        $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string( $db, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento'] );
        $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor'] );
        $creado = date('Y/m/d');

        // ___Asignar files a una variable___
        $imagen = $_FILES['imagen'];
        
        if(!$titulo) {
            $errores[] = "Debes añadir un título";
        }
        if(!$precio) {
            $errores[] = "El precio es obligatorio";
        }
        if (strlen( $descripcion ) < 20) {
            $errores[] = "La descripción es obligatoria y 20 caracteres mínimo";
        }
        if(!$habitaciones) {
            $errores[] = "Debes indicar el número de habitaciones";
        }
        if(!$wc) {
            $errores[] = "Debes indicar el número de baños";
        }
        if(!$estacionamiento) {
            $errores[] = "Debes indicar el número de plazas de garage";
        }
        if(!$vendedorId) {
            $errores[] = "Debes elegir un vendedor";
        }
        if(!$imagen['name'] || $imagen['error']) {
            $errores[] = "La imagen es obligatoria";
        }

        // ___Validar por tamaño de imagen (1mb max.)___
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida ) {
            $errores[] = 'La imagen es muy pesada';
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // __Revisar que el arreglo de errores esté vacio(es decir: que no falte nada)__
        if(empty($errores)) {

            // __Subida de archivos___

            // Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            // Generar un nombre único para cada imagen
            $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";
            
            var_dump($nombreImagen);

            // Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
            
            // __Insertar en la base de datos__
            $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId ) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId') ";

            // echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado) {
            // __Redireccionar al usuario
                header('location: /admin?resultado=1');
            }
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
            <fieldset>
                <legend>Informacion General</legend>
                
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título de la propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" min="1" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Seleccione cantidad" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños</label>
                <input type="number" id="wc" name="wc" placeholder="Seleccione cantidad" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Plazas de garage</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Seleccione cantidad" min="0" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                 
                <select name="vendedor" id="">
                    <option value="">--Seleccione--</option>
                    
                    <?php while($vendedor = mysqli_fetch_assoc($resultado) ): ?>
                        
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> 
                        value="<?php echo $vendedor['id'];?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']?>
                        </option>

                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

    </main>
    
<?php 
    incluirTemplate('footer');
?>