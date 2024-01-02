<?php
class Ingredientes extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        if (empty($_SESSION["email"])) {
            header("Location: " . BASE_URL);
        }
        $data['title'] = ' ingredientes ';
        $this->views->getView('admin/ingredientes', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getIngredientes(1);
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        if (!empty($datos)) {
            $nombre_ingrediente = isset($datos['nombre_ingrediente']) ? $datos['nombre_ingrediente'] : null;
            $cod_ingrediente = isset($datos['cod_ingrediente']) ? $datos['cod_ingrediente'] : null;
            $unidad_de_medida = isset($datos['unidad_de_medida']) ? $datos['unidad_de_medida'] : null;
            $stock = isset($datos['stock']) ? $datos['stock'] : null;
            $fecha_vencimiento = isset($datos['fecha_vencimiento']) ? $datos['fecha_vencimiento'] : null;
            if (empty($cod_ingrediente) || empty($unidad_de_medida) || empty($stock) || empty($fecha_vencimiento)) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                $result = $this->model->verificarIngrediente($cod_ingrediente);

                if (empty($result)) {
                    $data = $this->model->registrar($nombre_ingrediente, $cod_ingrediente, $unidad_de_medida, $stock, $fecha_vencimiento);
                    if ($data > 0) {
                        $respuesta = array('msg' => 'Error al registrar', 'icono' => 'warning');
                    } else {
                        $respuesta = array('msg' => 'Ingrediente Registrado', 'icono' => 'success');
                    }
                } else {
                    $data = $this->model->modificar($nombre_ingrediente, $cod_ingrediente, $unidad_de_medida, $stock, $fecha_vencimiento);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Error al modificar', 'icono' => 'warning');
                    } else {
                        $respuesta = array('msg' => 'Ingrediente Modificado', 'icono' => 'success');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }

    // public function registrar()
    // {
    //     if (isset($_POST['nombre_ingrediente'])) {
    //         $nombre_ingrediente = $_POST['nombre_ingrediente'];
    //         $cod_ingrediente = $_POST['cod_ingrediente'];
    //         $unidad_de_medida = $_POST['unidad_de_medida'];
    //         $stock = $_POST['stock'];
    //         $fecha_vencimiento = $_POST['fecha_vencimiento'];
    //         if (empty($cod_ingrediente) || empty($unidad_de_medida) || empty($stock) || empty($fecha_vencimiento)) {
    //             $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
    //         } else {
    //             $result = $this->model->verificarIngrediente($cod_ingrediente);

    //             if (empty($result)) {
    //                 // El ingrediente no existe, proceder con el registro
    //                 $data = $this->model->registrar($nombre_ingrediente, $cod_ingrediente, $unidad_de_medida, $stock, $fecha_vencimiento);
    //                 if ($data > 0) {
    //                     $respuesta = array('msg' => 'Error al registrar', 'icono' => 'warning');
    //                 } else {
    //                     $respuesta = array('msg' => 'Ingrediente Registrado', 'icono' => 'success');
    //                 }
    //             } else {
    //                 // El ingrediente ya existe, proceder con la modificación
    //                 $data = $this->model->modificar($nombre_ingrediente, $cod_ingrediente, $unidad_de_medida, $stock, $fecha_vencimiento);
    //                 if ($data == 1) {
    //                     $respuesta = array('msg' => 'Error al modificar', 'icono' => 'warning');
    //                 } else {
    //                     $respuesta = array('msg' => 'Ingrediente Modificado', 'icono' => 'success');
    //                 }
    //             }
    //         }

    //         echo json_encode($respuesta);
    //     }
    //     die();
    // }




    public function delete($idIngre)
    {
        if (is_numeric($idIngre)) {
            $data = $this->model->eliminar($idIngre);
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

    public function edit($idIngre)
    {
        if (is_numeric($idIngre)) {
            $data = $this->model->getIngrediente($idIngre);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
