<?php
class Usuarios extends Controlador
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
        $data['title'] = ' usuarios ';
        $this->views->getView('admin/usuarios', "index", $data);
    }

    public function listar()
    {
        $query = new Query();
        $usuariosmodel = new UsuariosModel($query);

        $data = $usuariosmodel->getUsuarios(1);
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        $query = new Query();
        $usuariosmodel = new UsuariosModel($query);

        $datos = json_decode(file_get_contents("php://input"), true);

        if (!empty($datos)) {
            $nombre = isset($datos['nombre']) ? $datos['nombre'] : null;
            $rut = isset($datos['rut']) ? $datos['rut'] : null;
            $email = isset($datos['email']) ? $datos['email'] : null;
            $telefono = isset($datos['telefono']) ? $datos['telefono'] : null;
            $nom_usuario = isset($datos['nom_usuario']) ? $datos['nom_usuario'] : null;
            $contrasena = isset($datos['contrasena']) ? $datos['contrasena'] : null;
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $fecha_nacimiento = isset($datos['fecha_nacimiento']) ? $datos['fecha_nacimiento'] : null;
            if (empty($nombre) || empty($rut) || empty($email) || empty($telefono) || empty($nom_usuario) || empty($contrasena) || empty($fecha_nacimiento)) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                $rutExiste = $usuariosmodel->verificarRUT($rut);

                if (!$rutExiste) {
                    $result = $usuariosmodel->verificarCorreo($email);
                    if (empty($result)) {
                        $data = $usuariosmodel->registrar($nombre, $rut, $email, $telefono, $nom_usuario, $hash, $fecha_nacimiento);
                        if ($data > 0) {
                            $respuesta = array('msg' => 'Error al registrar', 'icono' => 'warning');
                        } else {
                            $respuesta = array('msg' => 'Usuario Registrado', 'icono' => 'success');
                        }
                    } else {
                        $respuesta = array('msg' => 'Correo ya existe', 'icono' => 'warning');
                    }
                } else {
                    $data = $usuariosmodel->modificar($nombre, $rut, $email, $telefono, $nom_usuario, $fecha_nacimiento);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Error al modificar', 'icono' => 'warning');
                    } else {
                        $respuesta = array('msg' => 'Usuario Modificado', 'icono' => 'success');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }

    public function delete($idUser)
    {
        $query = new Query();
        $usuariosmodel = new UsuariosModel($query);

        if (is_numeric($idUser)) {
            $data = $usuariosmodel->eliminar($idUser);
            if ($data == 1) {
                $respuesta = array('msg' => 'usuario dado de baja', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }

    public function edit($idUser)
    {
        $query = new Query();
        $usuariosmodel = new UsuariosModel($query);

        if (is_numeric($idUser)) {
            $data = $usuariosmodel->getUsuario($idUser);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
