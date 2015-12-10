<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios
 *
 * @author LFarfan
 */
class Usuarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('reportes_model');
        $this->load->model('tecnicos_model');
    }

    public function index() {
        $data['estados'] = array(array('value' => 1, 'texto' => 'NUEVO'),
            array('value' => 2, 'texto' => 'REASIGNADO'),
            array('value' => 3, 'texto' => 'ESPERA DE CONFORMIDAD'),
            array('value' => 4, 'texto' => 'CERRADA'));
        $data['tecnicos'] = $this->tecnicos_model->get_tecs();

        if (isset($_POST['from']) && $_POST['from'] != '') {
//            $start = substr($_POST['range'], 0, 10);
//            $to = substr($_POST['range'], 13, 10);

            $array['start'] = $_POST['from'];
            $array['to'] = $_POST['to'];
            if ($_POST['estado'] == 'General') {
                
            } else {
                $array['estado'] = $_POST['estado'];
            }
            $data['reporte_usuario'] = json_encode($this->reportes_model->reporte_usuarios($array), JSON_NUMERIC_CHECK);
        } else {
            $data['reporte_usuario'] = json_encode($this->reportes_model->reporte_usuarios(), JSON_NUMERIC_CHECK);
        }

        layout('administrator/reporte_usuario', $data, array('reporte_cate'));
    }

}
