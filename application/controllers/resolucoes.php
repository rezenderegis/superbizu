<?php
date_default_timezone_set('America/Sao_Paulo');

if (! defined ( 'BASEPATH' ))
	exit ( 'N�o � permitido acesso direto ao site!' );
class Resolucoes extends CI_Controller {
	
	public function minhasResolucoes() {
		autoriza ();
	
		$this->load->model ( "resolucoes_model" );
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		$lista_questao = $this->resolucoes_model->trazListasPorUsuarioEescla ( true, true );
		//print_r($lista_questao); die();
		$dados = array (
				"listaQuestao" => $lista_questao 
		);
		
		$this->load->template2 ( "resolucoes/minhasResolucoes", $dados );
	}

		public function gravarResolucaoLista() {
			
			$this->load->model("lista_model");
			
			$this->lista_model->salvarResolucao($this->input->post("idListaQuestoes"), $this->input->post("resposta"));
			
			
			
			
		}
		
		public function formularioResolverLista ($idLista,$tipo=0) {
		
			autoriza ();
		
			$this->load->model ( "questoes_model" );
			// $empresa = $this->session->userdata("idempresa");
			$questoes = $this->questoes_model->buscaQuestoesPorLista ($idLista);
		
			$this->load->helper ( array (
					"currency"
			) );
			// $this->load->helper("currency");
		
			// ADICIONA HELPER DE CRIA��O DE FORMUL�RIO
			// $this->load->helper("form");
		
			$dados = array (
					"questoes" => $questoes, "idLista" => $idLista
			);
			// $this->load->view("cabecalho.php");
			$this->load->template2 ( "lista/formularioResolverLista.php", $dados );
			// $this->load->view("rodape.php");
		
		
		}
		
		
		
}