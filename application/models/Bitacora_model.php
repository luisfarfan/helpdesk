<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bitacora_model
 *
 * @author LFarfan
 */
class Bitacora_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_bitacora($id) {
        return $this->db->get_where('bitacora_detalle', array('idincidencia' => $id))->result_Array();
    }

}
