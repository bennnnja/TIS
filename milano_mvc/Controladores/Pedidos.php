<?php
class Pedidos extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        if(empty($_SESSION["email"])) {
            header("Location: ". BASE_URL);
        }
        $data['title'] = ' pedidos ';
        $this->views->getView('admin/pedidos', "index", $data);
    }

    public function listarPendientes()
    {
        $query = new Query();
        $pedidosmodel = new PedidosModel($query);

        $data = $pedidosmodel->getPedidos('Pendiente');
        echo json_encode($data);
        die();
    }
    public function listarAceptados()
    {
        $query = new Query();
        $pedidosmodel = new PedidosModel($query);
        
        $data = $pedidosmodel->getPedidos('Aceptado');
        echo json_encode($data);
        die();
    }

    public function listarCompletados()
    {
        $query = new Query();
        $pedidosmodel = new PedidosModel($query);

        $data = $pedidosmodel->getPedidos('Completado');
        echo json_encode($data);
        die();
    }
    public function update($datos)
    {
        $query = new Query();
        $pedidosmodel = new PedidosModel($query);

        $array = explode(',', $datos);
        $idPedido = $array[0];
        $proceso = $array[1];
        if (is_numeric($idPedido)) {
            $data = $pedidosmodel->actualizarEstado($proceso,$idPedido);
            if ($data == 0) { // Si es true, actualización exitosa
                $respuesta = array('msg' => 'pedido actualizado', 'icono' => 'success');
            } else { // Si es false, error en la actualización
                $respuesta = array('msg' => 'error al actualizar', 'icono' => 'warning');
            }
            echo json_encode($respuesta);
        }
        die();
    }
}
