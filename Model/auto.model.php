<?php

class Auto_model
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=auto;charset=utf8', 'root', '');
    }

    public function getTodosLosAutos()
    {
        $query = $this->db->prepare('SELECT * FROM modelo');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAuto($id)
    {
        $query = $this->db->prepare('SELECT * FROM modelo WHERE id_modelo = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }


public function getMarcaById($id_marca)
{
    $query = $this->db->prepare('SELECT * FROM marca WHERE id_marca = ?');
    $query->execute([$id_marca]);
    return $query->fetch(PDO::FETCH_OBJ);
}


    public function getMarcas()
    {
        $query = $this->db->prepare('SELECT id_marca, nombre FROM marca');
        $query->execute();
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);
        return $marcas;
    }
    


public function getAutosPorMarca($id_marca) {
    $query = $this->db->prepare("SELECT * FROM modelo WHERE id_marca = $id_marca");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ); 
}

    
    
}

