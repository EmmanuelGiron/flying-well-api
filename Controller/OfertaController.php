<?php
require_once "./Controller/Controller.php";
require_once "./Model/Oferta.php";

class OfertaController extends Controller
{
    private $oferta;

    function __construct(){
        $this->oferta=new Oferta();
    }
    
    public function index(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            $ofertas=$this->oferta->getOferta();
            header("HTTP/1.1 200");
            echo $ofertas;
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $input = $_POST;
            $this->oferta->origen_v=$input['origen_v'];
            $this->oferta->destino_v=$input['destino_v'];
            $this->oferta->fecha=$input['fecha'];
            $this->oferta->hora_salida=$input['hora_salida'];
            $this->oferta->asientos_disponibles=$input['asientos_disponibles'];
            $this->oferta->objetos_personales=$input['objetos_personales'];
            $this->oferta->fecha_inicio=$input['fecha_inicio'];
            $this->oferta->fecha_fin=$input['fecha_fin'];
            $this->oferta->precio=$input['precio'];
            $this->oferta->addOferta($input['aerolinea_id'], $input['tipo_vuelo_id'],$input['estado_vuelo_id']);
            header("HTTP/1.1 200");
            exit();
        }    
    }
}
?>