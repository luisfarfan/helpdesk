<?php //  debug($estados); ?>
<section class="content">
    <form action="" method="POST">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    Por Rango de Fecha
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Por rango de Fecha:</label>
                        <input type="hidden" value="<?php isset($_POST['from']) ? print $_POST['from'] : '' ?>" name="from" id="from">
                        <input type="hidden" name="to" value="<?php isset($_POST['to']) ? print $_POST['to'] : '' ?>" id="to">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="range" value="<?php isset($_POST['range']) ? print $_POST['range'] : '' ?>" class="form-control pull-right" id="date_range"/>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    Por Estado de Incidencia
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Seleccione :</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>

                            <select name="estado" id="estado" class="form-control">
                                <option>General</option>
                                <?php
                                foreach ($estados as $row => $value) {
                                    if ($_POST['estado'] == $value['value']) {
                                        echo '<option selected value=' . $value['value'] . '>' . $value['texto'] . '</option>';
                                    } else {
                                        echo '<option value=' . $value['value'] . '>' . $value['texto'] . '</option>';
                                    }
                                }
                                ?>
                            </select>

                        </div><!-- /.input group -->

                    </div><!-- /.form group -->
                </div>
                <div class="box-footer">
                    <button>Submit</button>
                </div>
            </div>
        </div>

    </form>
    <div>
        <div id="container">
        </div>
    </div>

</section>