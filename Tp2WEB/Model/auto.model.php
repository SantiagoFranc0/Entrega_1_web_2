<?php

class Auto_model
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=auto;charset=utf8', 'root', '');
    }

    // Método para obtener todos los autos
    public function getAutos()
    {
        $query = $this->db->prepare('SELECT * FROM modelo');
        $query->execute();
        // Cambiamos a FETCH_OBJ para devolver objetos en vez de arrays asociativos
        $modelo = $query->fetchAll(PDO::FETCH_OBJ);
        return $modelo;
    }

    // Método para obtener un auto específico
    public function getAuto($id) {
        $query = $this->db->prepare('SELECT * FROM modelo WHERE id_modelo = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ); // Asegúrate de que devuelva un objeto
    }

    // Nueva función para obtener el nombre de la marca por id_marca
    public function getMarcaById($id_marca) {
        $query = $this->db->prepare('SELECT nombre FROM marca WHERE id_marca = ?');
        $query->execute([$id_marca]);
        return $query->fetch(PDO::FETCH_OBJ); // Devolvemos un objeto
    }
    public function listarMarcas() {
        $query = "SELECT  nombre FROM marca"; 
        $query = $this->db->query($query);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    

}
