<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('incidencia_model');
        $this->load->model('reportes_model');
        $this->load->model('bitacora_model');
    }

    public function index() {
        $data['categoria_reporte'] = $this->reportes_model->reporte_categoria();
        layout('administrator/index', $data);
    }

    public function get_reporte_categoria() {
        
    }

    public function incidencias_all() {
        $istecnico = $this->incidencia_model->is_tecnico($_SESSION['usuario'][0]['idusuario']);
//        debug($istecnico);
        if (count($istecnico) > 0) {
            if ($istecnico[0]['idrol_tecnico'] == '1') {
                $data['incidencias'] = $this->incidencia_model->get_incidencias();
            } else {
                $data['incidencias'] = $this->incidencia_model->get_incidencia_by_tecnico($_SESSION['usuario'][0]['idusuario']);
            }
        }

        layout('administrator/incidencias', $data, array('index'));
    }

    function get_incidencias() {
        $cantidad = count($this->incidencia_model->get_incidencias_by_fecha());
        echo $cantidad;
    }

    function get_bitacora($id) {
        $data['bitacora'] = $this->bitacora_model->get_bitacora($id);
        $this->load->view('administrator/bitacora_incidencia', $data);
    }

    protected function upload_file() {
        $config['upload_path'] = 'application/uploads/';
//        $config['allowed_types'] = 'xlsx|xls';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $data['upload_data'] = '';
        if (!$this->upload->do_upload('userfile')) {
            $data = array('msg' => $this->upload->display_errors());
        } else {
            $data = array('msg' => "Upload success!");
            $data['upload_data'] = $this->upload->data();
        }
        return $data;
    }

    function prueba() {
        $incidencia = $this->incidencia_model->get_incidencias(80);
        debug($incidencia);
    }

    function save() {
        $array_data = $_POST;
        if (isset($array_data['idincidencia'])) {
            //Obtengo el detalla de la incidencia antes de guardar
            $incidencia = $this->incidencia_model->get_incidencias($array_data['idincidencia']);
            //Guardo la incidencia
            $this->incidencia_model->nueva_incidencia($array_data);
            //Obtengo el detalle de la incidencia, con los nuevos datos guardados.
            $email = $this->incidencia_model->get_incidencias($array_data['idincidencia']);

            if ($email[0]['idestado_incidencia'] !== $incidencia[0]['idestado_incidencia']) {
                $array_bitacora['idvia'] = 1;
                $array_bitacora['idincidencia'] = $array_data['idincidencia'];
                $array_bitacora['idestado_incidencia'] = $email[0]['idestado_incidencia'];
                $array_bitacora['fecha_cambio_estado'] = date('Y-m-d h:i:s');
                if ($email[0]['idestado_incidencia'] == 2) {

                    $array_bitacora['tecnico_idusuario'] = $email[0]['tecnico_idusuario'];
                    $bitacora = $this->incidencia_model->insert_bitacora($array_bitacora);
                } else {
                    $bitacora = $this->incidencia_model->insert_bitacora($array_bitacora);
                }
            }

            if ($email[0]['idestado_incidencia'] == '3') {
                phpmailer($email, 3);
            } elseif ($email[0]['idestado_incidencia'] == '2') {
                $email_tecnico = $this->incidencia_model->get_email_tecnico($email[0]['tecnico_idusuario']);
                phpmailer($email, 2,$email_tecnico);
            }
        } else {
            if (isset($_FILES['userfile'])) {
                $data = $this->upload_file();
                $array_data['archivos'] = $data['upload_data']['file_name'];
            }

            $id_incidencia = $this->incidencia_model->nueva_incidencia($array_data);
            $email = $this->incidencia_model->get_incidencias($id_incidencia);
            $array_bitacora['idvia'] = 1;
            $array_bitacora['idincidencia'] = $id_incidencia;
            $array_bitacora['idestado_incidencia'] = $email[0]['idestado_incidencia'];
            $array_bitacora['fecha_cambio_estado'] = date('Y-m-d h:i:s');
            $bitacora = $this->incidencia_model->insert_bitacora($array_bitacora);
            phpmailer($email, 1);
        }
//        debug($id_incidencia);
//        debug($array_bitacora);
        redirect('Admin/incidencias_all');
//        debug($_POST);
    }

    public function incidencia($id = false) {
        $data['usuarios'] = $this->incidencia_model->get_usuarios();
        $data['tecnicos'] = $this->incidencia_model->get_tecnicos();
        $data['categorias'] = $this->incidencia_model->get_categorias();
        $data['estados'] = $this->incidencia_model->get_estados();
        if ($id) {
            $data['incidencias'] = $this->incidencia_model->get_incidencias($id);
        }
        layout('administrator/incidencia_user', $data, array('index'));
    }

    function disponiblidad() {
        debug($this->incidencia_model->disponibilidad_tecnico(10));
    }

}
