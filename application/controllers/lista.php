<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'N�o � permitido acesso direto ao site!' );
class Lista extends CI_Controller {
	public function novaLista() {
		$this->load->template2 ( "lista/nova_lista" );
	}
	
	public function listaQuestoes() {
		autoriza ();
		
		$this->load->model ( "lista_model" );
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		$lista_questao = $this->lista_model->trazListasPorUsuarioEescla ( true, true );
		
		$dados = array (
				"listaQuestao" => $lista_questao 
		);
		
		$this->load->template2 ( "lista/index", $dados );
	}
	
	
	public function verificarAlunoResolveuLista($idLista,$idGrupo) {
		autoriza ();
	
		$this->load->model ( "lista_model" );
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		$lista_questao = $this->lista_model->verificarAlunoResolveuLista( $idLista,$idGrupo);
		$dadosGrupoLista = $this->lista_model->trazerDadosGrupoLista( $idLista,$idGrupo);

		
		//grafico
		
		$dadosGrafico =  $this->lista_model->calculaPercentualAcertoLista($idLista,$idGrupo, "RETORNAR_JSON");
		//fim grafico
		
		
		// Gráfico de Questões
		
		$dados = $this->lista_model->trazerInformacoesListas($idLista,$idGrupo,"");
		
		$questoesPorLista = $this->lista_model->trazQuestoesPorLista($idLista,$idGrupo);
		
		//$dadosGrafico = array("dados" => $dados, "questoesPorLista" => $questoesPorLista);
		
		//
	
		
		$dados = array (
				"listaQuestao" => $lista_questao,
				"dadosGrupoLista" => $dadosGrupoLista,
				"percentualAcertoLista" => $dadosGrafico,
				"dados" => $dados, "questoesPorLista" => $questoesPorLista
		);
		
		$this->load->template2 ( "lista/verificaAlunoResolveuLista", $dados );
	}
	
	
	public function graficoPercentualAcertoLista($idLista,$idGrupo) {
		autoriza ();
		
		$this->load->model ( "lista_model" );
		$dados =  $this->lista_model->calculaPercentualAcertoLista($idLista,$idGrupo, "RETORNAR_JSON");
		$dados = array("percentualAcertoLista" => $dados);
		
		$this->load->template2("graficos/graficoPercentualAcertoLista", $dados);
		
	}
	

	public function resolucoesLista() {
		autoriza ();
		
		$this->load->model ( "lista_model" );
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		$lista_questao = $this->lista_model->trazListaPorGrupo( true, true );
	
		$dados = array (
				"listaQuestao" => $lista_questao
		);
		
		$this->load->template2 ( "lista/resolucoesLista", $dados );
	}
	
	public function criarLista($trazerQuestoesDoBizu=false) {
		autoriza ();
		// UTILIZADO PARA DEBUGAR
		// $this->output->enable_profiler(TRUE);
		
		// CARREGAR O MODELO PARA US�L-LO
		$this->load->model ( "questoes_model" );
		// $empresa = $this->session->userdata("idempresa");
		$questoes = $this->questoes_model->buscaTodos (0,0,$trazerQuestoesDoBizu);
		
		$this->load->helper ( array (
				"currency" 
		) );
		
		$dados = array (
				"questoes" => $questoes 
		);
		// $this->load->view("cabecalho.php");
		$this->load->template2 ( "lista/novaLista.php", $dados );
		// $this->load->view("rodape.php");
	}
	
	public function inserirQuestoesListaExistente($idLista) {
		autoriza ();
		// UTILIZADO PARA DEBUGAR
		// $this->output->enable_profiler(TRUE);
	
		// CARREGAR O MODELO PARA US�L-LO
		$this->load->model ( "questoes_model" );
		// $empresa = $this->session->userdata("idempresa");
		$questoes = $this->questoes_model->buscaQuestoesNaoAdicionadasLista ( $idLista );
	
		$this->load->helper ( array (
				"currency"
		) );
	
		$dados = array (
				"questoes" => $questoes, "idLista" => $idLista
		);
		// $this->load->view("cabecalho.php");
		$this->load->template2 ( "lista/inserirNaLista", $dados );
		// $this->load->view("rodape.php");
	}
	
	public function cadastrarNovaLista() {
		$this->load->library ( "form_validation" );
		
		// print_r($this->input->post("idQuestaoLista"));
		$this->form_validation->set_rules ( "descricao", "Nome da lista", "required" );
		$this->form_validation->set_rules ( "idQuestaoLista", "Questões	 da lista.", "required" );
		
		
		$sucesso = $this->form_validation->run ();
		
		if ($sucesso) {
			$this->load->model ( "lista_model" );
			$this->lista_model->salvaLista ( $this->input->post ( "descricao" ) );
			
			$idUltimaListaInserida = $this->lista_model->buscaUltimaListaQuestaoInserida ();
			
			$this->lista_model->salvaQuestaoLista ( $idUltimaListaInserida ['idListaQuestoes'], $this->input->post ( "idQuestaoLista" ) );
			
			redirect ( 'lista/listaQuestoes' );
		} else {
			
			$this->criarLista();
				
		}
	}
	
	public function alterarLista($idLista) {
		$this->load->library("form_validation");
		$this->form_validation->set_rules ( "idQuestaoLista", "Questões	 da lista.", "required" );
		
		$sucesso = $this->form_validation->run();
		
		if ($sucesso) {
			$this->load->model("lista_model");
			$this->lista_model->salvaQuestaoLista ( $idLista, $this->input->post ( "idQuestaoLista" ) );
			
			redirect ('questoes/verDetalheQuestao/'.$idLista);
		} else {
			$this->inserirQuestoesListaExistente($idLista);
		}
		}
		
