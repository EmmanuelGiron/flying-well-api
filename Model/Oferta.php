<?php
require_once './Model/Model.php';

class Oferta extends Model
{
    /*Propiedades*/
    public $id_oferta; //int 
    public $aereolinea_id; //int
    public $tipo_vuelo_id; //date
    public $origen_v; //varchar(100)
    public $destino_v; //varchar(100)
    public $fecha; //date
    public $hora_salida; //date
    public $asientos_disponibles; //int 
    public $objetos_personales; //varchar 
    public $fecha_inicio; //date
    public $fecha_fin; //date
    public $precio; //decimal 
    public $estado_vuelo_id; //int

    /*Métodos*/
    public function getOferta($id = 0)
    {
        if ($id != 0) 
        {   
            $this->id_oferta = intval($id);
            $query="SELECT O.ID_oferta,O.Origen_v,O.Destino_v,O.Fecha,O.Hora_salida, O.Asientos_disponibles,O.objetos_personales,O.Fecha_inicio,O.Fecha_fin,O.Precio,A.Nombre_aerolinea,T.Tipo,E.Estado FROM oferta_vuelos O INNER JOIN aerolinea A ON A.ID_aerolinea = O.ID_aerolinea 
            INNER JOIN tipo_de_vuelo T ON T.ID_Tipo_de_vuelo = O.ID_Tipo_de_vuelo INNER JOIN estado_vuelo E ON E.ID_estado_vuelo = O.ID_estado_vuelo
            WHERE O.ID_oferta = :id";
            $params = array("id" => $this->id_oferta);
            $rows = $this->getQuery($query, $params);
        }
        else 
        {
            $query="SELECT O.ID_oferta,O.Origen_v,O.Destino_v,O.Fecha,O.Hora_salida, 
            O.Asientos_disponibles,O.objetos_personales,O.Fecha_inicio,O.Fecha_fin,O.Precio,
            A.Nombre_aerolinea,T.Tipo,E.Estado FROM oferta_vuelos O 
            INNER JOIN aerolinea A ON A.ID_aerolinea = O.ID_aerolinea 
            INNER JOIN tipo_de_vuelo T ON T.ID_Tipo_de_vuelo = O.ID_Tipo_de_vuelo 
            INNER JOIN estado_vuelo E ON E.ID_estado_vuelo = O.ID_estado_vuelo";
            $rows = $this->getQuery($query);
            
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

    public function addOferta($idareolinea, $idtipovuelo, $idestadovuelo)
    {
        $this->aereolinea_id = $idareolinea;
        $this->tipo_vuelo_id = $idtipovuelo;
        $this->estado_vuelo_id = $idestadovuelo;
        $query = "INSERT INTO oferta_vuelos
        VALUES (:ID_oferta, :ID_aerolinea, :ID_Tipo_vuelo, :Origen_v, :Destino_v, :Fecha, :Hora_salida, :Asientos_disponibles, :Objetos_personales, :Fecha_inicio, :Fecha_fin, :Precio,:ID_estado_vuelo)";
        $params= array(
            "ID_oferta" => null,
            "ID_aerolinea" => $this->aereolinea_id,
            "ID_Tipo_vuelo" => $this->tipo_vuelo_id,
            "Origen_v" => $this->origen_v,
            "Destino_v" => $this->destino_v,
            "Fecha" => $this->fecha,
            "Hora_salida" => $this->hora_salida,
            "Asientos_disponibles" => $this->asientos_disponibles,
            "Objetos_personales" => $this->objetos_personales,
            "Fecha_inicio" => $this->fecha_inicio,
            "Fecha_fin" => $this->fecha_fin,
            "Precio" => $this->precio,
            "ID_estado_vuelo" => $this->estado_vuelo_id
        );
        return $this->setQuery($query, $params);
    }
}