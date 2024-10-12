<?php

class Usuer_model
{

    private $db;

    public function __construct()
    {

        $this->db = new PDO('mysql:host=localhost;dbname=auto;charset=utf8', 'root', '');
    }

    public function getUserByName($name)
    {

        $query = $this->db->prepare('SELECT * FROM usuario WHERE name =?');
        $query->execute([$name]);

        $usuario = $query->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }
}
