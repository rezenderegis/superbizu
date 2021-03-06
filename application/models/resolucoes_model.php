<?php
date_default_timezone_set('America/Sao_Paulo');

class Resolucoes_model extends CI_Model {
	
		
		public function trazListasPorUsuarioEescla ($idUsuario,$empresa) {
	
			$dadosUsuarioLogado = $this->session->userdata("usuario_logado");
			$idUsuarioLogado = $dadosUsuarioLogado['id'];
				
			$idEmpresa = $this->session->userdata('idempresa');
			
			$this->db->select("lista_questoes.*, TB_RESOLUCAO.*");
			$this->db->from("lista_questoes");
			$this->db->join("TB_RESOLUCAO", "TB_RESOLUCAO.id_lista = lista_questoes.idlistaquestoes");
			$this->db->where("TB_RESOLUCAO.id_usuario", $idUsuarioLogado);			
			$this->db->order_by("TB_RESOLUCAO.date", "desc");
			$this->db->group_by("TB_RESOLUCAO.ID_GRUPO_QUESTAO");
			return $this->db->get()->result_array();
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
		
		public function trazDadosLista($idLista) {
			
			$this->db->select("lista_questoes.*");
			$this->db->from("lista_questoes");
			$this->db->where("lista_questoes.idlistaquestoes", $idLista);
			return $this->db->get()->row_array();
			
		}
		
		public function atualizarLista($dados, $idLista) {
			
			$this->db->where("lista_questoes.idlistaquestoes", $idLista);
			$this->db->update("lista_questoes", $dados);
			
		}
		
		public function salvarResolucao($idLista, $respostas) {
			
			$dadosUsuarioLogado = $this->session->userdata("usuario_logado");
				
			$idUsuarioLogado = $dadosUsuarioLogado['id'];
			
			foreach ($this->input->post("resposta") as $questao => $itemMarcado) {
				$dados = array("ID_QUESTAO" => $questao, "ID_ITEM" => $itemMarcado, "ID_LISTA" => $idLista, "ID_USUARIO" => $idUsuarioLogado);
				$this->db->insert("TB_RESOLUCAO", $dados);
			}
			
		}
		
		public function trazDadosResolucao($idGrupoResolucao) {
			
			$this->db->select("TB_RESOLUCAO.*");
			$this->db->from("TB_RESOLUCAO");
			$this->db->where("TB_RESOLUCAO.ID_GRUPO_QUESTAO", $idGrupoResolucao);
			return $this->db->get()->result_array();
		}
		
		
		public function buscaQuestoesPorLista($idLista, $idResolucao) {
			
			$this->db->select ( "tb_questao.*, tb_materia.nome_materia, tb_assunto.descricao_assunto" );
			$this->db->from ( "tb_questao" );
			$this->db->join ( "tb_assunto_questao aq", "aq.id_questao = tb_questao.id_questao", "left" );
			$this->db->join ( "tb_assunto", "tb_assunto.id_assunto = aq.id_assunto", "left" );
			$this->db->join ( "tb_materia", "tb_materia.id_materia = tb_assunto.id_materia", "left" );
			$this->db->join ( "questao_lista ql", "ql.idQuestao = tb_questao.id_questao" );
			$this->db->join ( "lista_questoes lq", "lq.idListaQuestoes = ql.idListaQuestao" );
				
			$this->db->where ( "lq.idListaQuestoes", $idLista );
				
			return $this->db->get ()->result_array ();
			//$this->db->last_query());
			
		}
		
		
	}
	
	
	
	
	
	
	
