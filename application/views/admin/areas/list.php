<section class="content-header">
    <h1>
        Areas <small> Listado</small>
    </h1>

</section>
<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Registro Actualizado!","<?php echo $this->session->flashdata("success"); ?>", "success");
    </script>
<?php endif ?>
<?php if ($this->session->flashdata("error")): ?>
    <script>
        swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
    </script>
<?php endif ?>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <input type="hidden" id="modulo" value="areas">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo base_url();?>configuraciones/areas/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span>Agregar Area</a>
                    <hr>
                    <div class="table-responsive">
                        <table id="tb-without-buttons" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($areas as $area): ?>
                                    <tr>
                                        <td><?php echo $area->id?></td>
                                        <td><?php echo $area->nombre?></td>
                                        <td><?php echo $area->estado == 0 ?"Inactivo":"Activo";?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-flat btn-view-conf" data-toggle="modal" data-target="#modal-default" value="<?php echo $area->id;?>" title="Ver">
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                <a href="<?php echo base_url();?>configuraciones/areas/edit/<?php echo $area->id?>" class="btn btn-warning btn-flat" title="Editar"><span class="fa fa-pencil"></span></a>
                                                <?php if ($this->session->userdata("rol") == 1): ?>
                                                    <a href="<?php echo base_url();?>configuraciones/areas/delete/<?php echo $area->id?>" class="btn btn-danger btn-flat btn-delete" title="Eliminar">
                                                        <span class="fa fa-times"></span>
                                                    </a>
                                                <?php endif?>
                                                
                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion del Area</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print"> </span>Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->