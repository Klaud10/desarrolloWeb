<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
    
?>    

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina de practica sobre bienes raices">
    <title>Bienes raices</title>
    <link rel="icon" href="build/img/favicon1.png" type="image/png" sizes="16x16">
    <!---->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!---->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preload" href="/build/css/app.css" as="style">
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono del menu hamburguesa">
                </div>
                <div class="derecha">
                    
                    <img class="luna-crf dark-mode-boton" src="/build/img/dark-mode.svg" alt="Boton para modo nocturno">
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
                            <a class="cool-crf" href="/admin/">Administrar</a>
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