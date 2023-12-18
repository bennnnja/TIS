<?php
class PrincipalModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    public function getCategorias()
    {
        $sql = "SELECT * FROM producto";
        return $this->selectAll($sql);
    }
    public function getProductos()
    {
        $sql = "SELECT * FROM producto";
        return $this->selectAll($sql);
    }
    public function getPaletas()
    {
        $sql = "SELECT * FROM producto WHERE categoria = 'Paleta' ";
        return $this->selectAll($sql);
    }

    public function getBotes()
    {
        $sql = "SELECT * FROM producto WHERE categoria = 'Bote' ";
        return $this->selectAll($sql);
    }
}
 
?>