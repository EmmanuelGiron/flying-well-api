<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
//require_once "";
include_once 'Controller/OfertaController.php';

$url=$_SERVER['REQUEST_URI'];
//define('BASEPATH',true);
session_start();//Iniciando sesion
$url=explode("/",$url);
$controller=empty($url[2])?"Oferta":$url[2];
$controller.="Controller";
$fileController="Controller/$controller.php";
$method=empty($url[3])?"index":$url[3];
$param=empty($url[4])?"":$url[4];
$controlador=new $controller();
$controlador->$method($param);
?>