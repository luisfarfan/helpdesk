<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportes_model
 *
 * @author lfarfan
 */
class Reportes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function reporte_categoria($array = false) {
        $query = 'select categoria_nombre as name,count(i.idcategoria) as y from incidencia i
inner join categoria c on i.idcategoria=c.idcategoria';
        if ($array) {
            if (isset($array['estado'])) {
                $query.=' where DATE(fecha_inicio) BETWEEN "' . $array['start'] . '" and "' . $array['to'] . '"';
                $query.=' and idestado_incidencia=' . $array['estado'];
            } else {
                $query.=' where DATE(fecha_inicio) BETWEEN "' . $array['start'] . '" and "' . $array['to'] . '"';
            }
            $query .=' GROUP BY i.idcategoria';
        } else {
            $query .=' GROUP BY i.idcategoria';
        }

        return $this->db->query($query)->result_Array();
    }

    public function reporte_tecnico($array = false) {
        $query = 'select nombre_completo_tecnico as name,count(tecnico_idusuario) as y from detalle_incidencia';
        if ($array) {
            if (isset($array['estado'])) {
                $query.=' where DATE(fecha_inicio) BETWEEN "' . $array['start'] . '" and "' . $array['to'] . '"';
                $query.=' and idestado_incidencia=' . $array['estado'];
            } else {
                $query.=' where DATE(fecha_inicio) BETWEEN "' . $array['start'] . '" and "' . $array['to'] . '"';
            }
            $query .=' GROUP BY tecnico_idusuario';
        } else {
            $query .=' GROUP BY tecnico_idusuario';
        }

        return $this->db->query($query)->result_Array();
    }

    public function reporte_fechas() {
        $consulta = 'select nombre_completo_tecnico,count(tecnico_idusuario) as cantidad from detalle_incidencia
GROUP BY tecnico_idusuario';
        return $this->db->query($consulta)->result_Array();
    }

    public function reporte_usuarios($array = false) {
        $query = "select departamento_nombre as name,count(d.iddepartamento) as y from detalle_incidencia d inner join departamento dep
on d.iddepartamento=dep.iddepartamento";
        if ($array) {
            if (isset($array['estado'])) {
                $query.=' where DATE(fecha_inicio) BETWEEN "' . $array['start'] . '" and "' . $array['to'] . '"';
                $query.=' and idestado_incidencia=' . $array['estado'];
            } else {
                $query.=' where DATE(fecha_inicio) BETWEEN "' . $array['start'] . '" and "' . $array['to'] . '"';
            }
            $query .=' GROUP BY d.iddepartamento';
        } else {
            $query .=' GROUP BY d.iddepartamento';
        }

        return $this->db->query($query)->result_Array();
    }

}
