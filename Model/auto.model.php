<?php

class Auto_model
{
    private $db;

    public function __construct() {
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
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAutosPorMarca($id_marca)
    {
        $query = $this->db->prepare("SELECT * FROM modelo WHERE id_marca = ?");
        $query->execute([$id_marca]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function agregarAuto($nombre_modelo, $anio, $color, $id_marca)
    {
        if (empty($nombre_modelo) || empty($anio) || empty($color) || empty($id_marca)) {
            throw new InvalidArgumentException("Todos los campos son obligatorios.");
        }

        $query = $this->db->prepare('INSERT INTO modelo (nombre_modelo, anio, color, id_marca) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre_modelo, $anio, $color, $id_marca]);

        return $this->db->lastInsertId(); // Retornar el ID del nuevo registro
    }

    public function editarAuto($id_modelo, $nombre_modelo, $anio, $color) {
        // Prepara la consulta para actualizar el auto
        $query = $this->db->prepare('UPDATE modelo SET nombre_modelo = ?, anio = ?, color = ? WHERE id_modelo = ?');
        
        // Ejecuta la consulta con los datos proporcionados
        $query->execute([$nombre_modelo, $anio, $color, $id_modelo]);
    }

    public function eliminarAuto($id)
    {
        $query = $this->db->prepare('DELETE FROM modelo WHERE id_modelo = ?');
        $query->execute([$id]);
    }
}
