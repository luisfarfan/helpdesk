<?php

class Acceso_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function validar_sesion($username, $clave) {
        $usuario = $this->db->get_where('usuario', array('username' => $username, 'clave' => md5($clave)))->result_Array();
        $tecnico = $this->db->get_where('tecnico', array('idusuario' => $usuario[0]['idusuario']))->result_Array();
        if (count($tecnico) > 0) {
            $usuario['tecnico'] = $tecnico[0];
        }
        return $usuario;
    }

    function get_categorias() {
        return $this->db->get('categoria')->result_Array();
    }

}
