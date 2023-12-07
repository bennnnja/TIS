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
        $this->views->getView('inicial', "productos", $data);
    }
}