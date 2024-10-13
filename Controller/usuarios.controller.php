<?php 

require_once ('Model/user.model.php');
require_once('View/user.view.php');

class Usuarios_controller{
    private $model; 
    private $view;


    public function __construct(){
        $this->model=new Usuer_model();
        $this->view=new  User_view();

    }

    public function showLogin(){

        return $this-> view->showLogin();

    }

    public function login(){

        if (!isset($_POST['name'])|| empty($_POST['name'])){
            return $this->view->showLogin("falta completar en nombre de usuario");

        }
        if (!isset($_POST['password'])|| empty($_POST['password'])){
            return $this->view->showLogin("falta completarla contraseña");

        }

        $name=$_POST['name'];
        $password=$_POST['password'];


        $userFromDB = $this->model->getUserByName($name);

        if($userFromDB && password_verify($password, $userFromDB->password)){
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['NAME_USER'] = $userFromDB->name;
            header('Location: ' . BASE_URL);
        }

    }
}