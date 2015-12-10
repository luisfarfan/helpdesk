<?php

class Encuesta_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function close_ticket($id) {
        $data = array('idestado_incidencia' => 4, 'fecha_cierre' => date('Y-m-d h:i:s'));
//        $res = 0;

        $this->db->where('idincidencia', $id);
        $this->db->update('incidencia', $data);
        $res = $this->db->affected_rows();
        return $res;
    }

    public function verificar_ticket($id) {
        $this->db->where('idincidencia', $id);
        $this->db->select('idestado_incidencia');
        $query = $this->db->get('incidencia');
        return $query->row();
    }

    public function get_opciones() {
        $sql = "SELECT ep.idencuesta_preguntas,encuesta_pregunta,eo.idencuesta_opciones,opcion
           FROM encuesta_opciones eo inner join encuesta_preguntas ep on eo.idencuesta_preguntas=ep.idencuesta_preguntas";
        $query = $this->db->query($sql);
//        $query=$this->db->get();
        return $query->result_Array();
    }

    public function verificar_encuesta_exists($ticket) {
        $this->db->where('id_ticket', $ticket);
        return $this->db->get('usuario_encuesta')->result_Array();
    }

    public function send_data($data) {
        $this->db->insert_batch('usuario_encuesta', $data);
        return $this->db->affected_rows();
    }

    public function reporte_encuesta($id) {
        $data['reporte'] = $this->db->query('select opcion as name,count(respuesta) as y from resultado_encuesta
where idencuesta_preguntas='.$id.' GROUP BY respuesta')->result_Array();
        $data['titulo'] = $this->db->query('select encuesta_pregunta from encuesta_preguntas where idencuesta_preguntas='.$id)->result_Array();
        return $data;
    }

}

?>