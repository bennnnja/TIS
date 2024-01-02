<?php
class Principal extends Controlador
{
    public function __construct() {
        parent::__construct();
        session_start();
    }
    public function index()
    {

    }
    public function productos()
    {
        $data['title'] = 'Productos';
        
        $query = new Query();
        $principalModel = new PrincipalModel($query);

        $data['losProductos'] = $principalModel->getProductos();
        $this->views->getView('principal', "productos", $data);
    }
    
    public function sobre_nosotros(){
        $data['title'] = 'Sobre Nosotros';
        $this->views->getView('principal', "sobre_nosotros", $data);
    }

    public function categoriaPal()
    {
        $data['title'] = 'Paletas';
        $query = new Query();
        $principalModel = new PrincipalModel($query);
        $data['paletas'] = $principalModel->getPaletas();
        $this->views->getView('principal', "categoriaPal", $data);
    }
    public function categoriaBot()
    {
        $data['title'] = 'Botes';
        $query = new Query();
        $principalModel = new PrincipalModel($query);
        $data['botes'] = $principalModel->getBotes();
        $this->views->getView('principal', "categoriaBot", $data);
    }
    
    public function listaProductos()
{
    // Recibir datos del cuerpo de la solicitud
    $datos = file_get_contents('php://input');
    $json = json_decode($datos, true);
        $array['producto'] = array();
        $total = 0;
        $query = new Query();
        $principalModel = new PrincipalModel($query);

        if (!empty($json)) {
            foreach ($json as $producto) {
                
                $result = $principalModel->getListaProducto($producto['cod_producto']);
               
                if (isset($result[0]['cod_producto'])) {
                    $data['cod_producto'] = $result[0]['cod_producto'];
                } else {
                    $data['cod_producto'] = null;
                }
    
                // Repite esto para otros índices (nombre_producto, precio, imagen)
                if (isset($result[0]['nombre_producto'])) {
                    $data['nombre_producto'] = $result[0]['nombre_producto'];
                } else {
                    $data['nombre_producto'] = null;
                }
    
                if (isset($result[0]['precio'])) {
                    $data['precio'] = $result[0]['precio'];
                } else {
                    $data['precio'] = null;
                }
    
                if (isset($result[0]['imagen'])) {
                    $data['imagen'] = $result[0]['imagen'];
                } else {
                    $data['imagen'] = null;
                }

                if (isset($result[0]['stock'])) {
                    $data['stock'] = $result[0]['stock'];
                } else {
                    $data['stock'] = null;
                }
                
                $subTotal = $data['precio'] * $producto['cantidad'];
                $data['cantidad'] = $producto['cantidad'];
                $data['subTotal'] = number_format($subTotal);
                
               // if ($producto['cantidad'] <= $data['stock']){
                    
                    array_push($array['producto'], $data);
                    $total += $subTotal;
                    
               // } else {
                    
                    
                //}
                
            }
        }        

        $array['total'] = $total;
        $array['moneda'] = MONEDA;
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
}