<?php
class Productos extends Controlador
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
        $data['title'] = ' productos ';
        $this->views->getView('admin/productos', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getProductos(1);
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        if (!empty($datos)) {
            $nombre_producto = isset($datos['nombre_producto']) ? $datos['nombre_producto'] : null;
            $cod_producto = isset($datos['cod_producto']) ? $datos['cod_producto'] : null;
            $precio = isset($datos['precio']) ? $datos['precio'] : null;
            $categoria = isset($datos['categoria']) ? $datos['categoria'] : null;
            $sabor = isset($datos['sabor']) ? $datos['sabor'] : null;
            $stock = isset($datos['stock']) ? $datos['stock'] : null;
            $fecha_vencimiento = isset($datos['fecha_vencimiento']) ? $datos['fecha_vencimiento'] : null;
            $imagen = $_FILES['imagen'];
            $tmp_name = $imagen['tmp_name'];
            $ruta = 'img_prod/';
            $nombreImg = date('YmdHis');
            if (empty($nombre_producto) || empty($precio) || empty($stock) || empty($categoria) || empty($sabor) || empty($fecha_vencimiento)) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                $existeProducto = $this->model->existeProducto($cod_producto);
                
                if (!empty($imagen['name'])) {
                    $destino = $ruta . $nombreImg . '.jpg';
                } else {
                    $destino = $ruta . 'default.png';
                }
                if (empty($existeProducto)) {
                    $data = $this->model->registrar($nombre_producto, $cod_producto, $precio, $stock, $sabor, $fecha_vencimiento, $categoria, $destino);
                    if ($data > 0) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'error al registrar', 'icono' => 'error');
                    } else {
                        $respuesta = array('msg' => 'producto registrado', 'icono' => 'success');
                    }
                } else {
                    $data = $this->model->modificar($nombre_producto, $cod_producto, $precio, $stock, $sabor, $fecha_vencimiento, $categoria);
                    if ($data == 1) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'error al modificar', 'icono' => 'error');
                    } else {
                        $respuesta = array('msg' => 'producto modificado', 'icono' => 'success');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }




    public function delete($idPro)
    {
        if (is_numeric($idPro)) {
            $data = $this->model->eliminar($idPro);
            if ($data == 1) {
                $respuesta = array('msg' => 'producto dado de baja', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }

    public function edit($idPro)
    {
        if (is_numeric($idPro)) {
            $data = $this->model->getProducto($idPro);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
