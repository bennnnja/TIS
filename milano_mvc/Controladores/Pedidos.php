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
        $data = $this->model->getPedidos('Pendiente');
        echo json_encode($data);
        die();
    }
    public function listarAceptados()
    {
        $data = $this->model->getPedidos('Aceptado');
        echo json_encode($data);
        die();
    }

    public function listarCompletados()
    {
        $data = $this->model->getPedidos('Completado');
        echo json_encode($data);
        die();
    }
    public function update($datos)
    {
        $array = explode(',', $datos);
        $idPedido = $array[0];
        $proceso = $array[1];
        if (is_numeric($idPedido)) {
            $data = $this->model->actualizarEstado($proceso,$idPedido);
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
