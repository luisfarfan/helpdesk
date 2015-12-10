<?php

class Transferencia extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('transferencia_model');
        $this->load->model('encuesta_model');
        $this->load->model('incidencia_model');
    }

    public function procesar_data() {
        $data = json_decode($_POST['data'], TRUE);
//        debug($data['data']);
        $data['idvia'] = 2;
        for ($i = 0; $i < count($data['data']); $i++) {
            $this->transferencia_model->save_data($data['data'][$i]);
            $array_bitacora['idvia'] = 2;
            $array_bitacora['idincidencia'] = $data['data'][$i]['idincidencia'];
            $array_bitacora['idestado_incidencia'] = 4;
            $array_bitacora['fecha_cambio_estado'] = date('Y-m-d h:i:s');
            $bitacora = $this->incidencia_model->insert_bitacora($array_bitacora);
        }
        $this->encuesta_model->send_data($data['encuesta']);
    }

    public function get_incidencias($id) {
        header('Content-Type: application/json');
        $data = $this->transferencia_model->get($id);
        echo json_encode($data);
    }

    public function get_tecnicos() {
        $data = $this->transferencia_model->get_tecnicos();
        echo json_encode($data);
    }

}
