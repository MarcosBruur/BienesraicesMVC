<?php


define('TEMPLATES_URLS', __DIR__ .'/templates');
define('FUNCIONES_URLS',__DIR__ .'funciones.php');
define('CARPETA_IMAGENES',$_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
function incluirTemplate(string $template,bool $inicio = false){
    
    include TEMPLATES_URLS . "/{$template}.php";
}

function estaAutenticado():void{
    session_start();

    if(!$_SESSION['login']){
       header('Location: /bienesraices/index.php');
    }
   
}

function debug($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapar HTML
function s($html):string{
    $s = htmlspecialchars($html);
    return $s;
}


//Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ['propiedad','vendedor'];
    
    return in_array($tipo,$tipos);
}

//Mostrar alertas/notificaciones

function mostrarNotificacion($codigo){
    $menaje = '';

    switch ($codigo){
        case 1: 
            $mensaje ='Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $menaje = false;
            break;

    }
    return $mensaje;

}

function validarORedireccionar($url){
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: {$url}");
    }
    return $id;
}
