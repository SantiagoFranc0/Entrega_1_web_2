<?php

require_once 'model.php';
require_once 'config.php';

class Auto_model extends Model {
    public function __construct() {
        parent::__construct();
        $this->_deploy();
    }

    public function _deploy() {
        
        $query = $this->db->query("SHOW TABLES LIKE 'marca'");
        $marcaExists = $query->fetchAll();

        
        $query = $this->db->query("SHOW TABLES LIKE 'modelo'");
        $modeloExists = $query->fetchAll();

        if (count($marcaExists) == 0) {
            $this->crearTablaMarca();
        }

        if (count($modeloExists) == 0) {
            $this->crearTablaModelo();
        }
    }

    private function crearTablaMarca() {
        $sql = "CREATE TABLE IF NOT EXISTS marca (
                    id_marca INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL,
                    lugar_fabricacion VARCHAR(100) NOT NULL
                )";
        $this->db->exec($sql);

       
        $this->insertarDatosInicialesMarca();
    }

    private function crearTablaModelo() {
        $sql = "CREATE TABLE IF NOT EXISTS modelo (
                    id_modelo INT AUTO_INCREMENT PRIMARY KEY,
                    nombre_modelo VARCHAR(100) NOT NULL,
                    anio INT NOT NULL,
                    color VARCHAR(50) NOT NULL,
                    id_marca INT,
                    CONSTRAINT fk_marca FOREIGN KEY (id_marca) REFERENCES marca(id_marca)
                )";
        $this->db->exec($sql);

        
        $this->insertarDatosInicialesModelo();
    }

    private function insertarDatosInicialesMarca() {
        $sql = "INSERT INTO marca (nombre, lugar_fabricacion) VALUES
                ('Toyota', 'Japón'),
                ('Ford', 'Estados Unidos'),
                ('BMW', 'Alemania')";
        $this->db->exec($sql);
    }

    private function insertarDatosInicialesModelo() {
        $sql = "INSERT INTO modelo (nombre_modelo, anio, color, id_marca) VALUES
                ('Camry', 2021, 'Celeste', 1),
                ('Mustang', 2020, 'Gris', 2),
                ('X5', 2020, 'Amarillo', 3),
                ('Corolla', 2020, 'Rojo', 1),
                ('Hilux', 2015, 'Gris', 1)";
        $this->db->exec($sql);
    }

    public function getTodosLosAutos() {
        $query = $this->db->prepare('SELECT * FROM modelo');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAuto($id) {
        $query = $this->db->prepare('SELECT * FROM modelo WHERE id_modelo = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getMarcaById($id_marca) {
        $query = $this->db->prepare('SELECT * FROM marca WHERE id_marca = ?');
        $query->execute([$id_marca]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getMarcas() {
        $query = $this->db->prepare('SELECT id_marca, nombre FROM marca');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAutosPorMarca($id_marca) {
        $query = $this->db->prepare("SELECT * FROM modelo WHERE id_marca = ?");
        $query->execute([$id_marca]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function agregarAuto($nombre_modelo, $anio, $color, $id_marca) {
        if (empty($nombre_modelo) || empty($anio) || empty($color) || empty($id_marca)) {
            throw new InvalidArgumentException("Todos los campos son obligatorios.");
        }

        $query = $this->db->prepare('INSERT INTO modelo (nombre_modelo, anio, color, id_marca) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre_modelo, $anio, $color, $id_marca]);

        return $this->db->lastInsertId();
    }

    public function editarAuto($id_modelo, $nombre_modelo, $anio, $color) {

        $query = $this->db->prepare('UPDATE modelo SET nombre_modelo = ?, anio = ?, color = ? WHERE id_modelo = ?');
        
      
        $query->execute([$nombre_modelo, $anio, $color, $id_modelo]);
    }

    public function eliminarAuto($id) {
        $query = $this->db->prepare('DELETE FROM modelo WHERE id_modelo = ?');
        $query->execute([$id]);
    }
}
