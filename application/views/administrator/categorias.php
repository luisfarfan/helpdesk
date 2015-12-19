<div class="container">
    <section>
        <div class="well">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalCategoria" data-whatever="@getbootstrap">Agregar Categoría</button>
            <table id="table_cattec" class="table table-responsive">
                <thead style="background-color: #f3f2f2"> 
                <th style="border: 1px solid #ccc;background-color: #7BABC7; color: #fff">Categoría
                </th>
                <th style="border: 1px solid #ccc;background-color: #7BABC7; color: #fff">Nombre de Técnico
                </th>
                <th style="border: 1px solid #ccc;background-color: #7BABC7; color: #fff">Cambiar Técnico
                </th>
                <thead>
                <tbody>
                    <?php
                    foreach ($categoria as $row => $value) {
                        ?>  
                    <input type="hidden" value="<?php echo $value['idcategoria'] ?>" />
                    <tr>
                        <td style="border: 1px solid #e9e8e8;">
                            <?php echo $value['categoria_nombre'] ?>
                        </td>
                        <td style="border: 1px solid #e9e8e8;">
                            <?php echo $value['nombre_completo'] ?>
                        </td>
                        <td style="border: 1px solid #e9e8e8;">
                            <button class="demo btn btn-primary addlink  linkadd" onclick="ver_categoria(<?php echo $value['idcategoria'] ?>)" data-toggle="modal" data-target="#responsive">Cambiar</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</div>



<!-- Modal -->
<div class="modal fade" id="responsive" role="dialog">
    <div class="modal-dialog modal_sd">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title text-center">Cambio de Técnico</h2>
            </div>
            <div class="container-modal-us">
                <div class="modal-body">
                    <form class="form-horizontal nuevoform" action="editar_categoria" method="POST" name="">
                        <div id="edit_categoria">
                        </div>
                        <div class="modal-footer center-block">
                            <button type="button" data-dismiss="modal" class="btn-warning btn-lg">Cancelar</button>
                            <button type="submit" class="btn-info btn-lg">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="modalCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Agregar Categoría</h4>
            </div>
            <form action="<?php echo base_url() ?>Categorias/insert_incidencia" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Descripción Categoría</label>
                        <input type="text" class="form-control" name="categoria_nombre" id="nombre_completo">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Técnico Responsable</label>
                        <select id="tecnico_idusuario" name="tecnico_idusuario" class="form-control">
                            <option value="">Seleccione:</option>
                            <?php
                            foreach ($usuarios as $key => $value) {
                                echo '<option selected value=' . $value['idusuario'] . '>' . $value['nombre_completo'] . '</option>';
                            }
                            ?>     
                        </select>

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

