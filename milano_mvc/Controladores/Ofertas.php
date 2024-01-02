<?php
class Ofertas extends Controlador
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

        $data['title'] = ' ofertas ';
        $this->views->getView('admin/ofertas', "index", $data);
    }
    
    public function listar()
    {
        $data = $this->model->getOfertas(1);
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        if (!empty($datos)) {
            $cod_oferta = isset($datos['cod_oferta']) ? $datos['cod_oferta'] : null;
            $descripcion = isset($datos['descripcion']) ? $datos['descripcion'] : null;
            $tiempo_inicio = isset($datos['tiempo_inicio']) ? $datos['tiempo_inicio'] : null;
            $tiempo_fin = isset($datos['tiempo_fin']) ? $datos['tiempo_fin'] : null;
            $producto_cod_producto = isset($datos['producto_cod_producto']) ? $datos['producto_cod_producto'] : null;
            if (empty($cod_oferta) || empty($descripcion) || empty($tiempo_inicio) || empty($tiempo_fin) || empty($producto_cod_producto)) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                $result = $this->model->verificarOferta($cod_oferta);

                if (empty($result)) {
                        $data = $this->model->registrar($cod_oferta, $descripcion, $tiempo_inicio, $tiempo_fin, $producto_cod_producto);
                        if ($data > 0) {
                            $respuesta = array('msg' => 'Error al registrar', 'icono' => 'warning');
                        } else {
                            $respuesta = array('msg' => 'Oferta Registrada', 'icono' => 'success');
                        }
                } else {
                    $data = $this->model->modificar($cod_oferta, $descripcion, $tiempo_inicio, $tiempo_fin, $producto_cod_producto);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Error al modificar', 'icono' => 'warning');
                    } else {
                        $respuesta = array('msg' => 'Oferta Modificada', 'icono' => 'success');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }




    public function delete($idOfert)
    {
        if (is_numeric($idOfert)) {
            $data = $this->model->eliminar($idOfert);
            if ($data == 1) {
                $respuesta = array('msg' => 'Oferta dada de baja', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }

    public function edit($idOfert)
    {
        if (is_numeric($idOfert)) {
            $data = $this->model->getOferta($idOfert);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }


}
