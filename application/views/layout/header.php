<?php
if (isset($_SESSION['login'])) {
    
} else {
    redirect('Login');
}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Admin ACTIVIDADES</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url() ?>assets/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/css/styles.css" rel="stylesheet" media="screen">
        <!-- Select2 style -->
        <link href="<?php echo base_url() ?>assets/css/daterange.css" rel="stylesheet" media="screen">
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="../Registro/load_registro" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><strong>Admin</strong>ACTIVIDADES</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><strong>Admin</strong>ACTIVIDADES</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
                    <div> 
                    </div>
                    <div class="navbar-custom-menu">
                        <div class="logout">
                            <div class="navbar-custom-menu">
                                <ul class="nav navbar-nav">
                                    <li class="text-green margin"><strong><?php echo $_SESSION['login'][0]['nombre_completo'] ?></strong></li>
                                    <li><div><a class="btn btn-sm btn-block btn-danger" href="<?php echo base_url() ?>/index.php/Login/log_out">Cerrar Sesión</a></div></li>
                                </ul>
                            </div>
                        </div>
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <!-- Notifications: style can be found in dropdown.less -->
                            <!-- Tasks: style can be found in dropdown.less -->
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->


                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li><a class="hov_menu" href="<?php base_url() ?>../Registro/load_registro"><i class="fa fa-circle-o text-red"></i> <span>Registro de Actividades</span></a></li>
                        <li class="treeview hov_menu_li">
                            <a href="#" class="hov_menu">
                                <i class="fa fa-circle-o text-red"></i> <span>Vistas</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu back_vistamas">
                                <li><a class="hov_menu linkmenu" href="<?php base_url() ?>../Registro/vista"><i class="fa fa-pie-chart"></i> <span>Vista General</span></a></li>
                                <?php
                                $p = $_SESSION['login'][0]['idrol'];
                                if ($p == 2) {
                                    
                                } else {
                                    echo '<li><a class="hov_menu linkmenu" href="' . base_url() . 'index.php/Registro/vista_mas"><i class="fa fa-pie-chart"></i> <span>Vista con filtros</span></a></li>';
                                }
                                ?>

                            </ul>    
                        </li>
                        <li>
                            <a class="hov_menu cursor_menu" data-toggle="modal" data-target="#modal_change" data-backdrop="static" data-keyboard="false"><i class="fa fa-circle-o text-yellow"></i><span>Desea cambiar su contraseña?</span></a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->