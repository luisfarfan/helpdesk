<style>
    #table_bitacora{
        font-size: 12px
    }
</style>
<table id="table_bitacora" class="table table-striped table-bordered table-hover">
    <thead>
    <th>Numero Incidencia</th>
    <th>Estado Incidencia</th>
    <th>Fecha de Cambio</th>
    <th>Técnico Reasignado</th>
    <th>Vía de Actualización</th>
</thead>
<tbody>
    <?php
    foreach ($bitacora as $row => $value) {
        echo '<tr>';
        echo '<td>' . $value['idincidencia'] . '</td>';
        echo '<td>' . $value['descripcion_incidencia'] . '</td>';
        echo '<td>' . $value['fecha_cambio_estado'] . '</td>';
        $value['nombre_completo'] == '' ? print '<td>NO HUBO REASIGNACIÓN</td>' : print '<td>' . $value['nombre_completo'] . '</td>';
        echo '<td>' . $value['via_descripcion'] . '</td>';
        echo '</tr>';
    }
    ?>
</tbody>
</table>


