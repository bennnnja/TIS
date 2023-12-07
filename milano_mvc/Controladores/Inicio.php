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
        $data['categorias'] = $this->model->getCategorias();
        $this->views->getView('inicial', "productos", $data);
    }

    public function shop()
    { $data['title'] = 'Productos';
        $this->views->getView('inicial', "shop", $data);
    }
     public function detalle($id_producto)
    { $data['title'] = '-----------';
        $this->views->getView('inicial', "detalle", $data);}
}