<?php
require_once './Model/Model.php';

class Boleto extends Model
{
    /*Propiedades*/
    public $id_oferta;  
    public $id_usuario; 
    public $id_boleto; 

    /*Métodos*/
    public function getBoletos($ID_Usuario="")
    {
            $this->id_usuario = $ID_Usuario;
            $query="SELECT B.ID_Boleto, U.Nombres, U.Apellidos,
            O.Origen_v, O.Destino_v, O.Fecha_inicio, O.Fecha_fin FROM boleto B INNER JOIN usuarios U ON U.ID_Usuario = B.ID_Usuario INNER JOIN oferta_vuelos O ON O.ID_oferta =B.ID_oferta
            WHERE B.ID_Usuario = :ID_Usuario";
            $params = array("ID_Usuario" => $this->id_usuario);
            $rows = $this->getQuery($query, $params);
        if (count($rows) != 0) 
        {
            return json_encode($rows);
        }
        else
        {
            return null;
        }
    }

    public function addBoleto($idusuario, $idoferta)
    {
        $this->id_usuario = $idusuario;
        $this->id_oferta = $idoferta;
        $query = "INSERT INTO boleto
        VALUES (:ID_oferta, :ID_Usuario,:ID_Boleto )";
        $params= array(
            "ID_oferta" => $this->id_oferta,
            "ID_Usuario" => $this->id_usuario,
            "ID_Boleto" => null
            
        );
        return $this->setQuery($query, $params);
    }
}