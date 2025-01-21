<?php

namespace Controllers;
use MVC\Router;
use Model\PropiedadCaracteristica;


class PropiedadCaracteristicasController{
    public static function actualizar($id){
        $query = "SELECT * FROM propiedad_caracteristica WHERE propiedad_id = {$id}";
        $caracteristicas =  PropiedadCaracteristica::consultarSQL($query);
        
    }
}