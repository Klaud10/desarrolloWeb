<?php
// Conectar a la base de datos
require 'includes/config/database.php';
$db = conectarDB();   

// Autenticar el Usuario
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $email = mysqli_real_escape_string ($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ));
    $password = mysqli_real_escape_string ($db, $_POST['password']);

    if(!$email) {
        $errores[] = "Falta e-mail o no es valido";
    } 

    if(!$password) {
        $errores[] = "Falta password o no es correcto"; 
    }
    
    if(empty($errores)) {
    
        $query = "SELECT * FROM usuarios WHERE email = '${email}'"; // Revisar si el usuario existe
        $resultado = mysqli_query($db, $query);

   
        if( $resultado->num_rows ) {
                $usuario = mysqli_fetch_assoc($resultado); // revisar si el password es correcto
                $auth = password_verify($password, $usuario['password']); // verificar si el password es correcto

        if($auth) {
           
            session_start(); // Usuario autenticado

            $_SESSION['usuario'] = $usuario['email']; // Llenar el arreglo de sesion
            $_SESSION['login'] = true;

            header('location: /admin');

        } else {
            $errores[] = "La clave es incorrecta";        
        }    

        } else {
            $errores[] = "El usuario no existe";
        }
    }
}

// Incluye el header
    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error contenido-centrado">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario contenido-centrado" action="">
            <fieldset>
                <legend>E-mail y Contraseña</legend>
                
                <label for="email">E-Mail</label>
                <input type="email" name="email" placeholder="correo@correo.com" id="email" required>

                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Tu contraseña" id="password" requiered>

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>
    
<?php 
    incluirTemplate('footer');
?>