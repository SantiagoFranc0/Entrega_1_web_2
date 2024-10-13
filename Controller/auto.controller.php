<?php
require_once('Model/auto.model.php'); // Incluye el modelo que maneja los datos de los autos
require_once('View/auto.view.php');   // Incluye la vista que mostrará la información de los autos

class Auto_Controller
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new Auto_model(); 
        $this->view = new Auto_view();  
    }

    // metodo para listar todos los modelos de autos de una marca
    public function listarModelos($id_marca)
    {
        $modelos = $this->model->getAutosPorMarca($id_marca); 
        $marca = $this->model->getMarcaById($id_marca); 
    
        $this->view->listar_modelos($modelos, $marca); 
    }
    
    // mostrar detalles de un modelo específico
    public function mostrar_detalle_modelo($id) {
        $detalle = $this->model->getAuto($id);
    
        if ($detalle) {
            $marca = $this->model->getMarcaById($detalle->id_marca);
            $this->view->mostrar_detalle_modelo($detalle, $marca->nombre);
        } else {
            $this->view->error_id();
        }
    }
    
   
    // listar marcas
    public function listarMarcas()
    {
        $marca = $this->model->getMarcas();
        $this->view->listarMarcas($marca);  
    }
}
