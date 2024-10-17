<?php

require_once 'libs/response.php';
require_once 'Middlewares/session.auth.php';
require_once 'Controller/auto.controller.php';
require_once  'Controller/usuarios.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


$res= new Response();

$action = 'marcas'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}


$params = explode('/', $action);


switch ($params[0]) {
    case 'marcas':
        $autoController = new Auto_Controller($res,false);
        $autoController->listarMarcas();
        break;

    case 'detalle':
        if (isset($params[1]) && is_numeric($params[1])) {
            $autoController= new Auto_Controller($res,false);
            $autoController->mostrar_detalle_modelo($params[1]);
        } else {
            echo "Error: No se proporcionó un ID de modelo.";
        }
        break;

        case 'autos':
            if (isset($params[1]) && is_numeric($params[1])) {
                $autoController = new Auto_Controller($res,false);
                $autoController->listarModelos($params[1]);
            } elseif (isset($params[1]) && $params[1] === 'detalle' && isset($params[2]) && is_numeric($params[2])) {
                $autoController = new Auto_Controller($res,false);
                $autoController->mostrar_detalle_modelo($params[2]);
            } elseif (isset($params[1]) && $params[1] === 'agregar') {
                
                sessionAuthMiddleware($res);
                $autoController = new Auto_Controller($res,true);
                $autoController->agregarAuto();
            } elseif (isset($params[1]) && $params[1] === 'editar') {
                sessionAuthMiddleware($res);
                $autoController = new Auto_Controller($res,true);
                $autoController->editarAuto();
            } elseif (isset($params[1]) && $params[1] === 'eliminar' && isset($params[2]) && is_numeric($params[2])) {
                sessionAuthMiddleware($res);

                $autoController = new Auto_Controller($res,true);
                $autoController->eliminarAuto($params[2]);
            } else {
                $autoController = new Auto_Controller($res,false);
                $autoController->listarTodosLosAutos(); // Aquí se listan todos los autos si no hay otra acción
            }
            break;
        
            case 'login':
                $controller = new Usuarios_controller();
                $controller->login();
                break;
            case 'logout':
                $controller = new Usuarios_controller();
                $controller->logout();
        
    default:
    $autoController =new Auto_Controller($res);
        $autoController->listarMarcas();
        break;
}

