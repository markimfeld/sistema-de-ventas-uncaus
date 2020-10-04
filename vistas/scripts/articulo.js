var tabla;

function init() {
  mostrarform(false);
  listar();

    $('#formulario').on("submit", function(e){
        guardaryeditar(e);
    })
}

function limpiar() {
  $("#idcategoria").val("");
  $("#codigo").val("");
  $("#nombre").val("");
  $("#stock").val("");
  $("#descripcion").val("");
  $("#imagen").val("");
}

function mostrarform(flag) {
  limpiar();
  if(flag) {
    $("#listadoregistros").hide();
    $("#formularioregistros").show();
    $("#btnGuardar").prop("disabled", false);
    $("#btnAgregar").hide();
  } else {
    $("#listadoregistros").show();
    $("#formularioregistros").hide();
    $("#btnAgregar").show();
  }
}

function cancelarform() {
  limpiar();
  mostrarform(false);
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
      url: '../ajax/articulo.php?op=listar',
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

function guardaryeditar(e) {

    e.preventDefault();
    //$('#btnGuardar').prop('disabled', true);

    const formData = new FormData($('#formulario')[0]);


    $.ajax({
        url: "../ajax/articulo.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
    
}

function mostrar(idarticulo) {

    $.post("../ajax/articulo.php?op=mostrar", {idarticulo: idarticulo}, function(data) {

        data = JSON.parse(data);

        console.log(data);
        
        mostrarform(true);

        $('#idcategoria').val(data.idcategoria);
        $('#codigo').val(data.codigo);
        $('#nombre').val(data.nombre);
        $('#stock').val(data.stock);
        $('#descripcion').val(data.descripcion);
        $('#imagen').val(data.imagen);
    })
}

function desactivar(idarticulo) {
  bootbox.confirm("¿Está seguro de desactivar el Artículo?", function(result) {
    if(result) {
      $.post("../ajax/articulo.php?op=desactivar", {idarticulo : idarticulo}, function(e){
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  });
}


function activar(idarticulo) {
  bootbox.confirm("¿Está seguro de activar el Artículo?", function(result) {
    if(result) {
      $.post("../ajax/articulo.php?op=activar", {idarticulo : idarticulo}, function(e){
        bootbox.alert(e);
        tabla.ajax.reload();
      });
    }
  });
}



init();
