<?php
class InicioModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    public function getCategorias()
    {
        $sql = "SELECT * FROM productos";
        return $this->selectAll($sql);
    }
    public function getProducto()
    {
        $sql = "SELECT * FROM producto";
        return $this->selectAll($sql);
    }
}
 
?>