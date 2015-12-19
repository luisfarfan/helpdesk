<?php

class Registro extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('actividades_model');
    }

    public function layout($mid = false, $data = false) {
        $this->load->view('layout/header');
        $this->load->view($mid, $data);
        $this->load->view('layout/footer');
    }

    public function load_registro() {
        $this->layout('principal/index');
    }

    public function guardar() {
        $data1 = $this->upload_file();
        $data = $_POST;
        $data['file_name'] = $data1['upload_data']['file_name'];
        $data['idusuario'] = $_SESSION['login'][0]['idusuario'];
        $this->actividades_model->registrar($data);
        redirect('Registro/load_registro');
    }

    public function vista() {
        $p = $_SESSION['login'][0]['idrol'];
        if ($p == 2) {
            $data['resultado'] = $this->actividades_model->reporte($_SESSION['login'][0]['idusuario']);
        } else {
            $data['resultado'] = $this->actividades_model->reporte();
            $data['desde'] = $this->actividades_model->reporte();
        }
        $this->layout('principal/vista', $data);
    }

    public function vista_mas() {  
        $data['estados'] = array(array('value' => 'Nuevo', 'texto' => 'Nuevo'),
            array('value' => 'Culminado', 'texto' => 'Culminado'),
            array('value' => 'En Proceso', 'texto' => 'En Proceso'));

        if (isset($_POST['from']) && $_POST['from'] != '') {
            $array['start'] = $_POST['from'];
            $array['to'] = $_POST['to'];
            if ($_POST['estado'] != 'General') {
                $array['estado'] = $_POST['estado'];
            }
            $data['reporte_one'] = json_encode($this->actividades_model->reporte_one($array), JSON_NUMERIC_CHECK);
        } else {
            $data['reporte_one'] = json_encode($this->actividades_model->reporte_one(), JSON_NUMERIC_CHECK);
        }
        $this->layout('principal/vista_mas', $data);
    }
    
    protected function upload_file() {
        $config['upload_path'] = 'application/uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $data['upload_data'] = '';
        if (!$this->upload->do_upload('file_name')) {
            $data = array('msg' => $this->upload->display_errors());
        } else {
            $data = array('msg' => "Upload success!");
            $data['upload_data'] = $this->upload->data();
        }
        return $data;
    }

    public function edit() {
        $iddetalle = $_POST['iddetalle'];
        unset($_POST['iddetalle']);
        $this->actividades_model->editar($iddetalle, $_POST);
        redirect('registro/vista');
    }

    public function descripcion($id) {
        $data = $this->actividades_model->reporte(false, $id);
        $res = $data[0]['descripcion'];
        echo $res;
    }

    public function formulario($id) {
        $data['iddetalle'] = $id;
        $data['value'] = $this->actividades_model->reporte(false, $id);
        $data['estado_'] = array(array('value' => 'Nuevo', 'texto' => 'Nuevo'),
            array('value' => 'En proceso', 'texto' => 'En proceso'),
            array('value' => 'Culminado', 'texto' => 'Culminado'));
        $this->load->view('principal/form', $data);
    }

    public function delete($id) {
        $data['iddetalle'] = $id;
        $data['value'] = $this->actividades_model->eliminar($id);
        redirect('registro/vista');
    }

}

?>