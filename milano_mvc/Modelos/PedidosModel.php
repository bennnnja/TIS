<?php

require_once __DIR__ . '/../Config/Query.php';
class PedidosModel
{
    private $query;
    public function __construct(Query $query)
    {
        $this->query = $query;
    }
    public function getPedidos($estado)
    {
        $sql = "SELECT * FROM pedido WHERE estado = '$estado'";
        return  $this->query->selectAll($sql);
    }

    public function actualizarEstado($estado,$idPedido)
    {
        $sql = "UPDATE pedido SET estado=? WHERE cod_pedido = ?";
        $array = array($estado,$idPedido);
        return  $this->query->insertar($sql, $array);
    }
}

?>