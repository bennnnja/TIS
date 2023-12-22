<?php
class ClientesModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }

    public function registroDirecto($nombre, $nom_usuario, $rut, $telefono, $fdn, $email, $contrasena)
    {
        $sql = "INSERT INTO cliente (nombre, nom_usuario, rut, telefono, fecha_nacimiento, email, contrasena) VALUES (?,?,?,?,?,?,?)";
        $datos = array($nombre, $nom_usuario, $rut, $telefono, $fdn, $email, $contrasena);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }

    public function getVerificar($email)
    {
        $sql = "SELECT * FROM cliente WHERE email = '$email'";
        return $this->select($sql);
    }

    public function registrarPedido($cod_pedido, $monto, $estado, $fecha_pedido, $cliente_rut)
    {
        $sql = "INSERT INTO pedido (cod_pedido, monto, estado, fecha_pedido, cliente_rut) VALUES (?,?,?,?,?)";
        $datos = array($cod_pedido, $monto, $estado, $fecha_pedido, $cliente_rut);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }
    public function getProducto($id_producto)
    {
        $sql = "SELECT * FROM productos WHERE id = $id_producto";
        return $this->select($sql);
    }
    public function registrarDetalle($producto, $precio, $cantidad, $id_pedido, $id_producto)
    {
        $sql = "INSERT INTO detalle_pedidos (producto, precio, cantidad, id_pedido, id_producto) VALUES (?,?,?,?,?)";
        $datos = array($producto, $precio, $cantidad, $id_pedido, $id_producto);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }
    public function getPedidos($id_cliente)
    {
        $sql = "SELECT * FROM pedidos WHERE id_cliente = $id_cliente";
        return $this->selectAll($sql);
    }
    public function getPedido($idPedido)
    {
        $sql = "SELECT * FROM pedidos WHERE id = $idPedido";
        return $this->select($sql);
    }
    public function verPedidos($idPedido)
    {
        $sql = "SELECT d.* FROM pedidos p INNER JOIN detalle_pedidos d ON p.id = d.id_pedido WHERE p.id = $idPedido";
        return $this->selectAll($sql);
    }
}
 
?>