<?php

require_once("../modelos/Articulo.php");
require_once("../modelos/Categoria.php");

// instanciar
$articulo = new Articulo();
$categoria = new Categoria();


$idarticulo = isset($_POST["idarticulo"]) ? limpiarCadena($_POST["idarticulo"]) : "";
$idcategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
$codigo = isset($_POST["codigo"]) ? limpiarCadena($_POST["codigo"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$stock = isset($_POST["stock"]) ? limpiarCadena($_POST["stock"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";



switch($_GET["op"]) {
  case 'guardaryeditar':
    if(empty($idarticulo)) {
      $rspta = $articulo->insertar($idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen);
      echo $rspta ? "Articulo registrado" : "Articulo no se pudo registrar";
    } else {
      $rspta = $articulo->editar($idarticulo, $idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen); echo $rspta ? "Articulo actualizado" : "Articulo no se pudo actualizar";
    }
    break;
  case 'desactivar':
    if(!empty($idarticulo)) {
      $rspta = $articulo->desactivar($idarticulo);
      echo $rspta ? "Articulo desactivado" : "Articulo no se pudo desactivar";
    }
    break;
  case 'activar':
    if(!empty($idarticulo)) {
      $rspta = $articulo->activar($idarticulo);
      echo $rspta ? "Articulo activado" : "Articulo no se pudo activar";
    }
    break;
  case 'mostrar':
    if(!empty($idarticulo)) {
      $rspta = $articulo->mostrar($idarticulo);
      echo json_encode($rspta);
    }
    break;
  case 'listar':
    $rspta = $articulo->listar();

    $data = Array();
    while ($reg=$rspta->fetch_object()) {
      $idcat = $reg->idcategoria;
      $cat = $categoria->mostrar($idcat);

      $data[] = array(
        "0" => ($reg->condicion) ? "<button onclick='mostrar(".$reg->idarticulo.")' class='btn btn-warning'><i class='fa fa-pencil'></i></button>".
                                    " <button onclick='desactivar(".$reg->idarticulo.")' class='btn btn-danger'><i class='fa fa-close'></i></button>" : 
                                    "<button onclick='mostrar(".$reg->idarticulo.")' class='btn btn-warning'><i class='fa fa-pencil'></i></button>". 
                                    " <button onclick='activar(".$reg->idarticulo.")' class='btn btn-primary'><i class='fa fa-check'></i></button>",
        "1" => $cat["nombre"],
        "2" => $reg->codigo,
        "3" => $reg->nombre,
        "4" => $reg->stock,
        "5" => $reg->descripcion,
        "6" => $reg->imagen,
        "7" => ($reg->condicion) ? "<span class='label bg-green'>Activado</span>" : "<span class='label bg-red'>Desactivado</span>" 
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
