<?php

class Tecnicos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_usuarios() {
        return $this->db->query('SELECT * FROM `usuario` where idusuario not in (SELECT idusuario from tecnico) and iddepartamento in (6132,6130,6131) ORDER BY nombre_completo')->result_Array();
    }

    function get_tecs() {
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->join('tecnico', 'usuario.idusuario=tecnico.idusuario', 'inner');
        return $this->db->get()->result_Array();
    }

    function asignar_tecs($data) {
        $this->db->insert('tecnico', $data);
    }

    function eliminar_tecs($data) {
        $this->db->where('idusuario', $data);
        $this->db->delete('tecnico');
    }

    function new_incidencias_tec($idusuario) {
        $this->db->select('idincidencia, fecha_inicio,nombre_completo_usuario,descripcion_incidencia');
        $this->db->from('detalle_incidencia');
        $this->db->where('idestado_incidencia', 1);
        $this->db->where('tecnico_idusuario', $idusuario);
        return $this->db->get()->result_Array();
    }

    function save($data) {
        $this->db->insert('usuario', $data);
        return $this->db->insert_id();
    }

    function save_tecnico($data) {
        $this->db->insert('tecnico', $data);
        return $this->db->insert_id();
    }

    function insertar_incidencias($id) {
        $this->db->insert('incidencia', $id);
    }

}

?>