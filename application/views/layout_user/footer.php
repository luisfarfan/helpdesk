</div>
</div>
<footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2015 <a href="#">OTIN</a>.</strong> Todos los derechos reservados.
    </div><!-- /.container -->
</footer>
</div><!-- ./wrapper -->

</body>
<script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/app.min.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/autocomplete_combobox.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatable/datatables.js"></script>
<?php
if (isset($js)) {
    foreach ($js as $row => $value) {
        echo $value;
    }
}
?>
<script type="text/javascript">
    $(function () {
        
        $("#categorias").combobox({
            select: function (event, ui) {
                $('#titulo').val($('#categorias :selected').text());

            }
        });
        $("#toggle").click(function () {
            $("#combobox").toggle();
        });
    });
</script>
</html>
