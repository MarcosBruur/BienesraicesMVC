<?php 

namespace Model;

class ActiveRecord{
    //BD
    protected static $db;
    protected static $camposDB = [];
    protected static $tabla = '';

    //Errores
    public static $errores = [];

  

    

    //Conectar a DB
    public static function setDB($db){
        self::$db = $db;
    }

    public function guardar():void{
        
        if(!is_null($this->id)){
            //Actualizando           
            $this->actualizar();
        }else{
            //Creando
            $this->crear();
        }
    }
    public function crear(){
        //Sanitizar entradas
        $atributos = $this->sanitizarAtributos();
        

        //Insertar formulario en BD
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(", ",array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .=  join("', '",array_values($atributos));
        $query .= " ')";
        
        $resultado = self::$db->query($query);

        if($resultado){
            header('Location:/admin?resultado=1');
        }
    }

    public function actualizar(){
        //Sanitizar entradas
        $atributos = $this->sanitizarAtributos();
        
        
        $valores = [];

        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
        

        $query = "UPDATE ".static::$tabla." SET ";
        $query .= join(', ',$valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";
        
        

        $resultado = self::$db->query($query);
        
        if($resultado){
            header('Location: /admin?resultado=2');
        }

    }

    public function eliminar(){
        //Desvincular vendedor en caso de tener propiedad asignada   
        
        if(static::$tabla === 'vendedores'){
            $query = "UPDATE propiedades SET vendedores_id = NULL where vendedores_id =  ".self::$db->escape_string($this->id);
            
            self::$db->query($query);
        }

        $query = "DELETE FROM ".static::$tabla." WHERE id = ". self::$db->escape_string($this->id);

        $resultado = self::$db->query($query);
        
        if($resultado){
            $this->eliminarImagen();
            header("Location: /admin?resultado=3");
        }
    }

    public function atributos(){
        $atributos = [];
        
        foreach(static::$camposDB as $campo){
            if($campo === 'id') continue;
            $atributos[$campo] = $this->$campo; 
        }
        
        return $atributos;
    }
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        };

        return $sanitizado;
    }

    public static function getErrores(){
        return static::$errores;
    }

    public function validar(){

       static::$errores = [];
       return static::$errores;

    }
    //Modificar archivos
    public function setImagen($imagen){
        //Eliminar imagen previa
        if(!is_null($this->id)){
            $this->eliminarImagen();
        }

        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Eliminar archivos
    public function eliminarImagen(){
        $exiteArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($exiteArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
    }
    public static function all(){
        $query = "SELECT * FROM ".static::$tabla;
        $resultado =self::consultarSQL($query);
        
        return $resultado;
    }

    //Obtener cantidad de registros 
    public static function get($cantidad){
        $query = "SELECT * FROM ".static::$tabla." LIMIT ".$cantidad;
        $resultado =self::consultarSQL($query);
        
        return $resultado;
    }

    public static function find($id){
        $query = "SELECT * FROM ".static::$tabla." WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        $resultado = self::$db->query($query);
        
        $array= [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }
        
        $resultado->free();

        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if( property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Sincronizar objeto en memoria con info insertada por usuario

    public function sincronizar($args =[]){
        foreach($args as $key => $value){
            
            if(property_exists($this,$key) && !is_null($value)){
                $this->$key =$value;
            }
        }
        
    }
}