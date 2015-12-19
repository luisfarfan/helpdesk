<?php

class Incidencia_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_categorias() {
        return $this->db->get('categoria')->result_Array();
    }

    function get_email_tecnico($id) {
        return $this->db->get_where('usuario', array('idusuario' => $id))->result_Array();
    }

    function get_usuarios() {
        return $this->db->get('usuario')->result_Array();
    }

    function get_columns_incidencia() {
        return $this->db->list_fields('incidencia');
    }

    function get_incidencias($idincidencia = false) {

        if ($idincidencia) {
            return $this->db->get_where('detalle_incidencia', array('idincidencia' => $idincidencia))->result_Array();
        } else {
            return $this->db->get('detalle_incidencia')->result_Array();
        }
    }

    function get_estados() {
        return $this->db->get('estado_incidencia')->result_Array();
    }

    function get_tecnicos() {
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->join('tecnico', 'usuario.idusuario=tecnico.idusuario', 'inner');
        return $this->db->get()->result_Array();
    }

    function nueva_incidencia($data) {
        if (isset($data['idincidencia'])) {
            $this->db->where('idincidencia', $data['idincidencia']);
            unset($data['idincidencia']);
            $this->db->update('incidencia', $data);
        } else {
            $this->db->insert('incidencia', $data);
        }

        return $this->db->insert_id();
    }

    function get_incidencias_by_usuario($id) {

        return $this->db->get_where('detalle_incidencia', array('idusuario' => $id))->result_Array();
    }

    function get_incidencias_by_fecha() {
        $now = date('Y-m-d');
        $query = $this->db->query("select * from detalle_incidencia where DATE(fecha_inicio)='" . $now . "' and idestado_incidencia=1");
        return $query->result_Array();
    }

    function get_categoria_tecnico($idcategoria) {
        return $this->db->get_where('categoria', array('idcategoria' => $idcategoria))->result_Array();
    }

    function disponibilidad_tecnico($idtecnico) {
        return $this->db->query('SELECT tecnico_idusuario FROM incidencia where tecnico_idusuario=' . $idtecnico . ' '
                        . 'and idestado_incidencia in(1,2)')->result_Array();
    }

    function tecnicos_libres() {
        return $this->db->query('select idusuario from tecnico where idusuario not in (SELECT tecnico_idusuario FROM `incidencia` where idestado_incidencia in(1,2))
UNION ALL
select idusuario from tecnico where idusuario not in (select tecnico_idusuario from incidencia)')->result_Array();
    }

    function get_incidencia_by_tecnico($id) {
        return $this->db->get_where('detalle_incidencia', array('tecnico_idusuario' => $id))->result_Array();
    }

    function is_tecnico($id) {
        return $this->db->get_where('tecnico', array('idusuario' => $id))->result_Array();
    }

    function insert_bitacora($data) {
        $this->db->insert('bitacora', $data);
        return $this->db->insert_id();
    }

}
