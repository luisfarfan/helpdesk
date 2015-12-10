<?php

class Categorias_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_cat() {
        $query = $this->db->query("SELECT idcategoria,categoria_nombre, nombre_completo, tecnico_idusuario FROM `usuario` u inner join categoria c on u.idusuario = c.tecnico_idusuario");
        return $query->result_Array();
    }

    public function editar_tec($id_cat, $id_tecnicos) {
        $this->db->where('idcategoria', $id_cat);
        $this->db->update('categoria', $id_tecnicos);
    }

}

?>