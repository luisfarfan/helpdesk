<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Encuesta</title>
        <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#page-top"><img src="<?php echo base_url() ?>assets/img/logo.png" ></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                </div>
            </div>
        </nav> 
        <div class="container">
            <div class="jumbotron inei_jumbotron">
                <h2 class="text-center"> ENCUESTA DE SATISFACCIÓN DE USUARIOS </h2>
            </div>
            <form method="POST" action="<?php echo base_url() ?>Encuesta/send">
                <input name="idincidencia" hidden value="<?php echo $nro ?>">
                <div class="container">
                    <?php
                    $group = array();
                    $count = 0;
                    foreach ($preguntas_opciones as $key) {
                        $group[$key['encuesta_pregunta']][] = $key;
                    }
//                echo '<pre>';
//                var_dump($group);
//                echo '</pre>';
                    foreach ($group as $key => $values) {
                        $count++;
                        ?>
                        <div class="inei_blue">&nbsp;</div>
                        <div class="inei_questions"><strong> <?php echo $count . '.' ?></strong><?php echo $key ?></div>
                        <section id="buttons_1">
                            <div>
                                <?php
                                foreach ($values as $row => $valor) {
                                    ?>
                                    <strong class="left"><?php echo $valor['opcion'] ?></strong>
                                    <input name="respuesta<?php echo $count ?>" value="<?php echo $valor['idencuesta_opciones'] ?>" type="radio">
                                    <?php
                                }
                                ?>
                            </div></section>

                    <?php }
                    ?>
                    <section>
                        <div>
                            <button type="submit" class="btn btn-big-blue">Enviar encuesta</button>
                        </div>
                    </section>          
                </div>
            </form>
            <footer class="text-center">
                <div class="footer-below">
                    <div class="container"><div class="row">Av. Gral. Garzón 654 - 658, Jesús María Lima-Perú</div></div>
                </div>
            </footer>
        </div>
        <script src="http://code.jquery.com/jquery.js"></script>

        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    </body>
</html>
