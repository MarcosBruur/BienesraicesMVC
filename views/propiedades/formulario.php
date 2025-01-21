<fieldset>
            <legend>Información general</legend>

            <label for="titulo">Titulo</label>
            <input name="propiedad[titulo]" type="text" id="titulo"
                placeholder="titulo propiedad" value="<?php echo s($propiedad->titulo);?>">

            <label for="precio">Precio</label>
            <input name="propiedad[precio]" type="number" id="precio"
                placeholder="precio propiedad" value="<?php echo s($propiedad->precio)?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

            <?php if($propiedad->imagen){?>
                <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
            <?php }?>
            <label for="descripcion">Descripcion</label>
            <textarea name="propiedad[descripcion]" id="descripcion"><?php echo s($propiedad->descripcion);?></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input name="propiedad_caracteristicas[habitaciones]" type="number" id="habitaciones" placeholder="Ej:3" min="1"
                max="9" value="<?php echo !empty($caracteristicas[0]->cantidad)?$caracteristicas[0]->cantidad:null ?>">

            <label for="wc">Baños</label>
            <input name="propiedad_caracteristicas[wc]" type="number" id="wc" placeholder="Ej:3" min="1"
                max="9" value="<?php echo !empty($caracteristicas[1]->cantidad)?$caracteristicas[1]->cantidad:null  ?>">

            <label for="estacionamientos">Estacionamientos</label>
            <input name="propiedad_caracteristicas[estacionamientos]" type="number" id="estacionamientos" placeholder="Ej:3" min="1"
                max="9" value="<?php echo !empty($caracteristicas[2]->cantidad)?$caracteristicas[2]->cantidad:null?>">

        </fieldset> 

        <fieldset>
            <legend>Vendedor</legend>
            
            <label for="vendedor">Vendedor</label>
            <select name="propiedad[vendedores_id]" id="vendedor">
                    <option selected value="">--Seleccione--</option>
                    <?php foreach ($vendedores as $vendedor) { ?>
                        <option
                        <?php echo $propiedad->vendedores_id === $vendedor->id ? "selected" : ''; ?> 
                        value="<?php echo s($vendedor->id)?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido);?></option>
                    <?php } ?>
            </select>
    
        </fieldset>