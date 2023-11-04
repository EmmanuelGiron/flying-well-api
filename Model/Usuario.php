<?php
require_once './Model/Model.php';

class Usuario extends Model
{
    /*Propiedades*/
    public $id_usuario;  
    public $Nombres; 
    public $Apellidos; 
    public $dui_passport; 
    public $contrasenia;
    public $correo_usuario; 

    /*Métodos*/
    public function getUsuario($correo = "")
    {
        if ($correo != 0) 
        {   
            $this->correo_usuario = $correo;
            $query="SELECT ID_Usuario, Nombres, Apellidos, dui_passport, correo FROM usuarios
            WHERE correo = :correo";
            $params = array("correo" => $this->correo_usuario);
            $rows = $this->getQuery($query, $params);
        }
        if (count($rows) != 0) 
        {
            return json_encode($rows);
        }
        else
        {
            return null;
        }
    }

    public function addUsuario()
    {
        $query = "INSERT INTO usuarios
        VALUES (:ID_Usuario, :Nombres, :Apellidos, :dui_passport, :Contrasenia, :correo, :Tipo_usuario, :Token_Verificacion)";
        $params= array(
            "ID_Usuario" => null,
            "Nombres" => $this->Nombres,
            "Apellidos" => $this->Apellidos,
            "dui_passport" => $this->dui_passport,
            "Contrasenia" => $this->contrasenia,
            "correo" => $this->correo_usuario,
            "Tipo_usuario" => "cliente",
            "Token_Verificacion" => 1234
        );
        return $this->setQuery($query, $params);
    }
}