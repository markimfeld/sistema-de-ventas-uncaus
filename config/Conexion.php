<?php

require_once "global.php";

// Conexión a la BD
$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_DBPASSWORD, DB_NAME);

// Consulta para establecer mi cotejamiento
mysqli_query($conexion, 'SET_NAMES "' . DB_ENCODE . '"');

// si tenemos un posible error en la cadena de conexión lo mostramos
if(mysqli_connect_errno()) {
  printf("Falló la conexión a la Base de Datos: %s\n", mysqli_connect_errno());
  exit();
}

if(!function_exists('ejecutarConsulta')) {
  
  function ejecutarConsulta($sql) {
    global $conexion;
    $query = $conexion->query($sql);
    return $query;
  }

  function ejecutarConsultaSimpleFila($sql) {
    global $conexion;
    $query = $conexion->query($sql);
    $row = $query->fetch_assoc();
    return $row;
  }

  function ejecutarConsulta_retornarID($sql) {
    global $conexion;
    $query = $conexion->query($sql);
    return $conexion->insert_id;
  }

  function limpiarCadena($str) {
    global $conexion;
    $str = mysqli_real_escape_string($conexion, trim($str));
    return htmlspecialchars($str);
  }
}



?>
