<?php

function conectarDB() : mysqli{
    $db =new mysqli('localhost:3307','root','123123','bienesraices_crud');
    
    if(!$db){
        echo "Error, no se pudo conectar a la db";
        exit;
    }

    return $db;
  
}