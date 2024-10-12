    <?php

    require_once('Controller/auto.controller.php');
    require_once('Controller/usuarios.controller.php');


    // base_url para redirecciones y base tag
    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

    // Crea las instancias de los controladores
    $autoController = new Auto_Controller(); 

    $action = !empty($_GET['action']) ? $_GET['action'] : '';
    $params = explode('/', $action);

    switch ($params[0] ?? '') {
        case 'listar':
            $autoController->listarModelos();
            break;

        case 'detalle':
            // Verifica que haya un ID proporcionado
            if (isset($params[1] )) {
                // Llama al método del controlador con el ID
                $autoController->mostrar_detalle_modelo($params[1]);
            } else {
                echo "Error: No se proporcionó un ID demodelo.";
            }
            break;
        
        case 'ShowLogin':
            $usuariocontroller= new Usuarios_controller();
            $usuariocontroller-> showLogin();

            break;

        case 'login':
            $usuariocontroller=new Usuarios_controller();
            $usuariocontroller-> Login();
        break;

        default:
            $autoController->listarModelos();
            break;
    }
