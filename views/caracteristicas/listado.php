

<main class="contenedor seccion">

<?php 
        $resultado = $_GET['resultado'];
        if($resultado){
            $mensaje= mostrarNotificacion(intval($resultado));
            if($mensaje){ ?>
            <p class="alerta exito"><?php echo s($mensaje);?></p>
            <?php } ?>
        <?php }?>

<a href="/admin" class="boton boton-verde">Volver</a>
<a href="/caracteristicas/crear" class="boton boton-verde">Añadir Caracteristica</a>

<h2>Caracteristicas</h2>
    <table class="propiedades">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Icono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($caracteristicas as $caracteristica):?>                       
                    <tr>
                        <td><?php echo $caracteristica->id ;?></td>
                        <td><?php echo  $caracteristica->nombre;?></td>
                        <td  class="icono" ><img src="/iconos/<?php echo $caracteristica->icono;?>"></td>
                        <td>
                            <form method="POST" action="/caracteristicas/eliminar">
                                <input type="hidden" name="id" value="<?php echo $caracteristica->id;?>">
                                <input type="hidden" name="tipo" value="caracteristica">
                                <input type="submit" class="boton-rojo-block" value="eliminar">
                            </form>
                            <a href="/caracteristicas/actualizar?id=<?php echo $caracteristica->id;?>"
                               class="boton-amarillo-block"
                            >
                               Actualizar
                            </a>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

</main>