<div class="row">
        <div class="box box-primary">

            <div class="box-body">
                <select id="div_tecnicos" name="idusuario" class="form-control">
                    <option value="">Seleccione:</option>
                    <?php
                    foreach ($idusuario as $key => $value) {
                        echo '<option selected value=' . $value['idusuario'] . '>' . $value['nombre_completo'] . '</option>';
                        echo '<option value=' . $value['idusuario'] . '>' . $value['nombre_completo'] . '</option>';
                    }
                    ?>     
                </select> 
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>


        </div>

    </div>

