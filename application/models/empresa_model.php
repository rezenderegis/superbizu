<?php 

class Empresa_model extends CI_Model {

	public function salva($empresa) {

			$this->db->insert("empresa", $empresa);
		
	
	}

	public function atualiza_empresa($empresa, $idempresa) {
		
		$this->db->where("empresa.idempresa", $idempresa);
		$this->db->update("empresa", $empresa);
	}

	public function buscaEmpresaInserida($idusuario) {
	
		$this->db->select("max(empresa.idempresa) as id");
		$this->db->from("empresa");
		$this->db->where("empresa.idusuario", $idusuario);
		return $this->db->get()->row_array(0);
			
	
	}

	public function salvaUsuarioEmpresa($usuarioEmpresa) {
		
		
		$this->db->insert("usuario_empresa", $usuarioEmpresa);
		
	}
	
	/*
	 * Deleta a empresa ficticia que � criada para o usu�rio para que seja feito o login. 
	 * */
	public function deletarIdFicticiaInserida($idusuario) {
		
		$this->db->where("usuario_empresa.idusuario", $idusuario);
		$this->db->where("usuario_empresa.idempresa = 0");
		$this->db->delete("usuario_empresa");
		
	}
	
	public function traz_dados_empresa($id_empresa) {
		
		$this->db->select("empresa.*");
		$this->db->from("empresa");
		$this->db->where("empresa.idempresa", $id_empresa);
	//	print_r($this->db->get()->result_array());
		return $this->db->get()->result_array();
	}
	
	public function retira_ultimo_master_empresa($id_empresa, $dados) {
		
		$this->db->where("usuario_empresa.idempresa", $id_empresa);
		$this->db->update("usuario_empresa", $dados);
	}
	
	public function atualiza_usuario_master($id_empresa, $id_usuario, $dados) {
		
		$this->db->where("usuario_empresa.idempresa", $id_empresa);
		$this->db->where("usuario_empresa.idusuario", $id_usuario);
		$this->db->update("usuario_empresa", $dados);
		
	}
	
	
	public function buscaUltimoUsuarioEmpresaInserida () {
		
	
		$this->db->select("max(ue.idusuarioempresa) as id");
		$this->db->from("usuario_empresa ue");
		
		return $this->db->get()->row_array(0);
		
		
		
		
	}
	
	public function insereFoto($dados, $idEmpresa) {
	
		$this->db->where("idempresa", $idEmpresa);
		$this->db->update("empresa", $dados);
	}
}