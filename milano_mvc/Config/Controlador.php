<?php
class Controlador {
    protected $views, $model;
    
    public function __construct()
    {
        $this->views = new Vistas();
        $this->cargarModel();
    }
    
    public function cargarModel()
    {
        // Obtén el nombre de la clase actual (controlador)
        $controlador = get_class($this);

        $modelo = $controlador . "Model";

        // Incluye el modelo
        $ruta = "Modelos/" . $modelo . ".php";
        if (file_exists($ruta)) {
            require_once $ruta;

            // Crea una instancia de Query
            $query = new Query();

            // Crea una instancia del modelo y pasa la instancia de Query
            $this->model = new $modelo($query);
        }
    }
}
?>
