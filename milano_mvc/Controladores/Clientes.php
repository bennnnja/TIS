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
        if (empty($_SESSION["emailCliente"])) {
            header("Location: " . BASE_URL);
        }
        $data['title'] = 'Tu Perfil';

        $query = new Query();
        $clientesmodel = new ClientesModel($query);

        $data['verificar'] = $clientesmodel->getVerificar($_SESSION["emailCliente"]);
        $data['perfil'] = $clientesmodel->getPerfil($_SESSION["emailCliente"]);
        $this->views->getView('principal', "perfil", $data);
    }
    public function registrarse()
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        if (!empty($datos)) {
            $nombre = isset($datos['nombre']) ? $datos['nombre'] : null;
            $rut = isset($datos['rut']) ? $datos['rut'] : null;
            $email = isset($datos['email']) ? $datos['email'] : null;
            $telefono = isset($datos['telefono']) ? $datos['telefono'] : null;
            $nom_usuario = isset($datos['nom_usuario']) ? $datos['nom_usuario'] : null;
            $contrasena = isset($datos['contrasena']) ? $datos['contrasena'] : null;
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $fdn = isset($datos['fecha_nacimiento']) ? $datos['fecha_nacimiento'] : null;

            $query = new Query();
            $clientesmodel = new ClientesModel($query);

            $data = $clientesmodel->registroDirecto($nombre, $nom_usuario, $rut, $telefono, $fdn, $email, $hash) + 1;

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
        $datos = json_decode(file_get_contents("php://input"), true);

        if (!empty($datos)) {
            $correoLogin = isset($datos['correoLogin']) ? $datos['correoLogin'] : null;
            $contrasenaLogin = isset($datos['contrasenaLogin']) ? $datos['contrasenaLogin'] : null;

            if (empty($correoLogin) || empty($contrasenaLogin)) {
                $mensaje = array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            } else {
                $query = new Query();
                $clientesmodel = new ClientesModel($query);
                $verificar = $clientesmodel->getVerificar($correoLogin);

                if (!empty($verificar)) {
                    $usuarioData = $verificar[0];
                    if (password_verify($contrasenaLogin, $usuarioData['contrasena'])) {
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

            $query = new Query();
            $clientesmodel = new ClientesModel($query);

            $datos = file_get_contents('php://input');
            $json = json_decode($datos, true);
            $pedidos = $json['pedidos'];
            $productos = $json['productos'];
            $resultadoPedido = $clientesmodel->registrarPedido(
                $pedidos['cod_pedido'],
                $pedidos['monto'],
                $pedidos['estado'],
                $pedidos['fecha_pedido'],
                $pedidos['cliente_rut']
            );

            $resultadoPedido = 1;
            // Responder con el resultado
            if ($resultadoPedido > 0) {
                // El pedido se registró correctamente, ahora registrar el detalle
                foreach ($productos as $producto) {

                    $temp = $clientesmodel->getProducto($producto['cod_producto']);
                    if (isset($temp[0]['nombre_producto'])) {
                        $nombre_producto['nombre_producto'] = $temp[0]['nombre_producto'];
                    } else {
                        $nombre_producto['nombre_producto'] = null;
                    }
                    if (isset($temp[0]['precio'])) {
                        $precio['precio'] = $temp[0]['precio'];
                    } else {
                        $precio['precio'] = null;
                    }
                    if (isset($temp[0]['cod_producto'])) {
                        $cod_producto['cod_producto'] = $temp[0]['cod_producto'];
                    } else {
                        $cod_producto['cod_producto'] = null;
                    }

                    $resultadoDetalle = $clientesmodel->registrarDetalle(
                        $nombre_producto['nombre_producto'],
                        $precio['precio'],
                        $producto['cantidad'],
                        $pedidos['cod_pedido'],
                        $cod_producto['cod_producto']
                    );

                    $clientesmodel->actualizarStock($producto['cantidad'], $cod_producto['cod_producto']);

                    if ($resultadoDetalle  <= 0) {
                        // Manejar el caso en que no se pudo registrar el detalle
                        // Puedes lanzar un error, log o realizar acciones adicionales
                        $mensaje = array('msg' => 'Error al registrar el detalle', 'icono' => 'error');
                        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
                        die();
                    }
                }

                // El detalle se registró correctamente

                $mensaje = array('msg' => 'Pedido registrado correctamente', 'icono' => 'success');
            } else {
                // Manejar el caso en que no se pudo registrar el pedido
                // Puedes lanzar un error, log o realizar acciones adicionales

                $mensaje = array('msg' => 'Error al registrar el pedido', 'icono' => 'error');
            }

            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //listar productos pendientes
    public function listarPedidos()
    {
        $rut = $_SESSION['rutCliente'];

        $query = new Query();
        $clientesmodel = new ClientesModel($query);

        $data = $clientesmodel->getPedidos($rut);
        echo json_encode($data);
        die();
    }

    public function verPedido($cod_pedido)
    {
        $query = new Query();
        $clientesmodel = new ClientesModel($query);

        $data['producto'] = $clientesmodel->verPedidos($cod_pedido);
        echo json_encode($data);
        die();
    }

    public function cerrar_sesion()
    {

        session_destroy();
        header('Location: ' . BASE_URL);
    }
    public function administrar_perfil()
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        if (!empty($datos)) {
            $nombre = isset($datos['nombre']) ? $datos['nombre'] : null;
            $telefono = isset($datos['telefono']) ? $datos['telefono'] : null;
            $contrasena = isset($datos['contrasena']) ? $datos['contrasena'] : null;
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);

            $query = new Query();
            $clientesmodel = new ClientesModel($query);

            $resultado = $clientesmodel->actualizarPerfil($nombre, $telefono, $hash, $_SESSION['rutCliente']);

            if ($resultado > 0) {
                $mensaje = array('msg' => 'Perfil actualizado con éxito', 'icono' => 'success');
            } else {
                $mensaje = array('msg' => 'Error al actualizar el perfil', 'icono' => 'error');
            }

            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}
