<?php

require_once __DIR__ . '/../Config/Query.php';

class AdminModel {
    private $query;
    public function __construct(Query $query)
    {
         $this->query = $query;
    }
    public function getUsuario($email)
    {
        $sql = "SELECT * FROM empleado WHERE email = '$email'";
        return $this->query->select($sql);
    }
    public function getPendientes()
    {
        $sql = "SELECT COUNT(*) AS total FROM pedido WHERE estado = 'Pendiente'";
        return $this->query->selectAll($sql);

        
    }
    public function getAceptados()
    {
        $sql = "SELECT COUNT(*) AS total FROM pedido WHERE estado = 'Aceptado'";
        return $this->query->selectAll($sql);

        
    }
    public function getCompletados()
    {
        $sql = "SELECT COUNT(*) AS total FROM pedido WHERE estado = 'Completado'";
        return $this->query->selectAll($sql);
    }
    public function getTotales()
    {
        $sql = "SELECT SUM(monto) AS total_montos FROM pedido WHERE estado = 'Aceptado'";
        return $this->query->selectAll($sql);
    }
    // En AdminModel.php
public function getVentasPorUltimos7Dias()
{
    $sql = "SELECT fecha_pedido AS dia, SUM(monto) AS total_ventas FROM pedido WHERE fecha_pedido >= CURRENT_DATE - INTERVAL '7 days' GROUP BY dia ORDER BY dia";

    return $this->query->select($sql);
}
public function getProductosMasVendidos() {
    $sql = "SELECT SUM(cantidad) AS productos_vendidos, producto AS producto_nombre FROM detalle_pedido GROUP BY producto, cantidad ORDER BY productos_vendidos DESC LIMIT 5";
    return $this->query->selectAll($sql);
}
public function getProductosMenorStock()
{
    $sql = "SELECT nombre_producto,  stock FROM producto ORDER BY stock ASC LIMIT 5";
    return $this->query->selectAll($sql);
}
public function getProductosMenosVendidos() {
    $sql = "SELECT SUM(cantidad) AS productos_vendidos, producto AS producto_nombre FROM detalle_pedido GROUP BY producto, cantidad ORDER BY productos_vendidos ASC LIMIT 5";
    return $this->query->selectAll($sql);
}
public function getIngredientesMenorStock()
{
    $sql = "SELECT nombre_ingrediente,  stock FROM ingrediente ORDER BY stock ASC LIMIT 5";
    return $this->query->selectAll($sql);
}
}

 
?>