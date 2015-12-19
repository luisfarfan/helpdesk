<form action="<?php echo base_url() ?>index.php/Registro/edit/<?php echo $value[0]['iddetalle'] ?>" method="post">
    <div class="form-group">
        <input type="hidden" value="<?php echo $iddetalle ?>" name="iddetalle">
        <input class="form-control" name="proyecto" type="text" value="<?php echo $value[0]['proyecto'] ?>">
    </div>
    <div class="form-group">
        <input class="form-control" name="solicitante" type="text" value="<?php echo $value[0]['solicitante'] ?>">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="descripcion" rows="4"  value="<?php echo $value[0]['descripcion'] ?>"><?php echo $value[0]['descripcion'] ?></textarea>
    </div>
    <div class="form-group">
        <input class="form-control" name="desde" type="text" value="<?php echo $value[0]['desde'] ?>">
    </div>
    <div class="form-group">
        <input class="form-control" name="hasta" type="text" value="<?php echo $value[0]['hasta'] ?>">
    </div>
    <div class="form-group">
        <select name="estado">
            <?php
            foreach ($estado_ as $row => $values) {
                if ($values['value'] == $value[0]['estado']) {
                    echo '<option selected="" value="' . $values['value'] . '">' . $values['value'] . '</option>';
                } else {
                    echo '<option value="' . $values['value'] . '">' . $values['value'] . '</option>';
                }
            }
            ?>

        </select>
    </div>

    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    <a type="button" href="<?php echo base_url() ?>index.php/Registro/delete/<?php echo $value[0]['iddetalle'] ?>" class="btn btn-danger">Eliminar registro</a>
</form>