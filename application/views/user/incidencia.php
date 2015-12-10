<!-- Main content -->
<div class="container">
<section class="content well">
    <?php echo form_open_multipart('Bienvenido/nueva_incidencia') ?>
    

    <div class="col-md-13">
        <div class="box box-primary">
            <div class="box-header">

            </div><!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Categoría</label>
                    <div class="ui-widget">
                        <select id="categorias" name="idcategoria" class="form-control">
                            <option></option>
                            <?php
                            foreach ($categorias as $key => $value) {

                                echo '<option value=' . $value['idcategoria'] . '>' . $value['categoria_nombre'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    
                    <label for="">Título</label>
                    <input type="text" id="titulo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Descripción de la Incidencia</label>
                    <textarea class="form-control" name="descripcion_incidencia" rows="3" placeholder="Enter ..."></textarea>
                </div>

                    <div class="form-group">
                        <span class="btn btn-success ">
                            <div class="divfoto">
                                <i class="glyphicon glyphicon-plus fl_left"></i>
                                <span class="fl_left">&nbsp;Suba su Archivo:</span>
                            </div><br>
                    <input type="file" name="userfile" id="userfile">

                        </span>
                        <div id="errorfile"></div>
                    </div>

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Enviar Incidencia</button>
            </div>
        </div>
    </div>
</section><!-- /.content -->
</div>
</div><!-- /.container -->
</div><!-- /.content-wrapper -->
