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
                                <li>
                                    <img class="icono" src="build/img/icono_wc.svg"
                                        alt="icono wc"
                                        loading="lazy">
                                    <p><?php ?></p>
                                </li>
                                <li>
                                    <img class="icono"
                                        src="build/img/icono_estacionamiento.svg"
                                        alt="icono estacionamiento" loading="lazy">
                                    <p><?php ?></p>
                                </li>

                                <li>
                                    <img class="icono"
                                        src="build/img/icono_dormitorio.svg"
                                        alt="icono dormitorio"
                                        loading="lazy">
                                    <p><?php ?></p>
                                </li>

                            </ul>

                            <a href="/propiedad?id=<?php echo $propiedad->id?>"
                                class="boton boton-amarillo-block">Ver
                                Propiedad</a>
                        </div>
                        
                    </div><!--Contenido Anuncio-->
                </div><!--Anuncio-->
        <?php }?>
            </div><!--Contenedor Anuncios-->