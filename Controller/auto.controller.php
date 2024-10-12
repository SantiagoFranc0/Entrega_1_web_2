<?php
require_once('Model/auto.model.php'); // Incluye el modelo que maneja los datos de los autos
require_once('View/auto.view.php');   // Incluye la vista que mostrará la información de los autos

class Auto_Controller
{
    private $model; 
    private $view;

    function __construct()
    {
        $this->model = new Auto_model(); // Inicializa el modelo
        $this->view = new Auto_view();   // Inicializa la vista
    }

    // Método para listar todos los modelos de autos
    public function listarModelos()
    {
        $modelos = $this->model->getAutos(); 
        $this->view->listar_modelos($modelos); 
    }

    // Método para mostrar el detalle de un modelo de auto
    public function mostrar_detalle_modelo($id) {
        $detalle = $this->model->getAuto($id); 
        $marca = $this->model->getMarcaById($detalle->id_marca); 

        $this->view->mostrar_detalle_modelo($detalle, $marca->nombre); 
    }
}
