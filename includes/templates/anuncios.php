<?php 
use App\Propiedad;


if($_SERVER['SCRIPT_NAME']==='/bienesraices/anuncios.php'){
    
    $propiedades = Propiedad::all();
}else{
    $propiedades = Propiedad::get(3);
}

?>

<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad){ ?>
                <div class="anuncio">
                    <img src="/bienesraices/imagenes/<?php echo $propiedad->imagen?>" alt="imagen anuncio"
                         loading="lazy">
                    <div class="contenido-anuncio">
                        <h3><?php echo $propiedad->titulo?></h3>
                        <p><?php echo $propiedad->descripcion ?></p>
                        <p class="precio">$<?php echo $propiedad->precio?></p>

                        <ul class="iconos-caracteristicas">
                            <li>
                                <img class="icono" src="build/img/icono_wc.svg"
                                    alt="icono wc"
                                    loading="lazy">
                                <p><?php echo $propiedad->wc?></p>
                            </li>
                            <li>
                                <img class="icono"
                                    src="build/img/icono_estacionamiento.svg"
                                    alt="icono estacionamiento" loading="lazy">
                                <p><?php echo $propiedad->estacionamientos?></p>
                            </li>

                            <li>
                                <img class="icono"
                                    src="build/img/icono_dormitorio.svg"
                                    alt="icono dormitorio"
                                    loading="lazy">
                                <p><?php echo $propiedad->habitaciones?></p>
                            </li>

                        </ul>

                        <a href="/bienesraices/anuncio.php?id=<?php echo $propiedad->id?>"
                            class="boton boton-amarillo-block">Ver
                            Propiedad</a>
                    </div><!--Contenido Anuncio-->
                </div><!--Anuncio-->
        <?php }?>
            </div><!--Contenedor Anuncios-->