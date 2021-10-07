<?php 
    require 'includes/app.php';
    incluirTemplate('header', $inicio = true);
?>

    <section class="contenedor seccion">
        <h1>Más sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>In finibus augue non eros vestibulum, maximus ornare tellus sollicitudin. Cras sit amet odio id purus pulvinar faucibus.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>In finibus augue non eros vestibulum, maximus ornare tellus sollicitudin. Cras sit amet odio id purus pulvinar faucibus.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>In finibus augue non eros vestibulum, maximus ornare tellus sollicitudin. Cras sit amet odio id purus pulvinar faucibus.</p>
            </div>
        </div>
    </section>
    
    <section class="seccion contenedor">
        <h2>Casas y Apartamentos en Venta</h2>
       
        <?php
            include 'includes/templates/anuncios.php';
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver todas</a>
        </div>
    </section>
    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contáctanos</a>
    </section>
    <aside class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jepg">
                        <a href="entrada.php"><img loading="lazy" src="build/img/blog1.jpg" alt="Imagen de terraza cubierta"></a>    
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php"><h4>Terraza en el techo de tu casa</h4></a>
                    <p>Escrito el: <span>10/03/2021</span> por: <span>Administrador</span></p>
                    <p>Consejos para construir una terraza en el techo de tu casa, con los mejores materiales y ahorrando dinero.</p>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jepg">
                        <a href="entrada.php"><img loading="lazy" src="build/img/blog2.jpg" alt="Imagen de terraza cubierta"></a>    
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php"><h4>Guia para la decoración de tu hogar</h4></a>
                    <p>Escrito el: <span>08/03/2021</span> por: <span>Administrador</span></p>
                    <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                </div>
            </article>
        </section>
        <section class="testimoniales">
            <h3>Testimonios</h3>
            <!-- <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Claudio Falabella</p>
            </div> -->

            <section class="testimonials py-5 text-white px-1 px-md-5 margin-top-xl">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-12">
              <!--         <h2 class="pt-2 text-center font-weight-bold">Our Customers Are Seeing Big Results</h2> -->
              
                      <div class="carousel-controls testimonial-carousel-controls">
                        <div class="control d-flex align-items-center justify-content-center prev mt-3"><i class="fa fa-chevron-left"></i></div>
                        <div class="control d-flex align-items-center justify-content-center next mt-3"><i class="fa fa-chevron-right"></i></div>
              
                        <div class="testimonial-carousel">
                          <div class="h5 font-weight-normal one-slide mx-auto">
                            <div class="testimonial w-100 px-3 text-center d-flex flex-direction-column justify-content-center flex-wrap align-items-center">
                                <div class="message text-center blockquote w-100">
                                  "El personal se comportó de una manera excelente, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas."
                                </div>
                              <div class="blockquote-footer w-100 text-white">Claudio</div>
                            </div>
                          </div>
                          <div class="h5 font-weight-normal one-slide mx-auto">
                            <div class="testimonial w-100 px-3 text-center  d-flex flex-direction-column justify-content-center flex-wrap align-items-center">
                              <div class="message text-center blockquote w-100">"Muy satisfecho con los servicios prestados y sobre todo pudimos vender rápido y a buen precio nuestra propiedad.
                                Ninguna queja."</div>
                              <div class="blockquote-footer w-100 text-white">Jim and Joe</div>
                            </div>
                          </div>
                          <div class="h5 font-weight-normal one-slide mx-auto">
                            <div class="testimonial w-100 px-3 text-center  d-flex flex-direction-column justify-content-center flex-wrap align-items-center">
                              <div class="message text-center blockquote w-100">He alquilado varias viviendas con ellos y hasta ahora estoy encantado con el trato recibido..</div>
                              <div class="blockquote-footer w-100 text-white">Juan</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

        </section>
    </aside>

<?php 
    incluirTemplate('footer');
?>