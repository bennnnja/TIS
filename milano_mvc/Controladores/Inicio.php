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
        $data['productoss'] = $this->model->getProducto();
        $this->views->getView('inicial', "productos", $data);
    }

    public function shop()
    { 
        $data['title'] = 'Productos';
        $this->views->getView('inicial', "shop", $data);
    }
    
    
}