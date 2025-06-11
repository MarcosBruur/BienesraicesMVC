<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad){ ?>
                <div class="anuncio">
                    <img src="/imagenes/<?php echo $propiedad->imagen?>" alt="imagen anuncio"
                         loading="lazy">
                    <div class="contenido-anuncio">
                        <div class="contenido-texto">
                            <h3><?php echo $propiedad->titulo?></h3>
                            <p><?php echo $propiedad->descripcion ?></p>
                        </div>
                        
                        <div class="contenido-caracteristicas">
                            <p class="precio">$<?php echo $propiedad->precio?></p>
                            <ul class="iconos-caracteristicas">
                                    <?php for($i=0; $i < $propiedad->cantidad_caracteristicas; $i++);  { ?>
                                    <li>
                                        <?php for($i=0; $i < 3; $i++){ ?>
                                        <img class="icono" src="/iconos/<?php echo $iconos[$i]?>"
                                            alt="icono"
                                            loading="lazy">
                                        <p><?php echo $cantidades[$i]?></p>
                                        <?php } ?>
                                        
                                    </li>
                                    <?php } ?>
                                </ul>

                            <a href="/propiedad?id=<?php echo $propiedad->id?>"
                                class="boton boton-amarillo-block">Ver
                                Propiedad</a>
                        </div>
                        
                    </div><!--Contenido Anuncio-->
                </div><!--Anuncio-->
        <?php }?>
</div><!--Contenedor Anuncios-->