<?php

require('../config/Conexion.php');


Class Articulo {

    public function __construc() {
    }


    // insertar registros en la tabla
    public function insertar($idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen) {
      $query = "INSERT INTO articulo (idcategoria, codigo, nombre, stock,  descripcion, imagen,  condicion) 
        VALUES ($idcategoria, '$codigo', '$nombre', $stock, '$descripcion', '$imagen',  '1')";
      return ejecutarConsulta($query);
    }
    // editar 
    public function editar($idarticulo, $idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen) {
      $query = "UPDATE articulo SET idcategoria=$idcategoria, codigo='$codigo', nombre='$nombre', stock=$stock,  descripcion='$descripcion', imagen=$imagen 
                  WHERE idarticulo='$idarticulo'";
      return ejecutarConsulta($query);
    }

    public function desactivar($idarticulo) {
      $query = "UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
      return ejecutarConsulta($query);
    }

    public function activar($idarticulo) {
      $query = "UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
      return ejecutarConsulta($query);
    }

    public function mostrar($idarticulo) {
      $query = "SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
      return ejecutarConsultaSimpleFila($query);
    }

    public function listar() {
      $query = "SELECT * FROM articulo";
      return ejecutarConsulta($query);
    }
}

?>
