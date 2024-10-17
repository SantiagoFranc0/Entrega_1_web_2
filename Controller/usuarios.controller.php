<?php 

require_once('Model/user.model.php');
require_once('View/user.view.php');

class Usuarios_controller {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new User_model();
        $this->view = new User_view();
    }

    public function showLogin() {
        return $this->view->showLogin();
    }


    public function login() {
        session_start();
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            return $this->view->showLogin("Falta completar el nombre de usuario");
        }
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin("Falta completar la contraseña");
        }
    
        $name = $_POST['name'];
        $password = $_POST['password'];
    
        // Imprime los datos para ver si llegan correctamente
        error_log("Intento de inicio de sesión con nombre: $name");
    
        $userFromDB = $this->model->getUserByName($name);
    
        if ($userFromDB && password_verify($password, $userFromDB->password)) {
            $_SESSION['ID_USER'] = $userFromDB->id_usuario;
            $_SESSION['NAME_USER'] = $userFromDB->name;
            return $this->view->showLogin("Contraseña correcta");
            exit();
        } else {
            return $this->view->showLogin("Nombre de usuario o contraseña incorrectos");
        }
    }
    
    public function logout()

            {
                session_start();
                session_destroy();

                header('Location: '.BASE_URL.'login');
                exit();
            }

}
