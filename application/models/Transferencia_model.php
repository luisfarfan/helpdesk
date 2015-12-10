<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transferencia_model
 *
 * @author LFarfan
 */
class Transferencia_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function save_data($data) {

        if ($this->id_exists($data['idincidencia'])) {
            $data['idestado_incidencia'] = 4;
            $this->db->where('idincidencia', $data['idincidencia']);
            unset($data['idincidencia']);
            $this->db->update('incidencia', $data);
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }

    public function id_exists($idincidencia) {
        if (count($this->db->get_where('incidencia', array('idincidencia' => $idincidencia))) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get($id) {
        return $this->db->get_where('detalle_incidencia', array('tecnico_idusuario' => $id))->result_Array();
    }

    function delete() {
        return $this->db->query('delete from incidencias');
    }

    public function get_tecnicos() {
        return $this->db->query('select t.idusuario,nombre_completo,username from tecnico t inner join usuario u on t.idusuario=u.idusuario')->result_Array();
    }

}
