<?php 

namespace Model;

class Caracteristica extends ActiveRecord{
    protected static $tabla = 'caracteristicas';
    protected static $camposDB = ['id','nombre','icono'];

    public $id;
    public $nombre;
    public $icono;
    

    public function __construct($args =[]){
        
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->icono = $args['icono'] ?? '';
    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] = "Debes añadir un nombre"; 
        }
        if(!$this->icono){
            self::$errores[] = "Debes añadir un icono";
        }
        return self::$errores;
    }
}