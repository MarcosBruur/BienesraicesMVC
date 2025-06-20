<?php 
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\PropiedadCaracteristica;
use Model\Caracteristica;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('/paginas/index',[
            "propiedades" => $propiedades,
            "inicio" => $inicio
        ]);
    }
    public static function nosotros(Router $router){
        $router->render('/paginas/nosotros',[]);
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $caracteristicas =[];

        

        foreach($propiedades as $propiedad){
            $caracteristicas[$propiedad->id] = PropiedadCaracteristica::find($propiedad->id, true);    
        }

        
        $iconos = [];

        $cantidades = [];
        $i = 0;
        foreach($caracteristicas as $caracteristica){
            foreach($caracteristica as $valores){
                $cantidades[$i] = $valores->cantidad;
                $iconos[$i] = Caracteristica::find($valores->caracteristica_id)->icono;
                $i++;
            }
        }
        
        
        
        
        $router->render('/paginas/propiedades',[
            "propiedades" => $propiedades,
            "iconos" => $iconos,
            "cantidades" => $cantidades
        ]);
        
    }
    public static function propiedad(Router $router){
        $id = validarORedireccionar('/');
        $propiedad = Propiedad::find($id);
        $caracteristicas = PropiedadCaracteristica::find($id,true);
        
        
        

        foreach($caracteristicas as $caracteristica){
            $iconos[] = Caracteristica::find($caracteristica->caracteristica_id);
        }
        
        $router->render('/paginas/propiedad',[
            "propiedad" => $propiedad,
            "caracteristicas" => $caracteristicas,
            "iconos" => $iconos
        ]);
    }
    public static function entrada(Router $router){
        $router->render('/paginas/entrada',[]);
    }
    
    public static function blog(Router $router){
        $router->render('/paginas/blog',[]);
    }
    
    public static function contacto(Router $router){
        $mensaje = null;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

           $respuestas = $_POST['contacto'];
           //Crear instancia de PHPMailer
           $mail = new PHPMailer();

           //Configurar SMTP
           $mail->isSMTP();
           $mail->Host = "sandbox.smtp.mailtrap.io";
           $mail->SMTPAuth = true;
           $mail->Username = "67cf90e28602b1";
           $mail->Password = "23c2f15e1989ca";
           $mail->SMTPSecure = "tls";
           $mail->Port = "2525";

           //Configurar contenido de Email
           $mail->setFrom("admin@bienesraices.com");
           $mail->addAddress("admin@bienesraices.com","BienesRaices.com");
           $mail->Subject = "Tienes un nuevo mensaje";

           //Habilitar HTML
           $mail->isHTML(true);
           $mail->CharSet = "UTF-8";


           //Definir contenido HTML
           $contenido = "<html>";
           $contenido .= "<p>Tienes un nuevo mensaje </p>";
           $contenido .= "<p>Nombre: " .$respuestas['nombre'].  "</p>";

            if($respuestas['contacto'] === 'telefono'){
                $contenido .= "<p>Quiere ser contactado por teléfono </p>";
                $contenido .= "<p>Teléfono: " .$respuestas['telefono'].  "</p>";
                $contenido .= "<p>Fecha de contacto: " .$respuestas['fecha'].  "</p>";
                $contenido .= "<p>Hora de contacto: " .$respuestas['hora'].  "</p>";

            }else{
                $contenido .= "<p>Quiere ser contactado por email </p>";
                $contenido .= "<p>Email: " .$respuestas['email'].  "</p>";
            }

           
          
           $contenido .= "<p>Mensaje: " .$respuestas['mensaje'].  "</p>";
           $contenido .= "<p>Vende o Compra: " .$respuestas['tipo'].  "</p>";
           $contenido .= "<p>Precio o Presupuesto: $" .$respuestas['precio'].  "</p>";
           $contenido .= "<p>Prefiere ser contactado por: " .$respuestas['contacto'].  "</p>";
           $contenido .= "</html>";
           

           $mail->Body = $contenido;
           $mail->AltBody = "Texto alternativo";

           //Enviar mail
           if($mail->send()){
            $mensaje = "mensaje enviado";
           }else{
            $mensaje = "El mensaje no se pudo enviar";
           }




        }

        $router->render('/paginas/contacto',[
            "mensaje" => $mensaje
        ]);
    }
}
