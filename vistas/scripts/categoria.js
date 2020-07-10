var tabla;

function init() {
  mostrarform(false);
  listar();
}

function limpiar() {
  $("#idcategoria").val("");
  $("#nombre").val("");
  $("#descripcion").val("");
}

function mostrarform(flag) {
  limpiar();
  if(flag) {
    $("#listadoregistros").hide();
    $("#formularioregistros").show();
    $("#btnguardar").prop("disabled", false);
  } else {
    $("#listadoregistros").show();
    $("#formularioregistros").hide();
  }
}

function cancelarform() {
  limpiar();
  mostrarForm(false);
}

function listar() {
  tabla = $("#tbllistado").dataTable({
    "aProcessing": true,
    "aServerSide": true,
    dom: 'Bfrtip',
    buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],
    "ajax": {
      url: '../ajax/categoria.php?op=listar',
      type: "get",
      dataType: "json",
      error: function(e) {
        console.log(e.responseText);
      }
    },
    "bDestroy": true,
    "iDisplayLength": 5,
    "order": [[0, "desc"]]
  }).DataTable();
}

function guardaryeditar() {
}


function desactivar(idcategoria) {
  bootbox.confirm("¿Está seguro de desactivar la Categoría?", function(result) {
    if(result) {
      $.post("../ajax/categoria.php?op=desactivar", {idcategoria : idcategoria}, function(e){
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  });
}


function activar(idcategoria) {
  bootbox.confirm("¿Está seguro de activar la Categoría?", function(result) {
    if(result) {
      $.post("../ajax/categoria.php?op=activar", {idcategoria : idcategoria}, function(e){
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  });
}


init();
