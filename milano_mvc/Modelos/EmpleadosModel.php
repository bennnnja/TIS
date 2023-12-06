<?php
class EmpleadosModel extends Query{
    public function __construct(){

        parent::__construct();

        }
        public function getEmpleado()
        {
            $sql = "SELECT nombre,rut,telefono FROM empleado";
            $data = $this->select($sql);
            return $data;
        }
        
}
?>