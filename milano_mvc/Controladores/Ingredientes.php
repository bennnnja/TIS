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
        $query = new Query();
        $ingmodel = new IngredientesModel($query);

        $data = $ingmodel->getIngredientes(1);
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        $query = new Query();
        $ingmodel = new IngredientesModel($query);

        if (!empty($datos)) {
            $nombre_ingrediente = isset($datos['nombre_ingrediente']) ? $datos['nombre_ingrediente'] : null;
            $cod_ingrediente = isset($datos['cod_ingrediente']) ? $datos['cod_ingrediente'] : null;
            $unidad_de_medida = isset($datos['unidad_de_medida']) ? $datos['unidad_de_medida'] : null;
            $stock = isset($datos['stock']) ? $datos['stock'] : null;
            $fecha_vencimiento = isset($datos['fecha_vencimiento']) ? $datos['fecha_vencimiento'] : null;
            if (empty($cod_ingrediente) || empty($unidad_de_medida) || empty($stock) || empty($fecha_vencimiento)) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                $result = $ingmodel->verificarIngrediente($cod_ingrediente);

                if (empty($result)) {
                    $data = $ingmodel->registrar($nombre_ingrediente, $cod_ingrediente, $unidad_de_medida, $stock, $fecha_vencimiento);
                    if ($data > 0) {
                        $respuesta = array('msg' => 'Error al registrar', 'icono' => 'warning');
                    } else {
                        $respuesta = array('msg' => 'Ingrediente Registrado', 'icono' => 'success');
                    }
                } else {
                    $data = $ingmodel->modificar($nombre_ingrediente, $cod_ingrediente, $unidad_de_medida, $stock, $fecha_vencimiento);
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

    public function delete($idIngre)
    {
        $query = new Query();
        $ingmodel = new IngredientesModel($query);

        if (is_numeric($idIngre)) {
            $data = $ingmodel->eliminar($idIngre);
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
        $query = new Query();
        $ingmodel = new IngredientesModel($query);

        if (is_numeric($idIngre)) {
            $data = $ingmodel->getIngrediente($idIngre);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
