<?php // debug($incidencias)                                  ?>
<section class="content">
    <?php echo form_open_multipart('Admin/save') ?>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Información de Usuario</h3>
            </div><!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
                <div class="form-group">
                    <?php isset($incidencias) ? print form_hidden('idincidencia', $incidencias[0]['idincidencia']) : ''; ?>
                    <label for="exampleInputEmail1">Asignado a: </label>
                    <div class="ui-widget">
                        <select id="tecnicos" name="tecnico_idusuario" class="form-control">
                            <option value="">Seleccione Tecnico</option>
                            <?php
                            foreach ($tecnicos as $key => $value) {
                                if (isset($incidencias)) {
                                    if ($value['idusuario'] == $incidencias[0]['tecnico_idusuario']) {
                                        echo '<option selected value=' . $value['idusuario'] . '>' . $value['apellido_paterno'] . ' ' . $value['apellido_materno'] . ' ' . $value['nombre_completo'] . '</option>';
                                    } else {
                                        echo '<option value=' . $value['idusuario'] . '>' . $value['apellido_paterno'] . ' ' . $value['apellido_materno'] . ' ' . $value['nombre_completo'] . '</option>';
                                    }
                                } else {
                                    echo '<option value=' . $value['idusuario'] . '>' . $value['apellido_paterno'] . ' ' . $value['apellido_materno'] . ' ' . $value['nombre_completo'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <?php
                if (!isset($incidencias)) {
                    echo form_hidden('fecha_inicio', date('Y-m-d h:i:s'))
                    ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Seleccionar Usuario: </label>
                        <div class="ui-widget">
                            <select id="idusuario" name="idusuario" class="form-control">
                                <option value=""></option>
                                <?php
                                foreach ($usuarios as $key => $value) {
                                    echo '<option value=' . $value['idusuario'] . '>' . trim($value['nombre_completo']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php if (isset($incidencias)) { ?>
                    <div class="form-group">
                        <select id="idestado_incidencia" class="form-control" name="idestado_incidencia">
                            <?php
                            foreach ($estados as $row => $value) {

                                if ($value['idestado_incidencia'] == $incidencias[0]['idestado_incidencia']) {
                                    echo '<option selected value="' . $value['idestado_incidencia'] . '">' . $value['descripcion_incidencia'] . '</option>';
                                } else {
                                    echo '<option value="' . $value['idestado_incidencia'] . '">' . $value['descripcion_incidencia'] . '</option>';
                                }
                            }
                            ?>
                        </select>

                    </div>
                    <?php
                } else {
                    echo form_hidden('idestado_incidencia', 1);
                }
                if (isset($incidencias)) {
                    ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Solución</label>
                        <textarea id="solucion" rows="3" name="solucion" class="form-control"><?php isset($incidencias) ? print $incidencias[0]['solucion'] : ''; ?></textarea>
                    </div>
                    <?php
                } else {
                    '';
                }
                ?>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Descripción de la Incidencia</h3>
            </div><!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Categoría</label>
                    <div class="ui-widget">
                        <?php if (isset($incidencias)) {
                            ?>

                            <select id="categorias" name="idcategoria" disabled="" class="form-control">
                                <option value="">Seleccione Categoría</option>
                                <?php
                                foreach ($categorias as $key => $value) {
                                    if ($value['idcategoria'] == $incidencias[0]['idcategoria']) {
                                        echo '<option selected value=' . $value['idcategoria'] . '>' . $value['categoria_nombre'] . '</option>';
                                    } else {
                                        echo '<option value=' . $value['idcategoria'] . '>' . $value['categoria_nombre'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        <?php } else {
                            ?>
                            <select id="categorias" name="idcategoria" class="form-control">
                                <option value="">Seleccione Categoría</option>
                                <?php
                                foreach ($categorias as $key => $value) {
                                    echo '<option value=' . $value['idcategoria'] . '>' . $value['categoria_nombre'] . '</option>';
                                }
                                ?>
                            </select>
                        <?php }
                        ?>

                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" id="titulo" value="<?php isset($incidencias) ? print $categorias[0]['categoria_nombre'] : '' ?>" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Descripción de la Incidencia</label>
                    <textarea class="form-control" rows="3" name="descripcion_incidencia"><?php isset($incidencias) ? print $incidencias[0]['descripcion_incidencia'] : ''; ?></textarea>
                </div>
                <?php
                if (isset($incidencias)) {
                    echo '<div class="form-group">'
                    . '<label>Archivo Adjunto</label><br>'
                    . '<a href="' . base_url() . 'application/uploads/' . $incidencias[0]['archivos'] . '"><label>' . $incidencias[0]['archivos'] . '</label>'
                    . '</div>';
                } else {
                    ?>
                    <div class="form-group">
                        <label for="exampleInputFile">Archivo</label>
                        <input type="file" name="userfile" id="userfile">
                    </div>
                <?php }
                ?>

            </div>
            <div class="box-footer">

                <button type="submit" class="btn btn-primary"><?php isset($incidencias) ? print 'Guardar Cambios' : print 'Enviar Incidencia'; ?></button>
            </div>
        </div>
    </div>
</section>
</div>
</div>
