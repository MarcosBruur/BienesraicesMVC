<fieldset>
            <legend>Información general</legend>

            <label for="nombre">Nombre</label>
            <input name="caracteristica[nombre]" type="text" id="nombre"
                placeholder="nombre caracteristica" value="<?php echo s($caracteristica->nombre);?>">

                <label for="icono">Icono</label>
                <input type="file" id="icono" accept="image/svg+xml" name="caracteristica[icono]">
</fieldset>
