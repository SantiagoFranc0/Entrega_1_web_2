<?php
require_once('Model/auto.model.php'); 
require_once('View/auto.view.php');   

class Auto_Controller {
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new Auto_model();
        $this->view = new Auto_view($res->user); 
    }

    public function listarModelos($id_marca) {
        $modelos = $this->model->getAutosPorMarca($id_marca);
        $marca = $this->model->getMarcaById($id_marca);
        $this->view->listar_modelos($modelos, $marca);
    }

    public function mostrar_detalle_modelo($id) {
        $detalle = $this->model->getAuto($id);

        if ($detalle) {
            $marca = $this->model->getMarcaById($detalle->id_marca);
            $this->view->mostrar_detalle_modelo($detalle, $marca->nombre);
        } else {
            $this->view->error_id();
        }
    }

    public function listarMarcas() {
        $marca = $this->model->getMarcas();
        $this->view->listarMarcas($marca);
    }

    public function listarTodosLosAutos() {
        $autos = $this->model->getTodosLosAutos(); 
        $this->view->listar_todos_los_autos($autos); 
    }

    public function agregarAuto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_modelo = $_POST['nombre_modelo'];
            $anio = $_POST['anio'];
            $color = $_POST['color'];
            $id_marca = $_POST['id_marca'];

            $id = $this->model->agregarAuto($nombre_modelo, $anio, $color, $id_marca);

            header("Location: " . BASE_URL . "autos");
            exit();
        } else {
            $marcas = $this->model->getMarcas();
            $this->view->mostrarFormularioAgregarAuto($marcas);
        }
    }

    public function eliminarAuto($id_modelo) {
        $this->model->eliminarAuto($id_modelo);
        header('Location: ' . BASE_URL . 'autos'); 
    }

    public function editarAuto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $id_modelo = $_POST['id_modelo'];
            $nombre_modelo = $_POST['nombre_modelo'];
            $anio = $_POST['anio'];
            $color = $_POST['color'];
            $id_marca = $_POST['id_marca'];
    
          
            $this->model->editarAuto($id_modelo, $nombre_modelo, $anio, $color, $id_marca);
            
           
            header('Location: ' . BASE_URL . 'autos');
            exit;
        } else {
        
            $autos = $this->model->getTodosLosAutos();

            $this->view->mostrarFormularioEditarAuto($autos);
        }
    }

}    
