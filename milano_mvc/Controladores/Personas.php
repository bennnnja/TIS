<?php
class Personas extends Controlador
{
    
    public function index()
    {
       print_r($this->model->getPersona() );
    }
}
?>