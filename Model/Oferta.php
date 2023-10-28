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
    public function getOferta($idasset = 0)
    {
        if ($idasset != 0) 
        {   
            $this->id_oferta = intval($idasset);
            $query="SELECT * FROM oferta_vuelos WHERE ID_oferta = :id";
            $params = array("id" => $this->id_oferta);
            $rows = $this->getQuery($query, $params);
        }
        else 
        {
            $query="SELECT * FROM oferta_vuelos";
            $rows = $this->getQuery($query);
            
        }
        if (count($rows) != 0) 
        {
            return json_encode($rows);
        }
        else
        {
            //No hay activos en la base de datos o la consulta retornó null
            return null;
        }
    }

    public function addOferta($idareolinea, $idtipovuelo, $idestadovuelo)
    {
        $this->aereolinea_id = $idareolinea;
        $this->tipo_vuelo_id = $idtipovuelo;
        $this->estado_vuelo_id = $idestadovuelo;
        $query = "INSERT INTO oferta_vuelos
        VALUES (:id, :origen_v, :destino_v, :fecha, :hora_salida, :asientos_disponibles, :objetos_personales, :fecha_inicio, :fecha_fin, :precio, :aereolinea_id, :tipo_vuelo_id, :estado_vuelo_id)";
        $params= array(
            "id" => null,
            "origen_v" => $this->origen_v,
            "destino_v" => $this->destino_v,
            "fecha" => $this->fecha,
            "hora_salida" => $this->hora_salida,
            "asientos_disponibles" => $this->asientos_disponibles,
            "objetos" => $this->objetos_personales,
            "fecha_inicio" => $this->fecha_inicio,
            "fecha_fin" => $this->fecha_fin,
            "precio" => $this->precio,
            "aereolinea_id" => $this->aereolinea_id,
            "tipo_vuelo_id" => $this->tipo_vuelo_id,
            "estado_vuelo_id" => $this->estado_vuelo_id
        );
        return $this->setQuery($query, $params);
    }
}