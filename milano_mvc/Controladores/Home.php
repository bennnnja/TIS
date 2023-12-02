<?php

class Home extends Controlador{ 


    public function index() 
    {  
        $this->views->getView($this, "index");
    }
}

