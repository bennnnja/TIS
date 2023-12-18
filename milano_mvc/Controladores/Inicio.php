<?php
class Inicio extends Controlador
{
    public function __construct() {
        parent::__construct();
        session_start();
    }
    public function index()
    {

    }
    public function productos()
    {
        $data['title'] = 'Productos';
        $data['losProductos'] = $this->model->getProducto();
        $this->views->getView('inicial', "productos", $data);
    }

}