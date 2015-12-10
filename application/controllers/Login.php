<?php

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('acceso_model');
    }

    public function index() {
        $this->load->view('login/index');
    }

    public function validar_login() {
        $sesion = $this->acceso_model->validar_sesion($_POST['username'], $_POST['clave']);
        if (count($sesion) > 0) {
            $_SESSION['usuario'] = $sesion;
            if (count($sesion['tecnico']) > 0) {
                redirect('Admin');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Login');
        }
    }

    public function log_out() {
        session_destroy();
        redirect('Login');
    }

}
