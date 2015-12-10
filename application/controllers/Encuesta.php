<?php

class Encuesta extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('encuesta_model');
    }

    public function encuesta($id) {
        $data['preguntas_opciones'] = $this->encuesta_model->get_opciones();
        $data['nro'] = $id;
        $this->load->view('encuesta/encuesta', $data);
    }

    public function encuesta_reporte() {

        $reporte_encuesta = $this->encuesta_model->reporte_encuesta(1);
        $json = json_encode($reporte_encuesta['reporte'], JSON_NUMERIC_CHECK);
        $data['reporte_encuesta'] = $json;
        $data['titulo_encuesta'] = $reporte_encuesta['titulo'][0]['encuesta_pregunta'];

        $reporte_encuesta2 = $this->encuesta_model->reporte_encuesta(3);
        $json2 = json_encode($reporte_encuesta2['reporte'], JSON_NUMERIC_CHECK);
        $data['reporte_encuesta2'] = $json2;
        $data['titulo_encuesta2'] = $reporte_encuesta2['titulo'][0]['encuesta_pregunta'];

        layout('administrator/reporte_encuesta', $data);
    }

    public function mantenimiento() {
        $data['pregunta'] = $this->encuesta_model->get_encuesta();
        $data['opcion'] = $this->encuesta_model->get_opciones();
        layout('administrator/mante_encuesta', $data);
    }

    public function build_encuesta() {
        $this->encuesta_model->ingresar_opcion($_POST);
        redirect('Encuesta/mantenimiento');
    }

    public function send() {
        $values = array();
        $ticket = $_POST['idincidencia'];
        unset($_POST['idincidencia']);
        $i = 0;
        foreach ($_POST as $key => $valor) {
            $i++;
            $values[$i]['idincidencia'] = $ticket;
            $values[$i]['respuesta'] = $_POST[$key];
        }
        $this->encuesta_model->send_data($values);
        $this->encuesta_model->close_ticket($ticket);
//        debug($values);
        $this->load->view('errors/html/success');
    }

}

?>