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
    public function registrarse()
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
    public function iniciar_sesion()
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
                        $_SESSION['rutCliente'] = $usuarioData['rut'];
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
    public function registrar_pedido()
{
    // Verificar que la solicitud sea de tipo POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del pedido desde la solicitud
        $datos = json_decode(file_get_contents("php://input"), true);

        // Realizar el registro del pedido en la base de datos
        $resultado = $this->model->registrarPedido(
            $datos['cod_pedido'],
            $datos['monto'],
            $datos['estado'],
            $datos['fecha_pedido'],
            $datos['cliente_rut']
        );

        // Responder con el resultado
        if ($resultado > 0) {
            $mensaje = array('msg' => 'OK', 'icono' => 'success');
        } else {
            $mensaje = array('msg' => 'Error al registrar el pedido', 'icono' => 'error');
        }

        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }
}

    //listar productos pendientes
    public function listarPendientes()
    {
        $id_cliente = $_SESSION['idCliente'];
        $data = $this->model->getPedidos($id_cliente);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="text-center"><button class="btn btn-primary" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button></div>';
        }
        echo json_encode($data);
        die();
    }
    public function verPedido($idPedido)
    {
        $data['pedido'] = $this->model->getPedido($idPedido);
        $data['productos'] = $this->model->verPedidos($idPedido);
        $data['moneda'] = MONEDA;
        echo json_encode($data);
        die();
    }
}
