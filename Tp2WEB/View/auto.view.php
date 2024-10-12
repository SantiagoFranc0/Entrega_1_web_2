<?php class Auto_view
{

    public function listar_modelos($modelos)
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
}
