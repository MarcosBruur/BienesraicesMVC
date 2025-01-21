<?php 
require_once  __DIR__ . '/../includes/app.php';
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;
use Controllers\LoginController;
use Controllers\CaracteristicasController;

$router = new Router();

//Rutas propiedades
$router->get('/admin',[PropiedadController::class,'index']);
$router->get('/propiedades/crear',[PropiedadController::class,'crear']);
$router->post('/propiedades/crear',[PropiedadController::class,'crear']);
$router->get('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->post('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->post('/propiedades/eliminar',[PropiedadController::class,'eliminar']);

//Rutas vendedores
$router->get('/vendedores/crear',[VendedorController::class,'crear']);
$router->post('/vendedores/crear',[VendedorController::class,'crear']);
$router->get('/vendedores/actualizar',[VendedorController::class,'actualizar']);
$router->post('/vendedores/actualizar',[VendedorController::class,'actualizar']);
$router->post('/vendedores/eliminar',[VendedorController::class,'eliminar']);

//Rutas caracteristicas
$router->get('/caracteristicas',[CaracteristicasController::class,'index']);
$router->get('/caracteristicas/crear',[CaracteristicasController::class,'crear']);
$router->post('/caracteristicas/crear',[CaracteristicasController::class,'crear']);
$router->get('/caracteristicas/actualizar',[CaracteristicasController::class,'actualizar']);
$router->post('/caracteristicas/actualizar',[CaracteristicasController::class,'actualizar']);
$router->post('/caracteristicas/eliminar',[CaracteristicasController::class,'eliminar']);


//Rutas publicas
$router->get('/',[PaginasController::class,'index']);
$router->get('/nosotros',[PaginasController::class,'nosotros']);
$router->get('/propiedades',[PaginasController::class,'propiedades']);
$router->get('/propiedad',[PaginasController::class,'propiedad']);
$router->get('/entrada',[PaginasController::class,'entrada']);
$router->get('/blog',[PaginasController::class,'blog']);
$router->get('/contacto',[PaginasController::class,'contacto']);
$router->post('/contacto',[PaginasController::class,'contacto']);


//Login y auth

$router->get('/login',[LoginController::class,'login']);
$router->post('/login',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);



$router->comprobarRutas();