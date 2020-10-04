<?php 
    require('header.php'); 
    require_once("../modelos/Categoria.php"); ?>


<!--Contenido-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                      <h1 class="box-title">Articulo <button id="btnAgregar" class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive"  id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover"> 
                    <thead>
                      <th>Opciones</th>
                      <th>Categoria</th> <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Stock</th>
                      <th>Descripcion</th>
                      <th>Imagen</th>
                      <th>Estado</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>Opciones</th>
                      <th>Categoria</th>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Stock</th>
                      <th>Descripcion</th>
                      <th>Imagen</th>
                      <th>Estado</th>
                    </tfoot>
                  </table>
                </div>

                <div class="panel-body table-responsive" id="formularioregistros">
                    <form name="formulario" id="formulario" method="post">
                        <input id="idarticulo" name="idarticulo" type="hidden">
                        <div class="form-group col col-sm-6">
                            <label for="nombre">Categoria:</label>
                            <select name="idcategoria" class="form-control">
                                <?php 
                                    $categoria = new Categoria();
                                    $res = $categoria->listar();
                                    while($cat=$res->fetch_object()):
                                ?>
                                    <option value="<?php echo $cat->idcategoria; ?>"><?php echo $cat->nombre; ?></option>
                                <?php
                                    endwhile;
                                ?>
                            </select>
                        </div>
                        <div class="form-group col col-sm-6">
                            <label for="codigo">Codigo:</label>
                            <input id="codigo" class="form-control" name="codigo" maxlength="50" type="text" placeholder="Codigo">
                        </div>
                        <div class="form-group col col-sm-6">
                            <label for="nombre">Nombre:</label>
                            <input id="nombre" class="form-control" name="nombre" type="text" maxlength="50" placeholder="Nombre" required>
                        </div>
                        <div class="form-group col col-sm-6">
                            <label for="stock">Stock:</label>
                            <input id="stock" class="form-control" name="stock" type="number" placeholder="Stock" required>
                        </div>
                        <div class="form-group col col-sm-6">
                            <label for="descripcion">Descripción:</label>
                            <input id="descripcion" class="form-control" name="descripcion" type="text" maxlength="256" placeholder="Descripcion">
                        </div>
                        <div class="form-group col col-sm-6">
                            <label for="imagen">Imagen:</label>
                            <input id="imagen" class="form-control" name="imagen" type="file" placeholder="Imagen">
                        </div>
                        <div class="form-group col col-sm-6">
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                    </form>
                </div>
                <!--Fin centro -->
              </div><!-- /.box -->
          </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->


<?php require("footer.php"); ?>

<script src="scripts/articulo.js"></script>
