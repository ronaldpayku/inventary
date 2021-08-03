<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Registro Exitoso!", "Haz click en el botón para continuar registrando.", "success");
    </script>
<?php endif ?>
<?php if ($this->session->flashdata("error")): ?>
    <script>
        swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
    </script>
<?php endif ?>
<section class="content-header">
    <h1>
        Computadoras <small>Editar</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <form action="<?php echo base_url();?>equipos/computadoras/update" id="form-computadora" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idComputadora" value="<?php echo $computadora->id?>">
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label for="codigo">Código:</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" required="required" value="<?php echo $computadora->codigo?>">
                        </div>
                        <div class="form-group">
                            <label for="monitor">Monitores:</label>
                            <select name="monitor" id="monitor" class="form-control" required="required">
                                <option value="">Elija monitor</option>
                                <?php foreach ($monitores as $monitor): ?>
                                    <option value="<?php echo $monitor->id;?>" <?php echo $monitor->id == $computadora->monitor_id ? "selected":"";?>><?php echo $monitor->codigo;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="presentacion">Presentación:</label>
                            <select name="presentacion" id="presentacion" class="form-control" required="required">
                                <option value="">Elija presentación</option>
                                <?php foreach ($presentaciones as $presentacion): ?>
                                    <option value="<?php echo $presentacion->id;?>" <?php echo $presentacion->id == $computadora->presentacion_id ? "selected":"";?>><?php echo $presentacion->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="proveedor">Proveedor:</label>
                            <select name="proveedor" id="proveedor" class="form-control" required="required">
                                <option value="">Elija proveedor</option>
                                <?php foreach ($proveedores as $proveedor): ?>
                                    <option value="<?php echo $proveedor->id;?>" <?php echo $proveedor->id == $computadora->proveedor_id ? "selected":"";?>><?php echo $proveedor->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="finca">Finca:</label>
                            <select name="finca" id="finca" class="form-control" required="required">
                                <option value="">Elija finca</option>
                                <?php foreach ($fincas as $finca): ?>
                                    <option value="<?php echo $finca->id;?>" <?php echo $finca->id == $computadora->finca_id ? "selected":"";?>><?php echo $finca->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="area">Area:</label>
                            <select name="area" id="area" class="form-control" required="required">
                                <option value="">Elija area</option>
                                <?php foreach ($areas as $area): ?>
                                    <option value="<?php echo $area->id;?>" <?php echo $area->id == $computadora->area_id ? "selected":"";?>><?php echo $area->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contacto">Contacto:</label>
                            <input type="text" name="contacto" id="contacto" class="form-control" required="required" value="<?php echo $computadora->contacto;?>">
                        </div>
                        <div class="form-group">
                            <label for="fabricante">Fabricante:</label>
                            <select name="fabricante" id="fabricante" class="form-control" required="required">
                                <option value="">Elija Fabricante</option>
                                <?php foreach ($fabricantes as $fabricante): ?>
                                    <option value="<?php echo $fabricante->id;?>" <?php echo $fabricante->id == $computadora->fabricante_id ? "selected":"";?>><?php echo $fabricante->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bitacora">Bitacora:</label>
                            <input type="text" name="bitacora" id="bitacora" class="form-control" required="required" value="<?php echo $computadora->bitacora;?>">
                        </div>
                        <div class="form-group">
                            <label for="ip">IP:</label>
                            <input type="text" name="ip" id="ip" class="form-control" value="<?php echo $computadora->ip;?>">
                        </div>
                        <?php if ($computadora->estado == 0): ?>
                            <div class="form-group">
                                <label for="">Estado:</label>
                                <select name="estado" id="estado" required class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="2" selected>Inactivo</option>
                                </select>
                            </div>
                        <?php endif ?>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="procesador">Procesador:</label>
                            <select name="procesador" id="procesador" class="form-control" required="required">
                                <option value="">Elija procesador</option>
                                <?php foreach ($procesadores as $procesador): ?>
                                    <option value="<?php echo $procesador->id;?>" <?php echo $procesador->id == $computadora->procesador_id ? "selected":"";?>><?php echo $procesador->referencia." ".$procesador->velocidad;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="memoria">Memoria RAM:</label>
                            <select name="memoria" id="memoria" class="form-control" required="required">
                                <option value="">Elija memoria</option>
                                <?php foreach ($memorias as $memoria): ?>
                                    <option value="<?php echo $memoria->id;?>" <?php echo $memoria->id == $computadora->ram_id ? "selected":"";?>><?php echo $memoria->capacidad;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="disco">Disco Duro:</label>
                            <select name="disco" id="disco" class="form-control" required="required">
                                <option value="">Elija disco</option>
                                <?php foreach ($discos as $disco): ?>
                                    <option value="<?php echo $disco->id;?>" <?php echo $disco->id == $computadora->disco_id ? "selected":"";?>><?php echo $disco->capacidad;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sistema">Sistema Operativos:</label>
                            <select name="sistema" id="sistema" class="form-control" required="required">
                                <option value="">Elija Sistema</option>
                                <?php foreach ($sistemas as $sistema): ?>
                                    <option value="<?php echo $sistema->id;?>" <?php echo $sistema->id == $computadora->so_id ? "selected":"";?>><?php echo $sistema->descripcion;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="serial_so">Serial S.O:</label>
                            <input type="text" name="serial_so" id="serial_so" class="form-control" value="<?php echo $computadora->serial_so;?>">
                        </div>

                        <div class="form-group">
                            <label for="office">Office:</label>
                            <select name="office" id="office" class="form-control" required="required">
                                <option value="">Elija office</option>
                                <?php foreach ($office as $off): ?>
                                    <option value="<?php echo $off->id;?>" <?php echo $off->id == $computadora->office_id ? "selected":"";?>><?php echo $off->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="serial_office">Serial S.O:</label>
                            <input type="text" name="serial_office" id="serial_office" class="form-control" value="<?php echo $computadora->serial_office;?>">
                        </div>
                        <div class="form-group">
                            <label for="antivirus">Antivirus:</label>
                            <select name="antivirus" id="antivirus" class="form-control" required="required">
                                <option value="">Elija Antivirus</option>
                                <?php foreach ($antivirus as $antivir): ?>
                                    <option value="<?php echo $antivir->id;?>" <?php echo $antivir->id == $computadora->antivirus_id ? "selected":"";?>><?php echo $antivir->descripcion;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mac">MAC:</label>
                            <input type="text" name="mac" id="mac" class="form-control" value="<?php echo $computadora->mac;?>">
                        </div>

                        <!-- <?php if ($this->$computadora[0]['archivo_id'] != ""): ?> -->
                           <a target="_blank" href='<?php echo site_url('Image/view_images/computadoras/?id='.$computadora->id) ?>'><button type='button' class='btn btn-info btn-sm'><i class='fa fa-eye'></i></button></a>
                            <?php endif; ?> -->
                       
                       
                            <div class="form-group">
                            <label for="archivo">Subir Archivo</label>
                            <input type="file" name="archivo" id="archivo" class="form-control">
                        </div>

                        <a href="<?php echo site_url('Computadoras/view_images/computadoras/?id='.$computadora->id) ?>"<?php echo $computadora->id?> class="btn btn-primary btn-flat btn-arch"  title="Ver Archivo"><span class="fa fa-eye"></span></a>

                        

                        <!-- botn subir rp-->
                        <a href="<?php echo base_url();?>Image/add_image/?id=<?php echo $computadora->id?>" class="btn btn-warning btn-flat" title="Subir Archivo"><span class="fa fa-pencil"></span></a>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
