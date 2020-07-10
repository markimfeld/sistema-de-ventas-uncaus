<?php

require_once("../modelos/Categoria.php");

// instanciar
$categoria = new Categoria();


$idcategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";


switch($_GET["op"]) {
  case 'guardaryeditar':
    if(empty($idcategoria)) {
      $rspta = $categoria->insertar($nombre, $descripcion);
      echo $rspta ? "Categoria registrada" : "Categoria no se pudo registrar";
    } else {
      $rspta = $categoria->editar($idcategoria, $nombre, $descripcion);
      echo $rspta ? "Categoria actualizada" : "Categoria no se pudo actualizar";
    }
    break;
  case 'desactivar':
    if(!empty($idcategoria)) {
      $rspta = $categoria->desactivar($idcategoria);
      echo $rspta ? "Categoria desactivada" : "Categoria no se pudo desactivar";
    }
    break;
  case 'activar':
    if(!empty($idcategoria)) {
      $rspta = $categoria->activar($idcategoria);
      echo $rspta ? "Categoria activada" : "Categoria no se pudo activar";
    }
    break;
  case 'mostrar':
    if(!empty($idcategoria)) {
      $rspta = $categoria->mostrar($idcategoria);
      echo json_encode($rspta);
    }
    break;
  case 'listar':
    $rspta = $categoria->listar();

    $data = Array();
    while ($reg=$rspta->fetch_object()) {
      $data[] = array(
        "0" => ($reg->condicion) ? "<button onclick='mostrar(".$reg->idcategoria.")' class='btn btn-warning'><i class='fa fa-pencil'></i></button>".
                                    " <button onclick='desactivar(".$reg->idcategoria.")' class='btn btn-danger'><i class='fa fa-close'></i></button>" : 
                                    "<button onclick='mostrar(".$reg->idcategoria.")' class='btn btn-warning'><i class='fa fa-pencil'></i></button>". 
                                    " <button onclick='activar(".$reg->idcategoria.")' class='btn btn-primary'><i class='fa fa-check'></i></button>",
        "1" => $reg->nombre,
        "2" => $reg->descripcion,
        "3" => ($reg->condicion) ? "<span class='label bg-green'>Activado</span>" : "<span class='label bg-red'>Desactivado</span>" 
      );
    }
    $results = array(
      "sEcho"=>1, // Información para el datatables
      "iTotalRecords"=>count($data), // enviamos el total de registros al datatables
      "iTotalDiplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data
    );
    echo json_encode($results);
    break;
}

?>
