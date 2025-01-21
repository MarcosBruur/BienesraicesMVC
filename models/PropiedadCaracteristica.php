<?php 

namespace Model;

use Model\ActiveRecord;

class PropiedadCaracteristica extends ActiveRecord{
    protected static $tabla = 'propiedad_caracteristica';
    protected static $camposDB = ['id','propiedad_id',
    'caracteristica_id','cantidad'];

    public $id;
    public $propiedad_id;
    public $caracteristica_id;
    public $cantidad;


    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->propiedad_id = $args['propiedad_id'] ?? null;
        $this->caracteristica_id = $args['caracteristica_id'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
    }

    public function crear($retorno){
        //Sanitizar entradas
        $atributos = $this->sanitizarAtributos();
       
        

        //Insertar formulario en BD
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(", ",array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .=  join("', '",array_values($atributos));
        $query .= "')";
        
        
        $resultado = self::$db->query($query);

        
    }

    public function sincronizar($args = null ){
        if(!is_null($args)){
            $this->cantidad = $args;
        }
    }
}