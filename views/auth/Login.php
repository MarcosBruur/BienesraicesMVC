<main class="contenedor seccion">
            <h1>Iniciar Sesión</h1>

            <?php foreach($errores as $error ):?>
                <div class="alerta error">
                    <?php echo $error;?>
                </div>
            <?php endforeach;?>

            <form method="POST" class="formulario" action="/login">
                <fieldset>
                    <legend>Información personal</legend>
                    
                    <label for="email">E-Mail</label>
                    <input type="email" placeholder="Tu mail" id="mail" name="email">
    
                    <label for="password">Password</label>
                    <input type="password" placeholder="Tu contraseña" id="password" name="password">
                </fieldset>
                <input type="submit" class="boton boton-verde" value="Iniciar Sesión">
            </form>
            
        </main>