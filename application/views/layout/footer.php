<!-- Modal -->
<div id="modal_change" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
<!--        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <h4 class="modal-title"><strong>Cambie su contraseña:</strong></h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo base_url() ?>index.php/Login/edit_login" method="post">
              <div class="form-group">
                  <input class="form-control input-lg" placeholder="Ingrese su nueva clave" name="clave" id="clave" type="password">
              </div>
              <div class="form-group">
                  <input class="form-control input-lg" placeholder="Ingrese nuevamente su nueva clave" id="clave2" type="password" onkeyup="checkclave(); return false;">
              </div>
              <div class="form-group margin-bottom">
              <span id="confirm" class="confirmMessage"></span>
              </div>
              
        <button type="submit" class="btn btn-success btn-lg" id="btn_cambiar">Cambiar</button>  
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Más tarde</button>
          </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>

  </div>
</div>
<!-- Modal -->
</div><!-- /.content-wrapper -->

<footer class="main-footer">

    <strong>Copyright &copy; 2015 <a>OTIN</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->      
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->
</body>
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript">< /script
<!-- SlimScroll -->
            < script src = "<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type = "text/javascript" ></script>
<!-- Select 2 -->
<script src="<?php echo base_url() ?>assets/js/select2.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.min.js"></script>
<!-- Date -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/daterangepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/app.min.js" type="text/javascript"></script>
<!-- Demo -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/my_js/index.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-table.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/bootstrap-table-master/dist/extensions/export/bootstrap-table-export.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.battatech.excelexport.js" type="text/javascript"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#btn_cambiar").attr('disabled', 'disabled');
        $('#vista').DataTable({
            "order": [[4, "desc"]],
//            scrollY: '60vh',
//            scrollCollapse: true,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontró - sorry",
                "info": "Visualizando páginas _PAGE_ of _PAGES_",
                "infoEmpty": "No hay registros",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Inicio",
                    "last": "Final",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            }
        });

    });
</script>
<script>

    $(function () {
        //Date range picker
//        $('#fecha_ing').daterangepicker();
        $('#fecha_ing').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD h:mm'});
        $('#fecha_ing').on('apply.daterangepicker', function (ev, picker) {
            $('#desde').val((picker.startDate.format('YYYY-MM-DD h:mm')));
            $('#hasta').val((picker.endDate.format('YYYY-MM-DD h:mm')));
        });

    });

    function abrir(id) {
        $.ajax({
            url: '<?php echo base_url() ?>index.php/Registro/descripcion/' + id,
            success: function (data, textStatus, jqXHR) {
                $('#descripcion').html(data)
            }
        })
    }

    function abriredit(id) {
        $.ajax({
            url: '<?php echo base_url() ?>index.php/Registro/formulario/' + id,
            success: function (data, textStatus, jqXHR) {
                $('#formulario').html(data)
            }
        })

    }

    $("#btnExport").click(function () {
        $('#th_descripcion').show();
        $('td[name=descripcion]').show();
        $('#th_descripcion2').hide();
        $('td[name=descripcion2]').hide();
        $("#vista").battatech_excelexport({
            containerid: "vista",
            datatype: 'table'
        });
        $('#th_descripcion').hide();
        $('td[name=descripcion]').hide();
        $('#th_descripcion2').show();
        $('td[name=descripcion2]').show();
    });



    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Por responsable y fechas'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'N° de actividades'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
//            pointFormat: 'Cantidad: <b> cantidad </b>'
            },
            series: [{
                    name: 'Cantidad',
                    data: [
<?php
if (isset($reporte_one)) {
    foreach (json_decode($reporte_one, true) as $row => $value) {
        echo '["' . $value['nombre_completo'] . '",' . (int) $value['cantidad'] . '],';
    }
}
?>
                    ],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
        });
    });


    $('#date_range').daterangepicker();

    $('#date_range').on('apply.daterangepicker', function (ev, picker) {
        $('#from').val((picker.startDate.format('YYYY-MM-DD')));
        $('#to').val((picker.endDate.format('YYYY-MM-DD')));
    });


    function checkclave()
    {
        var clave = document.getElementById('clave');
        var clave2 = document.getElementById('clave2');
        var message = document.getElementById('confirm');
        var bad = "#ff6666";
        var good = "#66cc66";
        if (clave.value == clave2.value) {
            message.style.color = good;
            clave2.style.backgroundColor = good;
            message.innerHTML = "Las contraseñas coinciden!";
            $("#btn_cambiar").removeAttr('disabled')
        } else {
            message.style.color = bad;
            clave2.style.backgroundColor = bad;
            message.innerHTML = "Las contraseñas son distintas!";
            $("#btn_cambiar").attr('disabled', 'disabled')
        }
    }
</script>
</html>
