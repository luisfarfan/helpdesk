<?php

class Categorias extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('categorias_model');
        $this->load->model('tecnicos_model');
        $this->load->model('reportes_model');
    }

    function categorias() {
        $data['categoria'] = $this->categorias_model->get_cat();
        $data['usuarios'] = $this->tecnicos_model->get_tecs();
        layout('administrator/categorias', $data, array('categoria'));
    }

    public function editar_categoria() {
        $id_tec = $_POST['idcategoria'];
        unset($_POST['idcategoria']);
        $this->categorias_model->editar_tec($id_tec, $_POST);
        redirect(base_url() . 'Categorias/categorias');
//        debug($_POST);
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
            $data['reporte'] = json_encode($this->reportes_model->reporte_categoria($array), JSON_NUMERIC_CHECK);
        } else {
            $data['reporte'] = json_encode($this->reportes_model->reporte_categoria(), JSON_NUMERIC_CHECK);
        }

        layout('administrator/reporte_cate', $data, array('reporte_cate'));
    }

    public function insert_incidencia() {
        $data = $_POST;
        $data['estado'] = 1;
        $this->categorias_model->insertar_categoria($data);
        redirect('Categorias/categorias');
    }

    public function get_by_id($id) {
        $data['tecnicos'] = $this->tecnicos_model->get_tecs();
        $data['categoria'] = $this->categorias_model->get_cat($id);
        $this->load->view('administrator/editar_categoria', $data);
    }

}

?>