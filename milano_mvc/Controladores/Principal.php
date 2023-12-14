<?php
class Principal extends Controlador
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
        $data['losProductos'] = $this->model->getProductos();
        $this->views->getView('principal', "productos", $data);
        print_r($this->model->getProductos()); 
    }
    
    public function categoriaPal()
    {
        $data['title'] = 'Paletas';
        $data['paletas'] = $this->model->getPaletas();
        $this->views->getView('principal', "categoriaPal", $data);
    }
    public function categoriaBot()
    {
        $data['title'] = 'Botes';
        $data['botes'] = $this->model->getBotes();
        $this->views->getView('principal', "categoriaBot", $data);
    }
    

}