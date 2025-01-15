<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $camposDB = ['id','titulo','precio','imagen',
    'descripcion','habitaciones','wc','estacionamientos','creado',
    'vendedores_id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedores_id;

    public function __construct($args =[]){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamientos = $args['estacionamientos'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedorId'] ?? '';
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

        if(!$this->habitaciones){
            self::$errores[] = 'La cantidad de habitaciones es obligatorio';
        }

        if(!$this->wc){
            self::$errores[] = 'La cantidad de baños es obligatorio';
        }

        if(!$this->estacionamientos){
            self::$errores[] = 'La cantidad de estacionamientos es obligatorio';
        }

        if(!$this->vendedores_id){
            self::$errores[] = 'Debes elegir un vendedor';
        }

        if(!$this->imagen){
            self::$errores[] = 'La imagen es obligatoria';
        }

       return self::$errores;

    }

}
