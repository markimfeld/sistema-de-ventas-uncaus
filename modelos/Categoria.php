<?php 

// incluir la conexión a la DB
require("../config/Conexion.php");


Class Categoria {
// constructor
  public function __construct() {

  }

  // insertar registros en la tabla
  public function insertar($nombre, $descripcion) {
    $query = "INSERT INTO categoria (nombre, descripcion, condicion) 
      VALUES ('$nombre', '$descripcion', '1')";
    return ejecutarConsulta($query);
  }
  // editar 
  public function editar($idcategoria, $nombre, $descripcion) {
    $query = "UPDATE categoria SET nombre='$nombre', descripcion='$descripcion', 
                WHERE idcategoria='$idcategoria'";
    return ejecutarConsulta($query);
  }

  public function desactivar($idcategoria) {
    $query = "UPDATE categoria SET condicion='0' WHERE idcategoria='$idcategoria'";
    return ejecutarConsulta($query);
  }

  public function activar($idcategoria) {
    $query = "UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
    return ejecutarConsulta($query);
  }

  public function mostrar($idcategoria) {
    $query = "SELECT * FROM categoria WHERE idcategoria='$idcategoria'";
    return ejecutarConsultaSimpleFila($sql);
  }

  public function listar() {
    $query = "SELECT * FROM categoria";
    return ejecutarConsulta($query);
  }

}


?>
