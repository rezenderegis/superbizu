<?php
class Grupos_alunos_model extends CI_Model {
	
		
		public function trazGrupos ($idUsuario,$idEmpresa) {
				
			$this->db->select("tb_grupo.*");
			$this->db->from("tb_grupo");
			
			$this->db->where("tb_grupo.empresaGrupo", $idEmpresa);
				
			return $this->db->get()->result_array();
		}
		
		public function trazGrupoPeloCodigoConvite($codigoConvite) {

			$idGrupo = explode("#", $codigoConvite);
			//echo $idGrupo[1]; die();
			$this->db->select("tb_grupo.*");
			$this->db->from("tb_grupo");
			$this->db->where("tb_grupo.idGrupo", $idGrupo[1]);
			return $this->db->get()->row_array();
		}



		public function trazSemExistentes($gruposExistentes,$idEmpresa) { 
			
			$parametro = "";
			if ($gruposExistentes) {
				$parametro = " and idGrupo not in (".$gruposExistentes.")";
			}
			$sql = "select tb_grupo.* from tb_grupo where 
					 empresaGrupo = ".$idEmpresa.$parametro
					;
			$query = $this->db->query($sql);
			
			$query = $this->db->query($sql);
			return $query->result_array();
			
			
		}
				
			
				
		
		
		
		public function salvarNovoGrupo($dados) {
			
			$this->db->insert("tb_grupo", $dados);
			
			
			
		}
		
		public function adicionaAlunoNoGrupo($dados) {
		
			$this->db->insert("tb_aluno_grupo", $dados);
		}
		
		
		public function salvaLista($descricao) {
			
			$dadosUsuarioLogado = $this->session->userdata("usuario_logado");
			$idUsuarioLogado = $dadosUsuarioLogado['id'];
			
			$idEmpresa = $this->session->userdata('idempresa');
			
			
			$dados = array( "descricao" => $descricao,
						"idEmpresa" => $idEmpresa,
						"idResponsavel" => $idUsuarioLogado);
				
				$this->db->insert("lista_questoes", $dados);
				
		}
		
		
		public function buscaUltimaListaQuestaoInserida() {
		
			$this->db->select("max(l.idListaQuestoes) as idListaQuestoes");
			$this->db->from("lista_questoes l");
			return $this->db->get()->row_array(0);
		}
		
		public function salvaQuestaoLista($idUltimaListaInserida, $idQuestaoLista) {
				
				
		
			$dadosUsuarioLogado = $this->session->userdata("usuario_logado");
			$idUsuarioLogado = $dadosUsuarioLogado['id'];
				
			$idEmpresa = $this->session->userdata('idempresa');
				
			$qtdIdQuestaoNaLista = count($idQuestaoLista);
				
			for ($i=0; $i<$qtdIdQuestaoNaLista; $i++) {
					
				$dados = array("idListaQuestao" => $idUltimaListaInserida,
						
						"idQuestao" => $idQuestaoLista[$i]
					);
		
				$this->db->insert("questao_lista", $dados);
					
			}
		}
		
		public function excluirAlunoGrupo($idAlunoGrupo) {
			//echo $idAlunoGrupo;
			//die();
			$dados = array("situacaoAlunoGrupo" => 0);
			$this->db->where("tb_aluno_grupo.idalunogrupo", $idAlunoGrupo);
			$this->db->update("tb_aluno_grupo", $dados);
			
			
			
		}
		
		
		public function ativarAlunoGrupo($idAlunoGrupo) {
			//echo $idAlunoGrupo;
			//die();
			$dados = array("situacaoAlunoGrupo" => 1);
			$this->db->where("tb_aluno_grupo.idalunogrupo", $idAlunoGrupo);
			$this->db->update("tb_aluno_grupo", $dados);
				
				
				
		}
		public function excluirGrupoAcessoLista($idListaGrupo) {
			
			$dados = array("situacaoAcesso" => 0);
			$this->db->where("tb_lista_grupo.idlistagrupo", $idListaGrupo);
			$this->db->update("tb_lista_grupo", $dados);
			
			
		}
		
		public function trazGruposComAcessoLista ($idListaQuestao) {
		
			$this->db->select("tb_grupo.*, lg.idListaGrupo, lg.idLista");
			$this->db->from("tb_grupo");
			$this->db->join("tb_lista_grupo lg", "lg.idgrupo = tb_grupo.idgrupo");
			$this->db->where("lg.idlista", $idListaQuestao);
			$this->db->where("lg.situacaoAcesso", 1);
			return $this->db->get()->result_array();
		}
		
		public function incluirGrupoParaAcessoLista($dados) {
			
			$this->db->insert("tb_lista_grupo", $dados);
			
		}
		
		public function salvaGrupoProfessor($dados) {
			
			$this->db->insert("professor_grupo", $dados);
			
		}
		
		
		public function verificaSeProfessorTemGrupo($idProfessor, $idGrupo) {
			
			$this->db->select("professor_grupo.idProfessor");
			$this->db->from("professor_grupo");
			$this->db->where("professor_grupo.idProfessor", $idProfessor);
			$this->db->where("professor_grupo.idGrupo", $idGrupo);
			$dados = $this->db->get()->row_array();
			
			if (sizeof($dados) > 0) {
				return $dados['idProfessor'];
			} else {
				return "";
			}
			
		}
		
		
	}
	
	
	
	
	
	
	
