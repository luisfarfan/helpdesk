<?php

class Categorias_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_cat($id = False) {
        $string = "SELECT idcategoria,categoria_nombre, nombre_completo, tecnico_idusuario FROM `usuario` u inner join categoria c on u.idusuario = c.tecnico_idusuario";
        $id ? $string.=" where idcategoria=$id" : '';
        $query = $this->db->query($string);
        return $query->result_Array();
    }

    public function editar_tec($id_cat, $data) {
        $this->db->where('idcategoria', $id_cat);
        $this->db->update('categoria', $data);
    }

    public function insertar_categoria($data) {
        $this->db->insert('categoria', $data);
        return $this->db->insert_id();
    }

    public function editar_categoria($id_cat, $data) {
        $this->db->where('idcategoria', $id_cat);
        $this->db->update('categoria', $data);
    }

}

?>