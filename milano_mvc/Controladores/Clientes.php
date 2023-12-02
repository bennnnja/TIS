<?php

class Clientes extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        if (empty($_SESSION['email'])) {
            header('Location: ' . BASE_URL);
        }
        $data['perfil'] = 'si';
        $data['title'] = 'Tu Perfil';
        $data['categorias'] = $this->model->getCategorias();
        $data['verificar'] = $this->model->getVerificar($_SESSION['email']);
        $this->views->getView('principal', "perfil", $data);
    }
    public function registrarse()
    {
        if (isset($_POST['nombre']) && isset($_POST['contrasena'])) {
            if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['contrasena'])) {
                $mensaje = array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            } else {
                $nombre = $_POST['nombre'];
                $correo = $_POST['email'];
                $clave = $_POST['contrasena'];
                $verificar = $this->model->getVerificar($correo);
                if (empty($verificar)) {
                    $token = md5($correo);
                    $hash = password_hash($clave, PASSWORD_DEFAULT);
                    $data = $this->model->registroDirecto($nombre, $correo, $hash, $token);
                    if ($data > 0) {
                        $_SESSION['RUT'] = $data;
                        $_SESSION['email'] = $correo;
                        $_SESSION['nombre'] = $nombre;
                        $mensaje = array('msg' => 'registrado con éxito', 'icono' => 'success', 'token' => $token);
                    } else {
                        $mensaje = array('msg' => 'error al registrarse', 'icono' => 'error');
                    } 
                } else {
                    $mensaje = array('msg' => 'YA TIENES UNA CUENTA', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //login directo
    public function loginDirecto()
    {
        if (isset($_POST['email']) && isset($_POST['contrasena'])) {
            if (empty($_POST['email']) || empty($_POST['contrasena'])) {
                $mensaje = array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            } else {
                $correo = $_POST['email'];
                $clave = $_POST['contrasena'];
                $verificar = $this->model->getVerificar($correo);
                if (!empty($verificar)) {
                    if (password_verify($clave, $verificar['contrasena'])) {
                        $_SESSION['RUT'] = $verificar['RUT'];
                        $_SESSION['email'] = $verificar['email'];
                        $_SESSION['nombre'] = $verificar['nombre'];
                        $mensaje = array('msg' => 'OK', 'icono' => 'success');
                    } else {
                        $mensaje = array('msg' => 'CONTRASEÑA INCORRECTA', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'EL CORREO NO EXISTE', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
   
}
