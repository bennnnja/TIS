<?php
require_once __DIR__ . '/../Config/Query.php';
class PrincipalModel {
    private $query;
    public function __construct(Query $query)
    {
        $this->query = $query;
    }
    
    public function getCategorias()
    {
        $sql = "SELECT * FROM producto WHERE stock >= 1 AND estado = 1;";
        return $this->query->selectAll($sql);
    }
    public function getProductos()
    {
        $sql = "SELECT * FROM producto WHERE stock >= 1 AND estado = 1;";
        return $this->query->selectAll($sql);
    }
    public function getPaletas()
    {
        $sql = "SELECT * FROM producto WHERE stock >= 1 AND estado = 1 and categoria = 'Paleta' "; 
        return $this->query->selectAll($sql);
    }

    public function getBotes()
    {
        $sql = "SELECT * FROM producto WHERE stock >= 1 AND estado = 1 and categoria = 'Bote' "; 
        return $this->query->selectAll($sql);
    }

    public function getListaProducto($cod_producto)
    {
        $sql = "SELECT cod_producto,nombre_producto,precio,imagen,stock FROM producto WHERE cod_producto = $cod_producto";
        return $this->query->select($sql);
    }


}
 
?>