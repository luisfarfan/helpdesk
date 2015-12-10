<section class="content well">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Mis incidencias</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="table_incidencias_admin" class="table table-responsive">
                <thead>
                <th>Número Incidencia</th>
                <th>Usuario</th>
                <th>Técnico</th>
                <th>Categoría</th>
                <th>Fecha Inicio</th>
                <th>Fecha Cierre</th>
                <th>Estado Incidencia</th>
                <th></th>
                </thead>
                <tbody>
                    <?php
                    foreach ($incidencias as $row => $value) {
                        ?>
                        <tr>
                            <td style="cursor: pointer" onclick="ir('<?php echo base_url() . 'Admin/incidencia/' . $value['idincidencia'] ?> ')"><?php echo $value['idincidencia'] ?></td>
                            <td style="cursor: pointer" onclick="ir('<?php echo base_url() . 'Admin/incidencia/' . $value['idincidencia'] ?> ')"><?php echo $value['nombre_completo_usuario'] ?></td>
                            <td style="cursor: pointer" onclick="ir('<?php echo base_url() . 'Admin/incidencia/' . $value['idincidencia'] ?> ')"><?php echo $value['nombre_completo_tecnico'] ?></td>
                            <td style="cursor: pointer" onclick="ir('<?php echo base_url() . 'Admin/incidencia/' . $value['idincidencia'] ?> ')"><?php echo $value['categoria_nombre'] ?></td>
                            <td style="cursor: pointer" onclick="ir('<?php echo base_url() . 'Admin/incidencia/' . $value['idincidencia'] ?> ')"><?php echo $value['fecha_inicio'] ?></td>
                            <td style="cursor: pointer" onclick="ir('<?php echo base_url() . 'Admin/incidencia/' . $value['idincidencia'] ?> ')"><?php echo $value['fecha_cierre'] ?></td>
                            <td style="cursor: pointer" onclick="ir('<?php echo base_url() . 'Admin/incidencia/' . $value['idincidencia'] ?> ')"><?php echo $value['descripcion_estado'] ?></td>
                            <td><button class="btn btn-primary" data-toggle="modal" data-target="#bitacora" onclick="ver_bitacora(<?php echo $value['idincidencia'] ?>)">Ver Historial Incidencia</button></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div id="bitacora" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">&times;</span>
                    </button>
                </div>
            </div>

            <div id="div_bitacora" class="modal-body no-padding">

            </div>

            <div class="modal-footer no-margin-top">
                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Close
                </button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- PAGE CONTENT ENDS -->