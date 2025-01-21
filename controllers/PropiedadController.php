<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\PropiedadCaracteristica;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;
use Controllers\PropiedadCaracteristicasController;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $resultado = $_GET['resultado'] ?? null;
        $vendedores = Vendedor::all();

        $router->render('propiedades/admin',[
            "propiedades" => $propiedades,
            "resultado" => $resultado,
            "vendedores" => $vendedores
        ]);
    }
    public static function crear(Router $router){
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
    

        $errores = Propiedad::getErrores();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
            
            $propiedad = new Propiedad($_POST['propiedad']);
            
            //Generar nombre unico de imagen
            $nombreImagen = md5(uniqid(rand(),true) . '.jpg');
        
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $manager = new Image(Driver::class); 
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
                
            }
        
            
            
            
            $errores = $propiedad->validar();
            
        
            if(empty($errores)){
                
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
        
                //Guardar imagen en servidor
                $imagen->save(CARPETA_IMAGENES.$nombreImagen);
        
                $caracteristicas = $_POST['propiedad_caracteristicas'];
                //Guardar nueva propiedad
                $propiedad->guardar('admin',$caracteristicas);

                //Guardar caracteristicas de propiedad
                
            }
        }
        
        $router->render('/propiedades/crear',[
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
        
            
        
    }
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');

        $caracteristicas = PropiedadCaracteristica::find($id,true);
        $propiedad = Propiedad::find($id);       
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        
        
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
            //Asignar los atributos
            $args1 = $_POST['propiedad'];
            $args2 = $_POST['propiedad_caracteristicas'];
            
            
            $propiedad->sincronizar($args1);

            $arreglo =(array_values($args2));
            
            $i = 0;
                foreach($caracteristicas as $caracteristica){
                    $caracteristica->sincronizar($arreglo[$i]);
                    $i++;
                }
            
            
            
            

            
            
            
            //Validacion
            $propiedad->validar();
        
            //Generar nombre unico de imagen
            $nombreImagen = md5(uniqid(rand(),true) . '.jpg');
        
            
            //Subida de archivos
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $manager = new Image(Driver::class); 
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
                //Guardar imagen en servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }
            
            if(empty($errores)){
                //Guardar propiedad
                
                $propiedad->guardar('admin');
                
                foreach($caracteristicas as $caracteristica){
                    $caracteristica->guardar('admin');
                }
                
            }
        
        
            
        }
        

        $router->render('/propiedades/actualizar',[
            "propiedad" => $propiedad,
            "errores" => $errores,
            "vendedores" => $vendedores,
            "caracteristicas" => $caracteristicas]);

    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
                $tipo = $_POST['tipo'];
    
                if(validarTipoContenido($tipo)){
                   $propiedad = Propiedad::find($id); 
                   $propiedad->eliminar();
                }
            }
            
        }
    }
}
