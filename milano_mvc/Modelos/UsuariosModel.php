<?php

require_once __DIR__ . '/../Config/Query.php';
class UsuariosModel
{
    private $query;
    public function __construct(Query $query)
    {
          $this->query = $query;
    }
    public function getUsuarios($estado)
    {
        $sql = "SELECT rut, nombre, email, telefono, nom_usuario FROM cliente WHERE estado = $estado";
        return  $this->query->selectAll($sql);
    }

    public function registrar($nombre, $rut, $email, $telefono, $nom_usuario, $contrasena, $fecha_nacimiento)
    {
        $sql = "INSERT INTO cliente (rut, nombre, email, telefono, nom_usuario, contrasena, fecha_nacimiento) VALUES (?,?,?,?,?,?,?)";
        $array = array($rut, $nombre, $email, $telefono, $nom_usuario, $contrasena, $fecha_nacimiento);
        return  $this->query->insertar($sql, $array);
    }
    public function verificarCorreo($email)
    {
        $sql="SELECT email FROM cliente WHERE email = '$email'";
        return  $this->query->select($sql);
    }

    public function verificarRUT($rut)
    {
        $sql="SELECT rut FROM cliente WHERE rut = '$rut'";
        return  $this->query->select($sql);
    }

    public function eliminar($idUser)
    {
        $sql="UPDATE cliente SET estado = ? WHERE rut = ?";
        $array = array(0, $idUser);
        return  $this->query->save($sql, $array);
    }

    public function getUsuario($idUser)
    {
        $sql = "SELECT rut, nombre, email, telefono, nom_usuario, fecha_nacimiento FROM cliente WHERE rut = '$idUser'";
        return  $this->query->select($sql);
    }

    public function modificar($nombre, $rut, $email, $telefono, $nom_usuario, $fecha_nacimiento)
    {
        $sql = "UPDATE cliente SET nombre=?, email=?, telefono=?, nom_usuario=?, fecha_nacimiento=? WHERE rut = '$rut'";
        $array = array($nombre, $email, $telefono, $nom_usuario, $fecha_nacimiento);
        return  $this->query->insertar($sql, $array);
    }
}
