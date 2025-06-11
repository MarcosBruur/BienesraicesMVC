<main class="contenedor seccion contenido-centrado">
            <h1><?php echo $propiedad->titulo?></h1>
                <img src="/imagenes/<?php echo $propiedad->imagen?>" alt="imagen anuncio"
                    loading="lazy">
            

            <div class="resumen-propiedad">
                <p class="precio">$<?php echo $propiedad->precio?></p>
            <?php $i =0;
            ?>
                <ul class="iconos-caracteristicas">
                    <?php foreach($caracteristicas as $caracteristica) { ?>
                    <li>
                        <img class="icono" src="/iconos/<?php echo $iconos[$i]->icono;?>"
                            alt="icono wc"
                            loading="lazy">
                        <p><?php echo $caracteristica->cantidad?></p>
                    </li>
                    <?php $i++;} ?>
                </ul>
                <p><?php echo $propiedad->descripcion?>
                </p>
                <p><?php echo $propiedad->descripcion?>
                </p>

            </div>
        </main>