<fieldset>
        <legend>Informacion General</legend>
        
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del vendedor" value="<?php echo s( $vendedor->nombre ); ?>">

        <label for="nombre">Apellido</label>
        <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellidos del vendedor" value="<?php echo s( $vendedor->apellido ); ?>">
</fieldset> 

<fieldset>
        <legend>Informacion Complementaria</legend>

        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Número de teléfono" value="<?php echo s( $vendedor->telefono ); ?>">

</fieldset>        