<?php

class Bienvenido extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('incidencia_model');
    }

    public function sendmail() {
        sendmail_prueba();
    }

    function incidencia($id = false) {
        $data['usuarios'] = $this->incidencia_model->get_usuarios();
        $data['tecnicos'] = $this->incidencia_model->get_tecnicos();
        $data['categorias'] = $this->incidencia_model->get_categorias();
        $data['estados'] = $this->incidencia_model->get_estados();
        if ($id) {
            $data['incidencias'] = $this->incidencia_model->get_incidencias($id);
        }
        layout_user('user/incidencia_user', $data, array('index'));
    }

    public function index() {
        $data = array('titulo' => 'Nueva Incidencia',
            'subtitulo' => 'Ingrese los datos requeridos',
            'categorias' => $this->incidencia_model->get_categorias(),
            'fields' => $this->incidencia_model->get_columns_incidencia(),
        );
        layout_user('user/incidencia', $data);
    }

    public function incidencias() {
        $data['incidencias'] = $this->incidencia_model->get_incidencias_by_usuario($_SESSION['usuario'][0]['idusuario']);
        layout_user('user/mis_incidencias', $data, array('index'));
    }

    protected function upload_file() {
        $config['upload_path'] = 'application/uploads/';
        $config['allowed_types'] = 'xlsx|xls';
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

    public function nueva_incidencia() {
        if (isset($_FILES)) {
            $data = $this->upload_file();
        }

        $array_data = $_POST;
        $array_data['archivos'] = $data['upload_data']['file_name'];
        $array_data['idusuario'] = $_SESSION['usuario'][0]['idusuario'];
        $idtecnico = $this->incidencia_model->get_categoria_tecnico($_POST['idcategoria']);
        $disponibilidad = $this->incidencia_model->disponibilidad_tecnico($idtecnico[0]['tecnico_idusuario']);
        $idtecnico_libre = $this->incidencia_model->tecnicos_libres();
        if (count($disponibilidad) > 0) {
            if ((count($idtecnico_libre) > 0)) {
                $array_data['tecnico_idusuario'] = $idtecnico_libre[0]['idusuario'];
            } else {
                $array_data['tecnico_idusuario'] = $idtecnico[0]['tecnico_idusuario'];
            }
        } else {
            $array_data['tecnico_idusuario'] = $idtecnico[0]['tecnico_idusuario'];
        }

        $array_data['idestado_incidencia'] = 1;
        $array_data['fecha_inicio'] = date('Y-m-d h:i:s');
        $id_incidencia = $this->incidencia_model->nueva_incidencia($array_data);
        debug($id_incidencia);
        $incidencia_detalle = $this->incidencia_model->get_incidencias($id_incidencia);
        $email_tecnico = $this->incidencia_model->get_email_tecnico($incidencia_detalle[0]['tecnico_idusuario']);
//        debug(sendmail_tecnico($incidencia_detalle, 1, $email_tecnico[0]['email']));
        phpmailer($incidencia_detalle, 1, $email_tecnico[0]['email']);


        //bitacora
        $array_bitacora['idvia'] = 1;
        $array_bitacora['idincidencia'] = $id_incidencia;
        $array_bitacora['idestado_incidencia'] = $incidencia_detalle[0]['idestado_incidencia'];
        $array_bitacora['fecha_cambio_estado'] = date('Y-m-d h:i:s');
        $this->incidencia_model->insert_bitacora($array_bitacora);
        redirect('Bienvenido/incidencias');
//        debug($incidencia_detalle);
//        debug($disponibilidad);
    }

    function correo() {
        phpmailer();
    }

}
