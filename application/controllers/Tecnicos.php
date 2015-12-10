<?php

class Tecnicos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('tecnicos_model');
        $this->load->model('incidencia_model');
        $this->load->model('reportes_model');
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
            if ($_POST['estado'] != 'General') {
                $array['estado'] = $_POST['estado'];
            }
            $data['reporte_tecnico'] = json_encode($this->reportes_model->reporte_tecnico($array), JSON_NUMERIC_CHECK);
        } else {
            $data['reporte_tecnico'] = json_encode($this->reportes_model->reporte_tecnico(), JSON_NUMERIC_CHECK);
        }

        layout('administrator/reporte_tecs', $data, array('reporte_cate'));
    }

    public function tecnicos() {
        $data['tecnicos'] = $this->tecnicos_model->get_tecs();
        $data['usuarios'] = $this->tecnicos_model->get_usuarios();
        layout('administrator/tecnicos', $data, array('tecnicos'));
    }

    public function asignar() {
        $data2 = $_POST;
        $data2['tecnico_idusuario'];
        $data2['idrol_tecnico'] = 2;
        $data2['fecha_registro_tecnico'] = date('Y-m-d h:i:s');
        $this->tecnicos_model->asignar_tecs($data2);
        redirect('Tecnicos/tecnicos');
    }

    public function eliminar_tecs($data) {
        $this->tecnicos_model->eliminar_tecs($data);
        redirect('Tecnicos/tecnicos');
    }

    public function save() {
        $data = $_POST;
        $data['fecha_registro'] = date('Y-m-d h:i:s');
        $data['iddepartamento'] = 6132;
        $data['clave'] = md5($data['clave']);
        $id = $this->tecnicos_model->save($data);

        unset($data['fecha_registro']);
        unset($data['iddepartamento']);
        $data2['idusuario'] = $id;
        $data2['fecha_registro_tecnico'] = date('Y-m-d h:i:s');
        $data2['idrol_tecnico'] = 2;
        $this->tecnicos_model->save_tecnico($data2);
        redirect('Tecnicos/tecnicos');
    }

    public function incidencias_tecnicos($idusuario) {
        header('Content-Type: application/json');
        $resultado = $this->tecnicos_model->new_incidencias_tec($idusuario);
        echo json_encode($resultado);
    }

    public function insert_incidencia($id) {
        $res = $this->tecnicos_model->insertar_incidencias($id);
    }

}

?>
