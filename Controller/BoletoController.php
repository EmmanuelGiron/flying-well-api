<?php
require_once "./Controller/Controller.php";
require_once "./Model/Boleto.php";

class BoletoController extends Controller
{
    private $boleto;

    function __construct(){
        $this->boleto=new Boleto();
    }
    
    public function index($id){
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            $usuarios=$this->boleto->getBoletos($id);
            header("HTTP/1.1 200");
            echo $usuarios;
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $input = $_POST;
            $this->boleto->addBoleto($input['ID_Usuario'],$input['ID_oferta']); 
            header("HTTP/1.1 200");
            exit();
        }    
    }
}
?>