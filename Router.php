<?php
namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url,$function){
        $this->rutasGET[$url] = $function;
    }

    public function post($url,$function){
        $this->rutasPOST[$url] = $function;
    }
    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null;


        //Rutas protegidas
        $rutasProtegidas = ['/admin',
        '/propiedades/crear',
        '/propiedades/actualizar',
        '/propiedades/eliminar',
        '/vendedores/crear',
        '/vendedores/actualizar',
        '/vendedores/eliminar'        
        ];


        $urlActual = $_SERVER['PATH_INFO'] ?? "/";
        $metodo = $_SERVER['REQUEST_METHOD'];
        
        if($metodo === 'GET'){
            $function = $this->rutasGET[$urlActual] ?? null;
        }else{
            
            $function = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger rutas

        if(in_array($urlActual,$rutasProtegidas) && !$auth){
            header('Location: /');
        }

        if($function){
            //La pagina exite y tiene una funcion asociada
            call_user_func($function,$this);
        }else{
            echo "Pagina no encontrada";
        }
    }

    //Muestra una vista
    public function render($view,$datos = []){
        foreach($datos as $key =>$value){
            $$key = $value;
        }

        ob_start();
        include __DIR__ . '/views/'.$view.'.php';

        $contenido = ob_get_clean();

        include __DIR__ . '/views/layout.php';
    }
}