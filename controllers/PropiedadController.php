<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

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
        
                //Guardar nueva propiedad
                $propiedad->guardar();
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

        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    
            //Asignar los atributos
            $args = $_POST['propiedad'];
            
            $propiedad->sincronizar($args);
            
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
                
                $propiedad->guardar();
            }
        
        
            
        }
        

        $router->render('/propiedades/actualizar',[
            "propiedad" => $propiedad,
            "errores" => $errores,
            "vendedores" => $vendedores
        ]);

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
