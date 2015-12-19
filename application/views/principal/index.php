<div class="container">

    <div class="margin-bottom"></div>
    <form action="<?php base_url() ?>../Registro/guardar" method="post" id="form_in" enctype="multipart/form-data">
        <input class="form-control input-lg" name="proyecto" placeholder="Nombre de Proyecto" required="required" autofocus="autofocus"/>
        <p></p>
        <input class="form-control input-lg" name="solicitante" placeholder="Nombre del solicitante" required="required" autofocus="autofocus"/>
        <p></p>
        <textarea class="form-control input-lg" rows="3" name="descripcion" placeholder="Descripción de la actividad" required="required"></textarea>
        <p></p>

        <div class="form-group">
            <label>Fecha y Hora (Inicio y Término de la actividad):</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    <i class="fa fa-clock-o"></i>
                </div>
                <input placeholder="Fecha y Hora" id="fecha_ing" type="text" class="form-control input-lg">
            </div>
            <input required="required" type="hidden" id="desde" name="desde" />
            <input required="required" type="hidden" id="hasta" name="hasta" />
        </div>

        <!-- /.input group -->
        <p></p>

        <div class="form-group">
            <div class="col-md-2 well">
                <label>Estado:</label>
                <select name="estado" required="required" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option selected="selected">Nuevo</option>
                    <option>En Proceso</option>
                    <option>Culminado</option>
                </select>
            </div>
        </div>

        <p></p>

        <div class="form-group">
            <div class="col-lg-12 margin-bottom">
                <div tabindex="500" class="btn btn-success btn-file">
                    <label class="control-label">Adjuntar Archivo</label>
                    <i class="glyphicon glyphicon-folder-open"></i> 

                    <input type="file" class="file" name="file_name" id="file_name">
                </div>
            </div>
        </div>

        <p></p>
        <div class="margin-bottom"></div>
        <div class="form-group">
            <div class="col-lg-12">
                <button class="btn btn-primary btn-lg" type="submit">Registrar</button>
                <div class="margin-bottom"></div>
            </div>
        </div>
    </form>
</div>