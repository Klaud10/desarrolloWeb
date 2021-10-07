<main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        
        <?php
            if($resultado) {
                 $mensaje = mostrarNotificacion(intval ($resultado));
                if ($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje) ?></p>
            <?php } 
    } 
    ?>    

        <a href="/public/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/public/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>

        <h2>Propiedades</h2>

        <table class="propiedades"> 
            <thead>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Vendedor</th>
                <th>Acciones</th>
            </thead>

            <tbody> <!--4__Mostrar los resultados -->
            <?php foreach($propiedades as $propiedad ): ?>
                <tr>
                    <td> <?php echo $propiedad->id ?> </td>
                    <td><?php echo $propiedad->titulo ?></td>
                    <td><img src="/public/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla"></td>
                    <td>€ <?php echo $propiedad->precio ?></td>
                    <td><?php echo $propiedad->vendedorId ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</main>    
