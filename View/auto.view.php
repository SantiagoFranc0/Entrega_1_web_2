<?php
class Auto_view
{
    private $user;



   public function __construct($user) {
       $this->user = $user; // Se asigna el usuario pasado desde el controlador
   }


    public function listar_modelos($modelos,$marca)
    {
        include 'templates/header.phtml';
        include 'templates/listar_modelos.phtml';
        include 'templates/footer.phtml';
    }

    public function mostrar_detalle_modelo($detalle, $nombre_marca)
    {
        include 'Templates/header.phtml';
        include 'Templates/detalle_modelo.phtml';
        include 'Templates/footer.phtml';
    }

public function listar_todos_los_autos($autos){
    include 'Templates/header.phtml';
    include 'Templates/mostrar.todos.phtml';
    include 'Templates/footer.phtml';
}

    public function listarMarcas($marca)
    {
        include 'Templates/header.phtml';
        include 'Templates/Listar_marcas.phtml'; 
        include 'Templates/footer.phtml';
    }


    public function mostrarFormularioAgregarAuto($marcas)
{
    include 'Templates/header.phtml';
    include 'Templates/agregar.auto.phtml';
    include 'Templates/footer.phtml';
}
public function mostrarFormularioEditarAuto($autos)
{
    include 'Templates/header.phtml';
    include 'Templates/editar.auto.phtml';
    include 'Templates/footer.phtml';
}

// Método para confirmar la eliminación de un auto
public function confirmarEliminarAuto($auto)
{
    include 'Templates/header.phtml';
    include 'Templates/mostrar.todos.phtml';
    include 'Templates/footer.phtml';
}

    public function error_id()
    {
        include 'Templates/header.phtml';
        include 'Templates/error_id.phtml';
        include 'Templates/footer.phtml';
    }
}
