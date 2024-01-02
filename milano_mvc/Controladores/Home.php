<?php

class Home extends Controlador {
    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() {
        $data['title'] = 'Pagina Principal';

        $query = new Query();
        $homeModel = new HomeModel($query);

        $data['topProductos'] = $homeModel->getTopProductos();
        $this->views->getView('Home', 'index', $data);
    }
}

?>
