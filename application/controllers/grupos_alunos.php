<?php


 if ( !defined('BASEPATH')) exit ('N�o � permitido acesso direto ao site!');



class Grupos_alunos extends CI_Controller {
	

	
	public function listaGrupos() {
		autoriza ();
	
		$idEmpresa = $this->session->userdata('idempresa');
	
		
		$this->load->model("grupos_alunos_model");
	
		$dadosUsuarioLogado = $this->session->userdata("usuario_logado");
		$idUsuarioLogado = $dadosUsuarioLogado['id'];
	
		$grupos = $this->grupos_alunos_model->trazGrupos(0,$idEmpresa);
		
		$dados = array("grupos" => $grupos);
		
		$this->load->template2("grupos/index", $dados);
	
	}
	

	
	
	public function novoGrupo() {
		
		$dados = array("dados_produto_edicao" => "");
		
		$this->load->template2("grupos/novoGrupo", $dados);
		
		
		
	}
	
	public function salvarNovoGrupo () {
		
		$dadosUsuarioLogado = $this->session->userdata("usuario_logado");
		$idUsuarioLogado = $dadosUsuarioLogado['id'];
		$idEmpresa = $this->session->userdata('idempresa');
		
		$dados = array("nomeGrupo" => $this->input->post("nome_grupo"),
						"empresaGrupo" => $idEmpresa,
						"responsavelGrupo" => $idUsuarioLogado);
		
		$this->load->model("grupos_alunos_model");
		$this->grupos_alunos_model->salvarNovoGrupo($dados);
		
		$idGrupoInserido =  $this->db->insert_id();//Essa função do codeigniter pega o último id inserido
		
		$dados = array("idGrupo" => $idGrupoInserido, "idProfessor" => $idUsuarioLogado, "situacao" => 1);
		
		$this->grupos_alunos_model->salvaGrupoProfessor($dados);
		
		redirect('grupos_alunos/listaGrupos');
	}
	
	
	public function incluir_aluno_grupo ($idGrupo) {
		$idEmpresa = $this->session->userdata('idempresa');
	
		$this->load->model("usuarios_model");
		$this->load->model("grupos_alunos_model");
		$alunosDoGrupo = $this->usuarios_model->trazAlunosPorGrupo($idGrupo, $idEmpresa);
		
		$alunosPorEmpresa = $this->usuarios_model->trazAlunosPorEmpresaForaGrupoEspecificado($idEmpresa,$idGrupo);
		
		$dados = array("alunosPorEmpresa" => $alunosPorEmpresa, "alunosDoGrupo" => $alunosDoGrupo,
		"idGrupo" => $idGrupo);
		
		$this->load->template2('grupos/incluirAlunoGrupo', $dados);
		
	}
	
	public function salvarAlunoGrupo() {
		$idEmpresa = $this->session->userdata('idempresa');
		
		//echo "aqui".$this->input->post("idGrupoDoFormulario");

		$dados = array("idUsuario" => $this->input->post("aluno_grupo"), "idEmpresa" => $idEmpresa, 
				"idGrupo" => $this->input->post("idGrupoDoFormulario"), "situacaoAlunoGrupo" => 1);
		
		$this->load->model("grupos_alunos_model");
		$this->grupos_alunos_model->adicionaAlunoNoGrupo($dados);
		
		redirect ('grupos_alunos/incluir_aluno_grupo/'.$this->input->post("idGrupoDoFormulario"));
		
	}
	
	public function desativarAlunoGrupo($idAlunoGrupo, $idGrupo) {
		
		$this->load->model("grupos_alunos_model");
		$this->grupos_alunos_model->excluirAlunoGrupo($idAlunoGrupo);
		
		redirect('grupos_alunos/incluir_aluno_grupo/'.$idGrupo);
	}
	
	
	
	public function ativarAlunoGrupo($idAlunoGrupo, $idGrupo) {
	
		$this->load->model("grupos_alunos_model");
		$this->grupos_alunos_model->ativarAlunoGrupo($idAlunoGrupo);
	
		redirect('grupos_alunos/incluir_aluno_grupo/'.$idGrupo);
	}
	
	public function mostrarGruposAcessoLista($idListaQuestao) {
		

		$idEmpresa = $this->session->userdata('idempresa');
		
		
		$this->load->model("grupos_alunos_model");
		
		$dadosUsuarioLogado = $this->session->userdata("usuario_logado");
		$idUsuarioLogado = $dadosUsuarioLogado['id'];
		
		$grupos = $this->grupos_alunos_model->trazGruposComAcessoLista($idListaQuestao);
		$gruposExistentesLista = $this->converteArrayEmString($grupos, "idGrupo");
		
		$gruposMostrarComboInclusao = $this->grupos_alunos_model->trazSemExistentes($gruposExistentesLista,$idEmpresa);
	
		
		$dados = array("grupos" => $grupos, "gruposMostrarComboInclusao" => $gruposMostrarComboInclusao, "idListaQuestao" => $idListaQuestao);
		
		$this->load->template2("grupos/grupoComAcessoLista", $dados);
		
		
		
	}
	
