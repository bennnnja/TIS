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
        if(empty($_SESSION["emailCliente"])) {
            header("Location: ". BASE_URL);
        }
        $data['title'] = 'Tu Perfil';
        $data['verificar'] = $this->model->getVerificar($_SESSION["emailCliente"]);
        $this->views->getView('principal', "perfil", $data);
    }
    public function registroDirecto()
    {
        if (isset($_POST['nombre']) && isset($_POST['contrasena'])) {
            $nombre = $_POST['nombre'];
            $nom_usuario = $_POST['nom_usuario'];
            $rut = $_POST['rut'];
            $telefono = $_POST['telefono'];
            $fdn = $_POST['fecha_nacimiento'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $hash = password_hash($contrasena,PASSWORD_DEFAULT);
            $data = $this->model->registroDirecto($nombre, $nom_usuario, $rut, $telefono, $fdn, $email, $hash)+1;

            if ($data > 0) {
                $_SESSION['emailCliente'] = $email;
                $_SESSION['nombreCliente'] = $nombre;
                $mensaje = array('msg' => 'registrado con éxito', 'icono' => 'success');
            } else {
                $mensaje = array('msg' => 'error al registrarse', 'icono' => 'error');
            }
            
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }

        #else {
        #   $mensaje = array('msg' => 'YA TIENES UNA CUENTA', 'icono' => 'warning');
        #}
    }
    public function loginDirecto()
    {
        if (isset($_POST['correoLogin']) && isset($_POST['contrasenaLogin'])) {
            if (empty($_POST['correoLogin']) || empty($_POST['contrasenaLogin'])) {
                $mensaje = array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            } else {
                $email = $_POST['correoLogin'];
                $contrasena = $_POST['contrasenaLogin'];
                
                $verificar = $this->model->getVerificar($email);
                
                $usuarioData= $verificar[0];
                
                if (!empty($verificar)) {
                    if (password_verify($contrasena, $usuarioData['contrasena'])) {
                        $_SESSION['emailCliente'] = $usuarioData['email'];
                        $_SESSION['nombreCliente'] = $usuarioData['nombre'];
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

        #else {
        #   $mensaje = array('msg' => 'YA TIENES UNA CUENTA', 'icono' => 'warning');
        #}
    }
    
}
