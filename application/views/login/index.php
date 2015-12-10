<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Servicios Informáticos</title>

        <!-- CSS de Bootstrap -->
        <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url() ?>assets/css/styles.css" rel="stylesheet" media="screen">

        <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="background-color: #ecf0f5">
        <p></p>
            <div class="container text-center ">
                <a href="../" class="text-center"><img class="text-center" src="<?php echo base_url() ?>assets/img/logo.png" ></a>
            </div>
        <p></p><p><br></p>
        <div class="container">
            <div class="container-fluid col-md-6 col-md-offset-3 well">

                <?php echo form_open('Login/validar_login', array('method' => 'POST', 'class' => 'form-signin', 'id' => 'form_login')) ?>
                <p><br></p>
                <h4 class="form-signin-heading text-center"><strong>SISTEMA DE SERVICIOS DE INFORMÁTICA</strong></h4>
                <p><br></p>
                <label for="inputEmail" class="sr-only">Ingrese su usuario</label>

                <?php echo form_input(array('id' => 'username', 'name' => 'username', 'class' => 'form-control', 'placeholder' => 'Ingrese Usuario', 'required' => 'required', 'autofocus' => 'autofocus')) ?>
                <p></p>
                <label for="inputPassword" class="sr-only">Ingrese su Clave</label>
                <?php echo form_password(array('id' => 'clave', 'name' => 'clave', 'class' => 'form-control', 'placeholder' => 'Contraseña', 'required' => 'required')) ?>
                <p>&nbsp</p>
                <div class="form-group">
                    <button type="submit" id="validar" class="btn btn-lg btn-primary btn-block" type="button">Ingresar</button>   
                </div>
            </div> 
        </div>
        <!-- /container -->
        <div class="space_50"></div>
        <div class="container">
            <footer class="text-center">
                <div class="footer-below">
                    <div class="row">Copyright © 2015 OTIN. All rights reserved.</div>
                </div>

            </footer>
        </div>
        <!-- Librería jQuery requerida por los plugins de JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>

        <!-- Todos los plugins JavaScript de Bootstrap (también puedes
             incluir archivos JavaScript individuales de los únicos
             plugins que utilices) -->
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>

    </body>
</html>
<?php
isset($js) ? setJs(__DIR__, $js) : ''
?>