	public function incluirGrupoParaAcessoLista() {
		$idEmpresa = $this->session->userdata('idempresa');
		
		$this->load->model("grupos_alunos_model");
		
		$dados = array("idLista" => $this->input->post("idListaQuestao"), "idGrupo" => $this->input->post("grupoAcessoLista"),
		"idEmpresa" => $idEmpresa, "situacaoAcesso" => 1);
		
		$this->grupos_alunos_model->incluirGrupoParaAcessoLista($dados);

		$this->load->model("usuarios_model");
		$alunosDoGrupo = $this->usuarios_model->trazAlunosPorGrupo($this->input->post("grupoAcessoLista"), $idEmpresa);
		
		$this->load->model("lista_model");
		$dadosLista = $this->lista_model->trazDadosLista($this->input->post("idListaQuestao"));
		$nomeLista = $dadosLista['DESCRICAO'];
		$this->load->model("email_model");
		$this->email_model->enviarEmailNotificacaoNovaLista($alunosDoGrupo, $nomeLista);
		
		$dadosUsuarioLogado = $this->session->userdata("usuario_logado");
		$idUsuarioLogado = $dadosUsuarioLogado['id'];
		
		
		$professorTemGrupo = $this->grupos_alunos_model->verificaSeProfessorTemGrupo($idUsuarioLogado, $this->input->post("grupoAcessoLista"));
		
		if (!$professorTemGrupo) {
			/*
			 * Sempre que o professor utilizar um grupo, isso tem que ficar registrado. 
			 * Então para que não seja preciso sempre o professor ficar incluindo isso, libero o acesso ao grupo
			 * e quando ele utiliza o sistema grava automaticamente essa informação.
			 * 
			 * */
			$dados = array("idGrupo" => $this->input->post("grupoAcessoLista"), "idProfessor" => $idUsuarioLogado, "situacao" => 1);
			
			$this->grupos_alunos_model->salvaGrupoProfessor($dados);
			
		}
		
		redirect('grupos_alunos/mostrarGruposAcessoLista/'.$this->input->post("idListaQuestao"));
		
	}
	
	public function excluirGrupoAcessoLista($idListaGrupo, $idLista) {
	
		$this->load->model("grupos_alunos_model");
		$this->grupos_alunos_model->excluirGrupoAcessoLista($idListaGrupo);
	
		redirect('grupos_alunos/mostrarGruposAcessoLista/'.$idLista);
	}
	
	
	/*
	public function criarLista($idempresa = 0, $id_questao=0) {
		autoriza ();
		// UTILIZADO PARA DEBUGAR
		// $this->output->enable_profiler(TRUE);
	
		// CARREGA O BANCO DE DADOS
		// $this->load->database();
	
		// CARREGAR O MODELO PARA US�L-LO
		$this->load->model ( "questoes_model" );
		// $empresa = $this->session->userdata("idempresa");
		$questoes = $this->questoes_model->buscaTodos ($id_questao);
	
		$this->load->helper ( array (
				"currency"
		) );
		// $this->load->helper("currency");
	
		// ADICIONA HELPER DE CRIA��O DE FORMUL�RIO
		// $this->load->helper("form");
	
		$dados = array (
				"questoes" => $questoes
		);
		// $this->load->view("cabecalho.php");
		$this->load->template2 ( "lista/novaLista.php", $dados );
		// $this->load->view("rodape.php");
	}
	
	
	public function CadastrarNovaLista () {
	//	print_r($this->input->post("idQuestaoLista"));
		
	$this->load->model("lista_model");
	$this->lista_model->salvaLista($this->input->post("descricao"));
	
	$idUltimaListaInserida = $this->lista_model->buscaUltimaListaQuestaoInserida();
	
	
	$this->lista_model->salvaQuestaoLista($idUltimaListaInserida['idListaQuestoes'], $this->input->post("idQuestaoLista"));
		
	redirect ( 'lista/listaQuestoes');
	
	}
	*/
	
	public function converteArrayEmString ($array, $parametro) {
	
		$qtd = count($array);
	
		$contador = 0;
		$grupoRetorno = "";
	
		foreach ($array as $dados) {
	
			$contador++;
			$grupoRetorno .= $dados[$parametro];
	
			if ($contador < $qtd) {
				$grupoRetorno .= ",";
			}
		}
		return $grupoRetorno;
	
	
	}
	
	
	
}