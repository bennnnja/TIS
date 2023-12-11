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
    public function getProductos($cod_producto)
    {
        $sql = "SELECT * FROM productos WHERE cod_producto = $cod_producto";
        return $this->select($sql);
    }
}
 
?>