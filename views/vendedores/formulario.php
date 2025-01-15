<fieldset>
            <legend>Información general</legend>

            <label for="nombre">Nombre</label>
            <input name="vendedor[nombre]" type="text" id="nombre"
                placeholder="nombre vendedor" value="<?php echo s($vendedor->nombre);?>">

            <label for="apellido">Apellido</label>
            <input name="vendedor[apellido]" type="text" id="apellido"
                placeholder="apellido vendedor" value="<?php echo s($vendedor->apellido);?>">

</fieldset>

<fieldset>
    <legend>Información extra</legend>
    <label for="telefono">Teléfono</label>
            <input name="vendedor[telefono]" type="text" id="telefono"
                placeholder="telefono vendedor" value="<?php echo s($vendedor->telefono);?>">

</fieldset>