<?php
!isset($_SESSION['usuario']) ? redirect('Login') : '';
if (isset($_SESSION['usuario'])) {
    $sesion = $_SESSION['usuario'][0];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Servicios de Informática - SSI</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Own -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/styles.css"/>
        <!-- Bootstrap 3.3.4 -->
        <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/datatable/datatables.min.css"/>
        <?php
        if (isset($css)) {
            foreach ($css as $row => $value) {
                echo $value;
            }
        }
        ?>
        <style>

            .custom-combobox {
                position: relative;
                display: inline-block;
            }
            .custom-combobox-toggle {
                position: absolute;
                top: 0;
                bottom: 0;
                margin-left: -1px;
                padding: 0;
            }
            .custom-combobox-input {
                margin: 0;
                padding: 5px 10px;
            }
        </style>
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="skin-blue layout-top-nav">
        <div class="wrapper">
            <div class="navbar-header nofloatl">
                <a href="" class="navbar-brand link_ssi"><b>Sistema de Servicios de Información</b> - <strong>SSI</strong></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <header class="main-header">     

                <nav class="navbar navbar-static-top">
                    <div class="container">


                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="active n_01"><a href="<?php echo base_url() ?>Bienvenido">Ingresar Atención <span class="sr-only">(current)</span></a></li>
                                <li class="n_02"><a href="<?php echo base_url() ?>Bienvenido/incidencias">Mis Atenciones</a></li>

                            </ul>                          
                        </div><!-- /.navbar-collapse -->
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- Messages: style can be found in dropdown.less-->


                                <!-- Notifications Menu -->

                                <!-- User Account Menu -->
                                <li class="dropdown user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <!-- The user image in the navbar-->

                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        <span class="hidden-xs"><?php echo $_SESSION['usuario'][0]['nombre_completo'] ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- The user image in the menu -->
                                        <li class="user-header">

                                            <p>
                                                <?php echo $_SESSION['usuario'][0]['nombre_completo'] ?>

                                            </p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <!--                                            <div class="pull-left">
                                                                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                                                                        </div>-->
                                            <div class="pull-right">
                                                <a href="<?php echo base_url() ?>/Login/log_out" class="btn btn-default btn-flat">Cerrar Sesion</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- /.navbar-custom-menu -->
                    </div><!-- /.container-fluid -->
                </nav>
            </header>
            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">
                    <!-- Content Header (Page header) -->
                    <section class="container">
                        <p></p>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="box-title panel-title">
                                    <h3 class="tit_inci">
                                        <?php isset($titulo) ? print $titulo : ''; ?> </h3>&nbsp;
                                    <h4 class="titsub_inci">  / CLASIFICACIÓN</h4>

                                </div>
                            </div>
                        </div>

                    </section>