		public function formularioEditarLista($idLista) {
			
			$dados = array("idListaEdicao" => $idLista);
			
			$this->load->model("lista_model");
			
			$dadosLista = $this->lista_model->trazDadosLista($idLista);
			$dados = array("dadosLista" => $dadosLista);
			$this->load->template2("lista/formularioEdicao", $dados);
			
		} 
		
		public function salvarDadosAtualizacaoLista() {
			
			$this->load->library("form_validation");
			
			$this->form_validation->set_rules("descricao", "Descrição da Lista", "required");
			
			$sucesso = $this->form_validation->run();
			
			if ($sucesso) {
				$this->load->model("lista_model");
				
				$dados = array("descricao" => $this->input->post("descricao"));
					
				$this->lista_model->atualizarLista($dados, $this->input->post("idLista"));
			
			}
			
			$this->listaQuestoes();
		}
		
		
		public function formularioResolverLista ($idLista) {
		
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
					"questoes" => $questoes, "idLista" => $idLista, "tipoTela" => "RESOLUCAO"
			);
			// $this->load->view("cabecalho.php");
			$this->load->template2 ( "lista/formularioResolverLista.php", $dados );
			// $this->load->view("rodape.php");
		
		
		}
		
		public function formularioVerificarResolucao ($idLista, $idResolucao=0) {
		
			autoriza ();
	
	
			$this->load->model ( "questoes_model" );
			// $empresa = $this->session->userdata("idempresa");
			$this->load->model ( "resolucoes_model" );
				
			$questoes = $this->resolucoes_model->buscaQuestoesPorLista ($idLista, $idResolucao);
			$this->load->model("resolucoes_model");
				
			$resolucao = $this->resolucoes_model->trazDadosResolucao($idResolucao);
			
			$this->load->helper ( array (
					"currency"
			) );
			// $this->load->helper("currency");
		
			// ADICIONA HELPER DE CRIA��O DE FORMUL�RIO
			// $this->load->helper("form");
		
			$dados = array (
					"questoes" => $questoes, "idLista" => $idLista, "tipoTela" => "VISUALIZACAO", "dadosResolucao" => $resolucao
			);
			// $this->load->view("cabecalho.php");
			$this->load->template2 ( "lista/formularioResolverLista.php", $dados );
			// $this->load->view("rodape.php");
		
		
		}
		
		
		
		public function trazItensQuestao($id_questao) {
			
			$this->load->model ( "questoes_model" );
			$dados_itens = $this->questoes_model->buscaItens ( $id_questao );
			
			return $dados_itens;
		}
		
		
		public function gravarResolucaoLista() {
			
			$this->load->model("lista_model");
			
			$this->lista_model->salvarResolucao($this->input->post("idListaQuestoes"), $this->input->post("resposta"));
			
			redirect("resolucoes/minhasResolucoes");
			
			
		}
		
		public function listasParaResolver() {
			autoriza ();
		
			$this->load->model ( "lista_model" );
			$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
			$idUsuarioLogado = $dadosUsuarioLogado ['id'];
			$lista_questao = $this->lista_model->trazListasPorAluno ( true, true );
		
			$dados = array (
					"listaQuestao" => $lista_questao
			);
		
			$this->load->template2 ( "lista/listasParaResolver", $dados );
		}
		
		public function contaPercentualAcertos ($idGrupo, $idLista) {
			// Teste: '0b768ffd-b21c-4622-9f2c-2f842dea219d', 1
			
			$this->load->model("lista_model");
			return $this->lista_model->contaPercentualAcertos($idGrupo, $idLista);
			
		}
		
		public function graficoLista ($idListaQuestao,$idGrupo) {
			
			$this->load->model("lista_model");
			$dados = $this->lista_model->trazerInformacoesListas($idListaQuestao,$idGrupo,"");
			
			$questoesPorLista = $this->lista_model->trazQuestoesPorLista($idListaQuestao,$idGrupo);
			
			$dadosGrafico = array("dados" => $dados, "questoesPorLista" => $questoesPorLista);
			$this->load->template2("graficos/index", $dadosGrafico);
			
		}
		
		public function trazDadosQuestao ($idListaQuestao,$idGrupo,$idQuestao) {
			
			header("Content-Type: text/html; charset=UTF-8",true);
			
			
			$this->load->model("lista_model");
			
			$dados = $this->lista_model->trazerInformacoesListas($idListaQuestao,$idGrupo, $idQuestao);
			
			//print_r($dados); die();
			return $dados;			
		}
		
		public function retornaTotalAcertosErrosPorQuestao ($idLista,$idGrupo) {
			
			$this->load->model("lista_model");
			
			$dados = $this->lista_model->retornaTotalAcertosErrosPorQuestao($idLista,$idGrupo);
			
			$arrayQuestoes = [];
			foreach ($dados as $dadosGrafico) {
				unset($dadosGrafico["resposta"]);
				array_push($arrayQuestoes, $dadosGrafico);
				
				
			}	
						

			$dadosGrafico = array("dados" => json_encode($arrayQuestoes, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
			$this->load->template2("graficos/totalAcertosErrosPorQuestao", $dadosGrafico);
			
			
		}
}