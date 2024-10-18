<?php
require_once 'model.php';
require_once 'config.php';

class User_model
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=auto;charset=utf8', 'root', '');
        $this->_deploy(); 
    }

    public function _deploy() {
        
        $query = $this->db->query("SHOW TABLES LIKE 'usuario'");
        $usuarioExists = $query->fetchAll();

        if (count($usuarioExists) == 0) {
            $this->crearTablaUsuario();
        }
    }

    private function crearTablaUsuario() {
        $sql = "CREATE TABLE IF NOT EXISTS usuario (
                    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    password VARCHAR(255) NOT NULL
                )";
        $this->db->exec($sql);

        $this->insertarDatosInicialesUsuario();
    }

    private function insertarDatosInicialesUsuario() {
        
        $nombreUsuario = 'webadmin';
        $passwordHash = password_hash('admin', PASSWORD_DEFAULT); 

        $sql = "INSERT INTO usuario (name, password) VALUES (?, ?)";
        $query = $this->db->prepare($sql);
        $query->execute([$nombreUsuario, $passwordHash]);
    }

    public function getUserByName($name)
    {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE name = ?');
        $query->execute([$name]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        
        return $user;
    }
}
