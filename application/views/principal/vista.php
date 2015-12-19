<section class="content">
    <button id="btnExport" class="btn btn-success btn-lg">Exportar .xls</button>
    <div class="margin"></div>
    <div class="box">
        <div class="box-body">
            <table id="vista" class="display" cellspacing="0" width="100%">
                <thead>
                        <th>Proyecto</th>
                        <th>Responsable</th>
                        <th>Solicitante</th>
                        <th id="th_descripcion" style="display: none">Descripción</th>
                        <th id="th_descripcion2">Descripción</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Término</th>
                        <th>Estado</th>
                        <th>Adjunto</th>
                        <th> </th>
                </thead>
                <tbody>
                    <?php
                    foreach ($resultado as $row => $value) {
                        echo '<tr>';
                        echo '<td>' . $value['proyecto'] . '</td>';
                        echo '<td>' . $value['nombre_completo'] . '</td>';
                        echo '<td>' . $value['solicitante'] . '</td>';
                        echo '<td name="descripcion" style="display: none">' . $value['descripcion'] . '</td>';
                        echo '<td name="descripcion2"><a class="center-block btn text-center" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="abrir(' . $value['iddetalle'] . ');"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>';
                        echo '<td style="width:80px">' . date( 'd-m-Y H:i', strtotime($value['desde']) ) . '</td>';
                        echo '<td style="width:80px">' . date( 'd-m-Y H:i', strtotime($value['hasta']) ) . '</td>';
                        echo '<td>' . $value['estado'] . '</td>';
                        if ($value['file_name'] == "") {
                            echo '<td> </td>';
                        } else {
                            echo '<td><a class="center-block center text-center" href="' . base_url() . 'application/uploads/' . $value['file_name'] . '"><span class="glyphicon glyphicon-paperclip center"></span></a></td>';
                        }
                        echo '<td><a class="center-block btn text-center" data-toggle="modal" data-target="#myModal" onclick="abriredit(' . $value['iddetalle'] . ');"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <!-- Modal -->
            <div class = "modal fade bs-example-modal-lg" tabindex = "-1" role = "dialog" aria-labelledby = "myLargeModalLabel">
                <div class = "modal-dialog modal-lg">
                    <div class="modal-content modal_content"> 
                        <div class="modal-header modal_headerr"> 
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button> 
                            <h4 class="modal-title" id="myLargeModalLabel"><strong>Descripción de la actividad</strong></h4> 
                        </div> 
                        <div id="descripcion" class="modal-body">  </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal_content">
                        <div class="modal-header modal_headerr">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><strong>Edición de actividad</strong></h4>
                        </div>
                        <div class="modal-body" id="formulario">

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</section>