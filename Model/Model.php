<?php
abstract class Model
{
    /*Propiedades*/
    private $hostname="localhost";
    private $user="root";
    private $pass="";
    private $db="flyingwell2";
    protected $dbh;

    /*Métodos*/

    //Método para abrir conexión con la BD
    protected function openConnection()
    {
        try 
        {
            $dsn = "mysql:host=$this->hostname;dbname=$this->db;CHARSET=utf8";
            $this->dbh = new PDO($dsn, $this->user, $this->pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$dbh->exec("SET CHARACTER SET UTF8");
        } 
        catch (PDOException $ex) 
        {
            die("No se pudo establecer la conexión: ".$ex->getMessage());
        }
    }

    //Método para cerrar conexión con la BD
    protected function closeConnection()
    {
        $this->dbh=null;
    }

    //Método para ejecutar consultas de actualización e inserción
    protected function setQuery($query,$params=array())
    {
        try
        {
            $this->openConnection();
            $st=$this->dbh->prepare($query);
            $st->execute($params);
            $affectedRows=$st->rowCount();
            $this->closeConnection();
            return $affectedRows;
        }
        catch(Exception $ex)
        {
            $this->closeConnection();
            return -1;
        }

    }

    //Método para ejecutar consultas de selección
    protected function getQuery($query,$params=array())
    {
        try
        {
            $this->openConnection();
            $st=$this->dbh->prepare($query);
            $st->execute($params);
            $rows=$st->fetchAll(PDO::FETCH_OBJ);
            $this->closeConnection();
            return $rows;
        }
        catch(Exception $ex)
        {
            $this->closeConnection();
            echo "No se pudo ejecutar la consulta SQL: ".$ex->getMessage();
            return null;
        }
    }

    //Método para ejecutar consultas de selección total o única de una tabla en específico
    protected function getAll($tablename, $pk_table = 0)
    {
        $query="SELECT * FROM ".strval($tablename);
        $rows=$this->getQuery($query);
        if ($pk_table != 0) 
        {
            foreach ($rows as $row) 
            {
                if ($row->id == $pk_table) 
                {
                    $query = "SELECT * FROM ".strval($tablename)." WHERE id=".$row->id;
                    $rowid = $this->getQuery($query);
                }
            }
            if (count($rowid) != 0) 
            {  
                return $rowid;
            }
            else
            {
                //No existe registro en la BD con ese id
                return null;
            }
        }
        else
        {
            if (count($rows) != 0) 
            {
                return $rows;
            }
            else
            {
                //No hay registros en la BD o la consulta retornó null
                return null;
            }
        } 
    }
}
?>