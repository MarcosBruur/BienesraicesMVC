<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $camposDB = ['id','titulo','precio','imagen',
    'descripcion','creado',
    'vendedores_id','cantidad_caracteristicas'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;

    public $descripcion;
   
    public $creado;
    public $vendedores_id;

    public $cantidad_caracteristicas;

    public function __construct($args =[]){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }


    public function validar(){
        //Gestionar errores

        if(!$this->titulo){
            self::$errores[] = 'Debes agregar un titulo';
        }

        if(!$this->precio){
            self::$errores[] = 'Debes agregar un precio';
        }

        if(strlen($this->descripcion) < 20){
            self::$errores[] = 'La descripcion es obligatoria y debe tener minimo 20 caracteres';
        }

        if(!$this->vendedores_id){
            self::$errores[] = 'Debes elegir un vendedor';
        }

        if(!$this->imagen){
            self::$errores[] = 'La imagen es obligatoria';
        }

       return self::$errores;

    }

    public function guardar($retorno,$caracteristicas = null):void{
        
        if(!is_null($this->id)){
            //Actualizando           
            $this->actualizar($retorno);
        }else{
            //Creando
            $this->crear($retorno,$caracteristicas);
        }
    }


    public function crear($retorno,$caracteristicas = null){
        //Sanitizar entradas
        $atributos = $this->sanitizarAtributos();
        
        
        //Insertar propiedad en BD
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(", ",array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .=  join("', '",array_values($atributos));
        $query .= "')";
        
        $resultado = self::$db->query($query);
        $propiedadId = self::$db->insert_id;
      

        if (!empty($caracteristicas)) {
            foreach ($caracteristicas as $key => $value) {
                // Obtener el ID de la característica
                $query = "SELECT id FROM caracteristicas WHERE nombre = '$key' LIMIT 1";
                $resultadoQuery = self::$db->query($query);
    
                if ($resultadoQuery && $resultadoQuery->num_rows > 0) {
                    $row = $resultadoQuery->fetch_assoc();
                    $caracteristicaId = $row['id'];
    
                    // Insertar en la tabla propiedad_caracteristica
                    $queryRelacion = "INSERT INTO propiedad_caracteristica (propiedad_id, caracteristica_id,cantidad) VALUES ('$propiedadId', '$caracteristicaId','$value')";
                    self::$db->query($queryRelacion);
                }
            }
        }
        if($resultado){
            header("Location:/{$retorno}?resultado=1");
        }
    }

}
