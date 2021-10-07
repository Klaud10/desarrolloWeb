<?php 
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('location: /');
    }

// Importar la conección con BD
    require 'includes/config/database.php';
    $db = conectarDB();

// Consultar la BD
    $query = "SELECT * FROM propiedades WHERE id = ${id}";

// Obtener resultados  
    $resultado = mysqli_query($db, $query);

    if (!$resultado->num_rows){
        header('location: /anuncios.php');
    }    

    $propiedad = mysqli_fetch_assoc($resultado);

// Incluir header 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>
          
            <!--Mi slider-->
        <div class="product-slider">
            <div id="carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <picture class="item active"> 
                        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la Propiedad"> 
                    </picture>
                    <picture class="item"> 
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jepg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen de la Propiedad"> 
                    </picture>
                    <picture class="item"> 
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jepg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Imagen de la Propiedad"> 
                    </picture>
                    <picture class="item"> 
                        <source srcset="build/img/blog3.webp" type="image/webp">
                        <source srcset="build/img/blog3.jpg" type="image/jepg">
                        <img loading="lazy" src="build/img/blog3.jpg" alt="Imagen de la Propiedad"> 
                    </picture>
                    <picture class="item"> 
                        <source srcset="build/img/blog4.webp" type="image/webp">
                        <source srcset="build/img/blog4.jpg" type="image/jepg">
                        <img loading="lazy" src="build/img/blog4.jpg" alt="Imagen de la Propiedad"> 
                    </picture>
                </div>
                <div class="clearfix">
                    <div id="thumbcarousel" class="carousel slide" data-interval="false">
                        <div class="carousel-inner">
                            <div class="item active">
                                <div data-target="#carousel" data-slide-to="0" class="thumb">
                                    
                                    <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la Propiedad">
                                </div>
                                <div data-target="#carousel" data-slide-to="1" class="thumb">
                                    <source srcset="build/img/blog1.webp" type="image/webp">
                                    <source srcset="build/img/blog1.jpg" type="image/jepg">
                                    <img src="build/img/blog1.jpg" alt="Imagen de la Propiedad">
                                </div>
                                <div data-target="#carousel" data-slide-to="2" class="thumb">
                                    <source srcset="build/img/blog2.webp" type="image/webp">
                                    <source srcset="build/img/blog2.jpg" type="image/jepg">
                                    <img src="build/img/blog2.jpg" alt="Imagen de la Propiedad">
                                </div>
                                <div data-target="#carousel" data-slide-to="3" class="thumb">
                                    <source srcset="build/img/blog3.webp" type="image/webp">
                                    <source srcset="build/img/blog3.jpg" type="image/jepg">
                                    <img src="build/img/blog3.jpg" alt="Imagen de la Propiedad">
                                </div>
                                <div data-target="#carousel" data-slide-to="4" class="thumb">
                                    <source srcset="build/img/blog4.webp" type="image/webp">
                                    <source srcset="build/img/blog4.jpg" type="image/jepg">
                                    <img src="build/img/blog4.jpg" alt="Imagen de la Propiedad">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!--Fin mi slider-->  
            
            <div class="resumen-propiedad">
                <p class="precio">€ <?php echo $propiedad['precio']; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono wc">
                        <p><?php echo $propiedad['wc']; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono plazas de garage">
                        <p><?php echo $propiedad['estacionamiento']; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
                        <p><?php echo $propiedad['habitaciones']; ?></p>
                    </li>
                </ul>

                <p><?php echo $propiedad['descripcion']; ?></p>
                   
            </div><!--.contenido-anuncio-->
        
    </main>
   
<?php 
    mysqli_close($db);

    incluirTemplate('footer');
?>