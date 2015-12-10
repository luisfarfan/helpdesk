<section class="content">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Mis incidencias</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="table_incidencias" class="table table-responsive">
                <thead>
                <th>Numero Incidencia</th>
                <th>Técnico</th>
                <th>Categoría</th>
                <th>Fecha Inicio</th>
                <th>Fecha Cierre</th>
                <th>Estado Incidencia</th>
                </thead>
                <tbody>

                    <?php
                    foreach ($incidencias as $row => $value) {
                        ?>
                    <tr style="cursor: pointer" onclick="ir('<?php echo base_url() . 'Bienvenido/incidencia/' . $value['idincidencia'] ?>')">
                            <?php
                            echo '<td>' . $value['idincidencia'] . '</td>';
                            echo '<td>' . $value['nombre_completo_tecnico'] . '</td>';
                            echo '<td>' . $value['categoria_nombre'] . '</td>';
                            echo '<td>' . $value['fecha_inicio'] . '</td>';
                            echo '<td>' . $value['fecha_cierre'] . '</td>';
                            echo '<td>' . $value['descripcion_estado'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>



</section>
