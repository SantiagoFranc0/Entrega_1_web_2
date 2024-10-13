<?php

require_once 'Controller/auto.controller.php';
require_once 'Controller/usuarios.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$autoController = new Auto_Controller();
$usuariocontroller = new Usuarios_controller();

$action = !empty($_GET['action']) ? $_GET['action'] : '';
$params = explode('/', $action);

switch ($params[0] ?? '') {
    case 'marcas':
        $autoController->listarMarcas();
        break;

    case 'autos':
        if (isset($params[1])) {
            $autoController->listarModelos($params[1]); 
          
        }
        break;

    case 'detalle':
        if (isset($params[1])) {
            $autoController->mostrar_detalle_modelo($params[1]);
        } else {
            echo "Error: No se proporcionó un ID de modelo.";
        }
        break;


    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuariocontroller->Login();
        } else {
            $usuariocontroller->showLogin();
        }
        break;

    default:
        $autoController->listarMarcas(); 
        break;
}
