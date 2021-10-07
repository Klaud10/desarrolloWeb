<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    if(!isset($inicio)) {
        $inicio = false;
    }
    
?>  


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina de practica sobre bienes raices">
    <title>Bienes raices</title>
    <link rel="icon" href="../public/build/img/favicon1.png" type="image/png" sizes="16x16">
    <!---->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!---->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

    <link rel="preload" href="../public/build/css/app.css" as="style">
    <link rel="stylesheet" href="../public/build/css/app.css" as="style">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="../public/build/img/logo.svg" alt="Logo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono del menu hamburguesa">
                </div>
                <div class="derecha">
                    
                    <img class="luna-crf dark-mode-boton" src="../public/build/img/dark-mode.svg" alt="Boton para modo nocturno">
                    <!-- <img class="sol-crf dark-mode-boton" src="build/img/sun.svg" alt="Boton para modo diurno"> -->

                    <nav class="navegacion">
                        <a class="cool-crf" href="/">Inicio</a>
                        <a class="cool-crf" href="/anuncios.php">Anuncios</a>
                        <a class="cool-crf" href="/nosotros.php">Nosotros</a>
                        <a class="cool-crf" href="/blog.php">Blog</a>
                        
                        <?php if(!$auth): ?>
                            <a class="cool-crf" href="/contacto.php">Contacto</a>
                        <?php endif ?>
                        
                        <?php if($auth): ?>
                            <a class="cool-crf" href="/admin">Administrar</a>
                        <?php endif ?>    

                        <?php if($auth): ?>
                            <a class="cool-crf" href="/cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif ?>

                        <?php if(!$auth): ?>
                            <a class="cool-crf" href="/login.php">Iniciar Sesión</a>
                        <?php endif ?>
                    </nav>
                </div>

               
            </div> <!--Cierra la barra-->
            <?php
                if($inicio){
                    echo "<h1>Venta de Casas y Apartamentos Exclusivos de Lujo</h1>";
                }
            ?>
        </div>
    </header>
    <!-- ====================================================================================== -->
    
    <?php echo $contenido ?>
    
    <!-- ====================================================================================== -->
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a class="cool-crf" href="/">Inicio</a>
                <a class="cool-crf" href="anuncios.php">Anuncios</a>
                <a class="cool-crf" href="nosotros.php">Nosotros</a>
                <a class="cool-crf" href="blog.php">Nuestro Blog</a>
                <a class="cool-crf" href="contacto.php">Contacto</a>
            </nav>
        </div>
       
        <p class="copyright">Todos los derechos reservados <?php echo date('Y')?>  &copy;</p>
    </footer>
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-up" width="48" height="48" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <polyline points="7 11 12 6 17 11" />
            <polyline points="7 17 12 12 17 17" />
        </svg>
    </button>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>

    <script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js'></script>

    <script src="../public/build/js/bundle.min.js"></script>
</body>
</html>