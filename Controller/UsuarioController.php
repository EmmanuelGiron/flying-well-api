<?php
require_once "./Controller/Controller.php";
require_once "./Model/Usuario.php";

class UsuarioController extends Controller
{
    private $usuario;

    function __construct(){
        $this->usuario=new Usuario();
    }
    
    public function index($correo){
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            $usuario=$this->usuario->getUsuario($correo);
            header("HTTP/1.1 200");
            echo $usuario;
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $input = $_POST;
            $this->usuario->Nombres=$input['Nombres'];
            $this->usuario->Apellidos=$input['Apellidos'];
            $this->usuario->dui_passport=$input['dui_passport'];
            $this->usuario->contrasenia=$input['contrasenia'];
            $this->usuario->correo_usuario=$input['correo_usuario'];
            $this->usuario->addUsuario();
            header("HTTP/1.1 200");
            exit();
        }    
    }
}
?>