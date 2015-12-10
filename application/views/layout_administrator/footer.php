
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
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-modal.js" type="text/javascript"></script>
<!-- Demo -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-table.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/tableExport.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatable/datatables.js"></script>
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>assets/js/autocomplete_combobox.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script>
    base_url = '<?php echo base_url() ?>';
    $(function () {
        $('#table_cattec').DataTable();
        $.ajax({
            url: '<?php echo base_url() ?>Admin/get_incidencias',
            success: function (data, textStatus, jqXHR) {
                $('#nuevas_incidencias').text(data);
            }
        });





        // Reporte Tecnico
<?php if (isset($reporte_tecnico)) {
    ?>
            $('#containerfec').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Cantidad de Incidencias por Rango de Fecha : <?php isset($_POST['from']) ? print $_POST['from'] . ' a ' . $_POST['to'] : print 'Todos los tiempos' ?>'
                },
                subtitle: {
                    //                text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Incidencias por Tecnico'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> Incidencias<br/>'
                },
                series: [{
                        name: 'Categoria',
                        colorByPoint: true,
                        data: <?php isset($reporte_tecnico) ? print $reporte_tecnico : '' ?>
                    }],
            });
<?php }
?>


<?php if (isset($reporte)) {
    ?>
            $('#reporte_cate').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Cantidad de Incidencias por Rango de Fecha : <?php isset($_POST['from']) ? print $_POST['from'] . ' a ' . $_POST['to'] : print 'Todos los tiempos' ?>'
                },
                subtitle: {
                    //                text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Incidencias por Categoria'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> Incidencias<br/>'
                },
                series: [{
                        name: 'Categoria',
                        colorByPoint: true,
                        data: <?php isset($reporte) ? print $reporte : '' ?>
                    }],
            });
    <?php
}

if (isset($reporte_encuesta)) {
    ?>

            $('#reporte_encuesta').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: '<?php echo $titulo_encuesta ?>'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                        name: "Brands",
                        colorByPoint: true,
                        data: <?php isset($reporte_encuesta) ? print $reporte_encuesta : '' ?>
                    }]
            });

            $('#reporte_encuesta2').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: '<?php echo $titulo_encuesta2 ?>'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                        name: "Brands",
                        colorByPoint: true,
                        data: <?php isset($reporte_encuesta2) ? print $reporte_encuesta2 : '' ?>
                    }]
            });

    <?php
}
?>

<?php if (isset($reporte_usuario)) {
    ?>
            $('#container_usuario').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Cantidad de Incidencias por Rango de Fecha : <?php isset($_POST['from']) ? print $_POST['from'] . ' a ' . $_POST['to'] : print 'Todos los tiempos' ?>'
                },
                subtitle: {
                    //                text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Incidencias por Tecnico'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> Incidencias<br/>'
                },
                series: [{
                        name: 'Categoria',
                        colorByPoint: true,
                        data: <?php isset($reporte_usuario) ? print $reporte_usuario : '' ?>
                    }],
            });
<?php }
?>

    })
</script>




<script>
//$(function() {
//    $("#tecnicos").combobox(); //Let the fun begin ;)
//});

    function editartec(id) {
        $('#idcategoria').val(id)
    }
</script>
<?php
if (isset($js)) {
    foreach ($js as $row => $value) {
        echo $value;
    }
}
?>
</html>