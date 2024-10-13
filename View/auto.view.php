<?php 
class Auto_view
{
    public function listar_modelos($modelos,$marca)
    {
        include 'templates/header.phtml';
        include 'templates/listar_modelos.phtml';
        include 'templates/footer.phtml';
    }

    public function mostrar_detalle_modelo($detalle, $nombre_marca)
    {
        include 'templates/header.phtml';
        include 'templates/detalle_modelo.phtml';
        include 'templates/footer.phtml';
    }



    public function listarMarcas($marca)
    {
        include 'templates/header.phtml';
        include 'templates/Listar_marcas.phtml'; 
        include 'templates/footer.phtml';
    }

    public function error_id()
    {
        include 'templates/header.phtml';
        include 'templates/error_id.phtml';
        include 'templates/footer.phtml';
    }
}
