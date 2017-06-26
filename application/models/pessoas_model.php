<?php 

class Pessoas_model extends CI_Model {

	public function busca($id) {
	
		$this->db->where("idpessoa", $id);
		return $this->db->get("pessoa")->row_array(0);
	
	}
	
	public function buscaPessoas($idempresa = 0, $id_pessoa = 0) {
	
	
		$this->db->select("pessoa.*");
		$this->db->from("pessoa");
		$this->db->where("pessoa.idempresa", $idempresa);
		
		if ($id_pessoa != 0) {
			$this->db->where("pessoa.idpessoa", $id_pessoa);
		}
		
		return $this->db->get()->result_array();
		
		//return $this->db->get("pessoa")->result_array();
	
	}
	
	
	
	
	public function buscaPessoasEdicao($idempresa = 0, $id_pessoa = 0) {
	
	
		$this->db->select("pessoa.*");
		$this->db->from("pessoa");
		$this->db->where("pessoa.idempresa", $idempresa);
	
		if ($id_pessoa != 0) {
			$this->db->where("pessoa.idpessoa", $id_pessoa);
		}
	
		return $this->db->get()->row_array();
	
		//return $this->db->get("pessoa")->result_array();
	
	}

	public function buscaProximoIdPessoaEmpresa($empresa) {
	
		$this->db->select("case when max(pessoa.idpessoa) is null then 1 else max(pessoa.idpessoa) + 1 end as id", FALSE);
		$this->db->from("pessoa");
		$this->db->where("pessoa.idempresa", $empresa);
		return $this->db->get()->row_array(0);
	
	
	
	
	}


	public function salva($pessoa) {
				
	//	$empresa = $this->session->userdata("idempresa");
	//	$this->db->set('idempresa', $empresa);

		$this->db->insert("pessoa", $pessoa);

		
		
	}

	
 	public function entries() {
          $this->db->select('nomeproduto');
          $this->db->like('nomeproduto', $this->input->post('queryString'), 'both'); 
          return $this->db->get('nomeproduto', 10);  
     }
     
     
     public function atualiza_pessoa($id_empresa, $id_pessoa, $pessoa) {
     	
     	$this->db->where("pessoa.idempresa", $id_empresa);
     	$this->db->where("pessoa.idpessoa", $id_pessoa);
     	$this->db->update("pessoa", $pessoa);
     	
     }

}
