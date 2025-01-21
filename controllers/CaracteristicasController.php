<?php

namespace Controllers;
use MVC\Router;
use Model\Caracteristica;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class CaracteristicasController {
    
    public static function index(Router $router){
        $caracteristicas = Caracteristica::all();
        $router->render('caracteristicas/listado',[
            "caracteristicas" => $caracteristicas
        ]);
    }

    public static function crear(Router $router){
        $caracteristica = new Caracteristica();
        $errores = Caracteristica::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $caracteristica = new Caracteristica($_POST['caracteristica']);

            

            if($_FILES['caracteristica']['tmp_name']['icono']){
                //Generar nombre unico de icono
                $nombreIcono = md5(uniqid(rand(),true).'.svg') .'.svg';
                
                $caracteristica->setIcono($nombreIcono);
                
            }

            $errores = $caracteristica->validar();

            if(empty($errores)){

                if(!is_dir(CARPETA_ICONOS)){
                    mkdir(CARPETA_ICONOS);
                }

                //Guardar icono en servidor
                
                move_uploaded_file($_FILES['caracteristica']['tmp_name']['icono'], CARPETA_ICONOS . $nombreIcono);

                
                $caracteristica->guardar('caracteristicas');
            }
        }

        $router->render('/caracteristicas/crear',[
            "caracteristica" => $caracteristica,
            "errores" => $errores,
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $caracteristica = Caracteristica::find($id);
        $errores = Caracteristica::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $args = $_POST['caracteristica'];

            
            $caracteristica->sincronizar($args);

            $caracteristica->validar();


            //Subida de Iconos
            if($_FILES['caracteristica']['tmp_name']['icono']){
               //Generar nombre unico de icono
               $nombreIcono = md5(uniqid(rand(),true).'.svg') .'.svg';
               $caracteristica->setIcono($nombreIcono);
               
               //Guardar icono en servidor
               move_uploaded_file($_FILES['caracteristica']['tmp_name']['icono'], CARPETA_ICONOS . $nombreIcono);
            }

           

            if(empty($errores)){
                $caracteristica->guardar('caracteristicas');
            }
        }


        $router->render('/caracteristicas/actualizar',[
            "caracteristica" => $caracteristica,
            "errores" => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
                $tipo = $_POST['tipo'];
    
                if(validarTipoContenido($tipo)){
                   $caracteristica = Caracteristica::find($id); 
                   $caracteristica->eliminar('caracteristicas');
                }
            }
            
        }
    }
}