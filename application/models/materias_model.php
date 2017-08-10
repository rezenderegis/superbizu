<?php
class Materias_model extends CI_Model {

    public function salvar ($dados) {

        $this->db->insert("tb_materia", $dados);

    }

    public function traz_materias ($id_dono) {
	
		$this->db->select("tb_materia.*");
		$this->db->from("tb_materia");
        $this->db->where("id_dono", $id_dono);
		return $this->db->get()->result_array();
	
	}

      public function buscaMateria ($id) {
	
		$this->db->select("tb_materia.*");
		$this->db->from("tb_materia");
        $this->db->where("id_materia", $id);
		return $this->db->get()->row_array();
	
	}

    public function atualiza($dados, $id_materia) {
        $this->db->where("tb_materia.id_materia", $id_materia);
        $this->db->update("tb_materia", $dados);
    }



}