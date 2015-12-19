<div class="form-group">
    <label for="recipient-name" class="control-label">Descripción Categoría</label>
    <input type="text" class="form-control" name="categoria_nombre" value="<?php echo $categoria[0]['categoria_nombre'] ?>" id="nombre_completo">
</div>
<div class="form-group">
    
    <input type="hidden" name="idcategoria" id="idcategoria" value="<?php echo $categoria[0]['idcategoria'] ?>" />
    <select id="tecnico_idusuario" name="tecnico_idusuario" class="form-control">
        <option value="">Seleccione:</option>
        <?php
        foreach ($tecnicos as $key => $value) {
            if ($categoria[0]['tecnico_idusuario'] == $value['idusuario']) {
                echo '<option selected value=' . $value['idusuario'] . '>' . $value['nombre_completo'] . '</option>';
            } else {
                echo '<option value=' . $value['idusuario'] . '>' . $value['nombre_completo'] . '</option>';
            }
        }
        ?>     
    </select> 
</div>