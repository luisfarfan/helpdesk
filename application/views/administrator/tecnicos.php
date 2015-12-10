
<section class="container">
    <div class="well">
        <div class="wrapper">
            <form action="asignar" method="post">
                <?php isset($tecnico) ? print form_hidden('idusuario', $tecnico[0]['idusuario']) : ''; ?>

                <div class="col-md-3 noleftm">
                    <label for="exampleInputEmail1">Asignar como técnico: </label>
                    <select id="tecnicos" name="idusuario" class="form-control">
                        <option value="">Seleccione:</option>
                        <?php
                        foreach ($usuarios as $key => $value) {
                            if (isset($tecnico)) {
                                if ($value['idusuario'] == $tecnico[0]['nombre_completo']) {
                                    echo '<option selected value=' . $value['idusuario'] . '>' . $value['nombre_completo'] . '</option>';
                                } else {
                                    echo '<option value=' . $value['idusuario'] . '>' . $value['nombre_completo'] . '</option>';
                                }
                            } else {
                                echo '<option value=' . $value['idusuario'] . '>' . $value['nombre_completo'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <p></p>     
                    <button type="submit" class="btn btn-primary btn-lg">Asignar</button>
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Agregar Técnico</button>
                </div>
            </form>
        </div>
    </div>
    <div class="well">
        <table style="width: 100%; background-color: #fff; padding: 0px 10px 10px 10px;">
            <thead style="background-color: #f3f2f2"> 
            <td style=" height: 40px; border: 1px solid #ccc; padding: 10px; font-size: 16px; background-color: #7BABC7; color: #fff"> Técnico         </td>
            <td style=" height: 40px; border: 1px solid #ccc; padding: 10px; font-size: 16px; background-color: #7BABC7; color: #fff">Fecha
            </td>
            <td style=" height: 40px; border: 1px solid #ccc; padding: 10px; font-size: 16px; background-color: #7BABC7; color: #fff"> Nombre de Usuario
            </td>
            <td style=" height: 40px; border: 1px solid #ccc; padding: 10px; font-size: 16px; background-color: #7BABC7; color: #fff"> Eliminar
            </td>
            <thead>
            <tbody>
                <?php
                foreach ($tecnicos as $row => $value) {
                    ?>    <input type="hidden" value="<?php echo $value['idusuario'] ?>" />
                <tr>
                    <td style="height: 25px; padding: 10px;border: 1px solid #e9e8e8;">
                        <?php echo $value['nombre_completo'] ?>
                    </td>
                    <td style="height: 25px; padding: 10px;border: 1px solid #e9e8e8;">
                        <?php echo $value['fecha_registro_tecnico'] ?>
                    </td>
                    <td style="height: 25px; padding: 10px;border: 1px solid #e9e8e8;">
                        <?php echo $value['username'] ?>
                    </td>
                    <td style="height: 25px; padding: 10px;border: 1px solid #e9e8e8;">
                        <a href="http://192.168.221.123/helpdesk/Tecnicos/eliminar_tecs/<?php echo $value['idusuario'] ?>/">
                            <span style="font-size: 20px" class="glyphicon glyphicon-remove text-center center-block" aria-hidden="true">
                            </span> </a>
                    </td>

                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Agregar Técnico</h4>
            </div>
            <form action="save" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre Completo</label>
                        <input type="text" class="form-control" name="nombre_completo" id="nombre_completo">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Usuario:</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="control-label">Contraseña:</label>
                        <input type="password" class="form-control" name="clave">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>

    </div>

</div>