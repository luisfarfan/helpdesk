<div class="container">
    <form action="guardar_pregunta" method="post">
        <div class="form-group">
            <div class="col-sm-10">
                <input class="form-control" name="encuesta_pregunta" value="" placeholder="Ingrese la Pregunta" required="required" autofocus="autofocus"/>
            </div>
        </div>
        <div class="form-group">
            <button type="submit">Guardar</button>
        </div>
        <span class="glyphicon glyphicon-plus" aria-hidden="true"><a href="#"></a></span>
</form>
    <form action="build_encuesta" method="post">        
        <div class="form-group">
            <div class="col-sm-10">
                <label for="">Preguntas:</label>
                <div class="ui-widget">
                    <select id="" name="idencuesta_preguntas" class="form-control">
                        <option value="">Seleccione</option>
                        <?php
                        foreach ($pregunta as $key => $value) {
                            echo '<option selected value=' . $value['idencuesta_preguntas'] . '>' . $value['encuesta_pregunta'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-10">
                <label for="">Opciones:</label>
                <div class="ui-widget">
                    <input name="opcion" class="form-control" placeholder="Ingrese la opción" required="required" autofocus="autofocus" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <button class="btn btn-primary btn-lg" type="submit">Crear</button>
            </div>
        </div>
    </form>
</div>