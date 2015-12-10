<?php

class Reportes_tecnicos extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('reportes_model');
    }
    
function reporte_tecs(){
    $data['reporte_fecha'] = $this->reportes_model->reporte_fechas();
    layout('administrator/reporte_tecs', $data);
}





}

?>