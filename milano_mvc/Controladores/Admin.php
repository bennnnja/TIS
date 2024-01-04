 <?php
class Admin extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {

        $data['title'] = 'Acceso Admin';
        $this->views->getView('admin', "login", $data);
    }
    public function   validar()
    {
        $query = new Query();
        $adminmodel = new AdminModel($query);

        if (isset($_POST['email']) && isset($_POST['contrasena'])) {
            if (empty($_POST['email']) || empty($_POST['contrasena'])) {
                $respuesta = array('msg' => 'todo los campos son requeridos', 'icono' => 'warning');
            } else {
                $data = $adminmodel->getUsuario($_POST['email']);
                if (empty($data)) {
                    $respuesta = array('msg' => 'el correo no existe', 'icono' => 'warning');
                } else {
                    $usuarioData = $data[0];

                    if (isset($usuarioData['contrasena'])) {
                        if (password_verify($_POST['contrasena'], $usuarioData['contrasena'])) {
                            $_SESSION['email'] = $usuarioData['email'];
                            $respuesta = array('msg' => 'Datos correctos', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'contraseña incorrecta', 'icono' => 'warning');
                        }
                    } else {
                        // Manejar el caso en que 'contrasena' no está en $usuarioData
                        $respuesta = array('msg' => 'Error interno, contacte al administrador', 'icono' => 'error');
                    }
                }
            }
        } else {
            $respuesta = array('msg' => 'error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function home()
    {   
        $query = new Query();
        $adminmodel = new AdminModel($query);

        if(empty($_SESSION["email"])) {
            header("Location: ". BASE_URL);
        }

        $data['title'] = 'Panel Administrativo';
        $data['pendientes'] = $adminmodel->getPendientes();
        $data['aceptados'] = $adminmodel->getAceptados();
        $data['completados'] = $adminmodel->getCompletados();
        $data['ventas'] = $adminmodel->getTotales();
        $data['ventasPorDia'] = $adminmodel->getVentasPorUltimos7Dias();
        $data['prodMasVendido'] = $adminmodel->getProductosMasVendidos();
        $data['prodMenorStock'] = $adminmodel->getProductosMenorStock();
        $data['prodMenosVendido'] = $adminmodel->getProductosMenosVendidos();
        $data['ingMenorStock'] = $adminmodel->getIngredientesMenorStock();
        $this->views->getView('admin/administracion', "index", $data);
        
    }

    public function cerrar_sesion() {

        session_destroy();
        header('Location: ' . BASE_URL);
}
}
