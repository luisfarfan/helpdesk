<?php

if (!function_exists('debug')) {

    /**
     * @return Retorna un string parecido al var_dump,
     * con mejor formato visual.
     */
    function debug() {
        $trace = debug_backtrace();
        $rootPath = dirname(dirname(__FILE__));
        $file = str_replace($rootPath, '', $trace[0]['file']);
        $line = $trace[0]['line'];
        $var = $trace[0]['args'][0];
        $lineInfo = sprintf('<div><strong>%s</strong> (line <strong>%s</strong>)</div>', $file, $line);
        $debugInfo = sprintf('<pre>%s</pre>', print_r($var, true));
        print_r($lineInfo . $debugInfo);
    }

    /**
     * @return Devuelve un string de la cantidad de memoria usada,
     * evalua la cantidad y depende a esto, lo devuelve en bytes,kilobytes o megabytes.
     */
    function echo_memory_usage() {
        $mem_usage = memory_get_usage(true);
        if ($mem_usage < 1024)
            echo $mem_usage . " bytes";
        elseif ($mem_usage < 1048576)
            echo round($mem_usage / 1024, 2) . " kilobytes";
        else
            echo round($mem_usage / 1048576, 2) . " megabytes";
        echo "<br/>";
    }

    /**
     * @param $path es el directorio donde ha sido invocado la funcion.
     * 
     * @param $js es un array, la funcion lo recorre e imprime
     * la ruta del archivo javascript que deberia estar creado,
     * ademas, ya imprime con el formato <script></script>.
     */
    function setJs($vista, $js = array()) {
        $pos = strpos($vista, "/");
        $group = array();
        foreach ($js as $key => $value) {
//            echo '<script src="' . base_url() . 'application/views' . str_replace('\\', '/', substr($path, $pos)) . '/js/' . $js[$key] . '.js"></script>';
            array_push($group, '<script src="' . base_url() . 'application/views/' . substr($vista, 0, $pos) . '/js/' . $js[$key] . '.js"></script>');
//            echo '<script src="/'.$path.'.js"></script>';
        }
        return $group;
    }

    /**
     * @param $path es el directorio donde ha sido invocado la funcion.
     * 
     * @param $css es un array, la funcion lo recorre e imprime
     * la ruta del archivo de hoja de estilos que deberia estar creado,
     * ademas, ya imprime con el formato <link />.
     */
    function setCss($vista, $css = array()) {
        $pos = strpos($vista, "/");
        $group = array();
        foreach ($css as $key => $value) {
//            echo '<script src="' . base_url() . 'application/views' . str_replace('\\', '/', substr($path, $pos)) . '/js/' . $js[$key] . '.js"></script>';
            array_push($group, '<link href="' . base_url() . 'application/views/' . substr($vista, 0, $pos) . '/css/' . $css[$key] . '.css">');
//            array_push($group, $pos);
//            echo '<script src="/'.$path.'.js"></script>';
        }
        return $group;
    }

    /**
     * @return true, si la url Existe
     */
    function url_exist($url) {
        $http = get_headers($url);
        return ($http[0] == 'HTTP/1.1 200 OK');
    }

    /* @param $vista vista que sera renderizada
     * @param $datos datos que sera pasado como segundo parametro a la vista, que seran invocados en esta misma.
     * $return renderizar vista con el layout por defecto 
     * Esta funcion realiza la instancia a la clase controladora, donde sera invocada
     * y renderiza a la vista donde se indique
     */

    function layout($vista, $datos = false, $js = array(), $css = array()) {
        $CI = & get_instance();

        if ($datos) {
            $datos['js'] = setJs($vista, $js);
            $datos['css'] = setCss($vista, $css);
        }
        $CI->load->view('layout_administrator/header', $datos);
        $CI->load->view('layout_administrator/menu_lateral');
        $CI->load->view($vista);
        $CI->load->view('layout_administrator/footer');
    }

    function layout_user($vista = false, $datos = false, $js = array(), $css = array()) {
        $CI = & get_instance();

        if ($datos) {
            $datos['js'] = setJs($vista, $js);
            $datos['css'] = setCss($vista, $css);
        }
        $CI->load->view('layout_user/header', $datos);

        $vista ? $CI->load->view($vista) : '';
        $CI->load->view('layout_user/footer');
    }

    function renderizar_formulario($data = array()) {
        $keys = array_keys($data);
        echo form_open('Login/registro');
        foreach ($keys as $row => $value) {
            echo '<div class="form-group">';
            echo '<label class="col-sm-3 control-label">' . strtoupper($value) . '</label>';
            echo '<div class="col-sm-9">';
            echo form_input(array('name' => $value, 'class' => 'form-control'));
            echo '</div>';
            echo '</div>';
        }
    }

    /*
     * @return TRUE si envio, o detalle del ERROR.
     * @param $data array de los datos de la persona que sera enviada.
     */

    function sendmail($data = array()) {

        $CI = &get_instance();
        $CI->load->library('email');
        $CI->email->from('soporte@inei.gob.pe', 'Administrador Helpdesk');
        $CI->email->to($data['email']);
        $CI->email->subject('USUARIO Y CONTRASEÑA PARA SISTEMA SERVICIOS OTIN');
        $CI->email->message('Estimado: ' . $data['nombre_completo'] . ' Se adjunta su usuario y contraseña \n '
                . 'Usuario:' . $data['username'] . ' CONTRASEÑA: ' . $data['clave']);
        $CI->email->send();

        echo $CI->email->print_debugger();
    }

    function sendmail_prueba($data, $tipo) {
        $id = $data[0]['idincidencia'];
        $url = "http://192.168.221.123/helpdesk/Encuesta/encuesta/$id";
        $htmlheader = '<!DOCTYPE html>
<html>
    <head>
        <title>Mensajes</title>
    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #e4e4e2"><tbody><tr><td valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:10px solid #0155b8"><tbody><tr>
                                <td height="30" colspan="3" style="border-collapse:collapse;margin:0;padding:0;line-height:1px;font-size:1px">&nbsp;</td>
                            </tr>
                            <tr><td width="20" style="border-collapse:collapse;margin:0;padding:0;line-height:1px;font-size:1px">&nbsp;</td>
                                <td valign="top" align="right"><div><img src="https://upload.wikimedia.org/wikipedia/en/f/f4/INEI_logo.png" style="display:block" border="0" height="100" class="CToWUd"></div>
                                </td>
                                <td width="20" style="border-collapse:collapse;margin:0;padding:0;line-height:1px;font-size:1px">&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="30" colspan="3" style="border-collapse:collapse;margin:0;padding:0;line-height:1px;font-size:1px">&nbsp;</td>
                            </tr>
                        </tbody></table>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td width="40" style="border-collapse:collapse;margin:0;padding:0;line-height:1px;font-size:1px">&nbsp;</td>
                                <td valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;line-height:32px;color:#333e48"><div><span style="color:#0155b8"><span style="font-size:31.8181819915772px">Sistema de Servicios Informáticos</span></span>
                        </tbody></table>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
                                <td height="20" colspan="3" style="border-collapse:collapse;margin:0;padding:0;line-height:1px;font-size:1px">&nbsp;</td>
                            </tr>
                            <tr><td width="40" style="border-collapse:collapse;margin:0;padding:0;line-height:1px;font-size:1px">&nbsp;</td>
                                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#333e48"><tbody><tr><td style="padding:10px" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;line-height:20px;color:#333e48"><div><p>Gracias por enviar su solicitud:</p>';
        $nuevo = '<span style="color:#455560"><span style="font-size:18px"><b>DETALLES DE LA INCIDENCIA</b></span>
                                                            <p><b>Numero Ticket:</b>' . $data[0]['idincidencia'] . '</p>
                                                            <p><b>Usuario:</b>' . $data[0]['nombre_completo_usuario'] . '</p>
                                                            <p><b>Fech de Creación:</b> ' . $data[0]['fecha_inicio'] . '</p>
                                                            <p><b>Titulo:</b>' . $data[0]['categoria_nombre'] . '</p>
                                                            <span style="color:#455560"><span style="font-size:18px"><b>DESCRIPCION DE LA INCIDENCIA</b></span>
                                                                <p>' . $data[0]['descripcion_incidencia'] . '</p>
                                                                        <span style="color:#455560"><span style="font-size:18px"><b>TECNICO ASIGNADO</b></span>
                                                                            <p>' . $data[0]['nombre_completo_tecnico'] . '</p>';

        $solucion = '<a style="font-family:Arial,Helvetica,sans-serif;font-size:14px;line-height:32px;color:#333e48" href="' . $url . '"><span style="color:#455560"><span style="font-size:18px"><b>REALIZAR ENCUESTA DE SATISFACCION</b></span></a><br>
            <span style="color:#455560"><span style="font-size:18px"><b>DETALLES DE LA INCIDENCIA</b></span>
                                                            <p><b>Numero Ticket:</b>' . $data[0]['idincidencia'] . '</p>
                                                            <p><b>Usuario:</b>' . $data[0]['nombre_completo_usuario'] . '</p>
                                                            <p><b>Titulo:</b>' . $data[0]['categoria_nombre'] . '</p>
                                                            <p><b>Solucion:</b>' . $data[0]['solucion'] . '</p>
                                                            <p><b>Fecha de cierre:</b>' . $data[0]['fecha_cierre'] . '</p>
                                                            <span style="color:#455560"><span style="font-size:18px"><b>DESCRIPCION DE LA INCIDENCIA</b></span>
                                                                <p>' . $data[0]['descripcion_incidencia'] . '</p>
                                                                        <span style="color:#455560"><span style="font-size:18px"><b>TECNICO ASIGNADO</b></span>
                                                                            <p>' . $data[0]['nombre_completo_tecnico'] . '</p>';

        $reasignada = '<span style="color:#455560"><span style="font-size:18px"><b>SU INCIDENCIA A SIDO REASIGNADA A :</b></span>
                                                            <p><b>Reasignado a Tenico:</b>' . $data[0]['nombre_completo_tecnico'] . '</p>';
        $footer = ' </tbody></table></div></td></tr></tbody></table></html>';
        $CI = &get_instance();
        $CI->load->library('email');
        $CI->email->from('soporte@inei.gob.pe', 'Administrador Helpdesk');
        $CI->email->to($data[0]['email']);
        if ($tipo == 2) {
            $CI->email->subject('INCIDENCIA REASIGNADA N° ' . $data[0]['idincidencia']);
            $CI->email->message($htmlheader . $reasignada . $footer);
        } elseif ($tipo == 3) {

            $CI->email->subject('INCIDENCIA SOLUCIONADA N° ' . $data[0]['idincidencia']);
            $CI->email->message($htmlheader . $solucion . $footer);
        } else {
            $CI->email->subject('INCIDENCIA REGISTRADA N° ' . $data[0]['idincidencia']);
            $CI->email->message($htmlheader . $nuevo . $footer);
        }

        $CI->email->send();

        echo $CI->email->print_debugger();
    }

}