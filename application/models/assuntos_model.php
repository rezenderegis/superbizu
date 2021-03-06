<?php

class Assuntos_model extends CI_Model {

	public function traz_itens($id_assunto=0) {
	
		$this->db->select("tb_assunto.*, tb_materia.nome_materia nome_materia, assunto_pai.descricao_assunto descricao_assunto_pai");
		$this->db->from("tb_assunto");
		$this->db->join("tb_materia", "tb_assunto.id_materia = tb_materia.id_materia");
		$this->db->join("tb_assunto assunto_pai", "tb_assunto.id_assunto_pai = assunto_pai.id_assunto", "left");
		$this->db->where("tb_assunto.id_dono", $this->session->userdata("idempresa")
);
		if ($id_assunto != 0) {
			$this->db->where("tb_assunto.id_assunto", $id_assunto);
			return $this->db->get()->row_array();
	
		} else {
			$this->db->order_by("tb_materia.nome_materia, assunto_pai.descricao_assunto, tb_assunto.descricao_assunto");
				
			return $this->db->get()->result_array();
			
		}
	}
	
	public function traz_materias () {
	
		$this->db->select("tb_materia.*");
		$this->db->from("tb_materia");
		return $this->db->get()->result_array();
	
	}
	
	public function salva($dados) {
	
		$this->db->insert("tb_assunto", $dados);
	
	}
	
	public function atualizar_assuntos($dados, $id_assunto) {
	
		$this->db->where("tb_assunto.id_assunto", $id_assunto);
		$this->db->update("tb_assunto", $dados);
	
	}
	
	public function exluirAssunto ($idAssunto){
		
		$this->db->where("tb_assunto.id_assunto", $idAssunto);
		$this->db->delete("tb_assunto");
		
		$this->db->where("tb_assunto_questao.id_assunto", $idAssunto);
		$this->db->delete("tb_assunto_questao");
	}
	
	
	
}