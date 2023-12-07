<?php
class Vistas {
 
    public function getView($ruta, $vista, $data)
    {
        if ($ruta == "Home") {
            $vista = "Views/".$vista.".php";
        }else{
            $vista = "Views/".$ruta."/".$vista.".php";
        }
        require $vista;
    }
}
?>