<?php isset($_SESSION['usuario']['tecnico']) ? $tecnico = $_SESSION['usuario']['tecnico']['idrol_tecnico'] : ''; ?>
<ul class="sidebar-menu">
    <li class="n_01">
        <a href="<?php echo base_url() ?>Admin/incidencia">
            <i class="fa fa-dashboard"></i> <span>Nueva Atención</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url() ?>Admin/incidencias_all">
            <i class="fa fa-dashboard"></i> <span>Ver Atenciones</span>
        </a>

    </li>
    <?php
    if (isset($tecnico)) {
        if ($tecnico == 1) {
            ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Usuarios</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() ?>Usuarios"><i class="fa fa-circle-o"></i>Reportes</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Técnicos</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() ?>Tecnicos/tecnicos"><i class="fa fa-circle-o"></i>Mantenimiento</a></li>
                    <li><a href="<?php echo base_url() ?>Tecnicos"><i class="fa fa-circle-o"></i>Reportes</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Categorías</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() ?>Categorias/categorias"><i class="fa fa-circle-o"></i>Mantenimiento</a></li>
                    <li><a href="<?php echo base_url() ?>Categorias"><i class="fa fa-circle-o"></i>Estadísticas</a></li>
                </ul>
            </li>            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Encuesta</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() ?>Encuesta/mantenimiento"><i class="fa fa-circle-o"></i>Mantenimiento</a></li>
                    <li><a href="<?php echo base_url() ?>Encuesta/encuesta_reporte"><i class="fa fa-circle-o"></i>Estadísticas</a></li>
                    <!--<li><a href="http://webinei.inei.gob.pe/helpdesk/encuesta/index.php/Encuesta_necesidades/form/61"><i class="fa fa-circle-o"></i>Primera Encuesta</a></li>-->
                </ul>    
            </li>
            <?php
        } else {
            '';
        }
    }
    ?>



</ul>
</section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php
            isset($cabecera) ? print($cabecera) : '';
            ?>
            <small><?php isset($descripcion) ? print($descripcion) : ''; ?></small>
        </h1>
    </section>
