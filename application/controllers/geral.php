<?php
date_default_timezone_set('America/Sao_Paulo');
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Geral extends CI_Controller {
	public function index() {
		
		// $this->load->view("geral/HTML/page_home1.php");
		$this->load->view ( "geral/index.php" );
		// $this->load->view("rodape.php");
	}
	public function chamarTeste() {
		$this->load->view("cabecalho");
	}
	public function home($idempresa = 0, $var_teste=0) {
		//$this->load->model("email_model");
		//echo $this->email_model->trazerTextoEmail("ALUNO_ADICIONADO_POR_PROFESSOR", "Joao do Lago", "Prof Zé", "Lista para ENEM");
		//die();
		/*
		 * 
		 * Não sei explicar o que aconteceu apó a colocação do novo layot. Estava perdendo a referência do 
		$var_teste na sessão e só volvou a funcionar quando passei um segundo parâmetro aqui. 
		Este 3 não serve pra nada, é uma gambiarra que tenho que descobrir por que aconteceu isso. 
		Sem esse novo layout não precisa disso.
		 * 
		 * 
		 * 
		 */
		autoriza ();
		ob_start(); //Esse comando não deixa exibir a mensager output sender information
		// $idempresa = $this->session->userdata('idempresa');
		$usuario = $this->session->userdata ( "usuario_logado" );
		
		$idusuario = $usuario ['id'];
		
		$this->load->model ( "usuarios_model" );
		
		$empresasUsuario = $this->usuarios_model->buscaEmpresasUsuario ( $idusuario );
		
		$dados_usuario_empresa = $this->usuarios_model->quantidadeEmpresaUsuario ( $idusuario );
		
		$id_empresa_usuario = $dados_usuario_empresa ['idempresa'];
		
		$perfitirAcesso = false;
		
		foreach ($empresasUsuario as $empresas) {
			//Verifica se a empresa do parâmetro pertence ao usuário. 
	
			if (($empresas['idempresa'] == $idempresa) || $idempresa == 0 ) {
				$perfitirAcesso = true;
			}
		}

		if ($perfitirAcesso == true) {
			
		$qtd_empresas_usuario = $dados_usuario_empresa ['idusuario'];
		
		$this->session->set_userdata ( "qtdEmpresasUsuario", $qtd_empresas_usuario );
		
		if ($qtd_empresas_usuario == 1) {
			
			$this->session->set_userdata ( "idempresa", $id_empresa_usuario );
		}
		
		//Troquei $idempresa por id_empresa_usuario
		$dadosUsuarioEmpresa = "";
		if ($id_empresa_usuario == 0) {
			
			$this->session->unset_userdata ( "idempresa" );
			
		} else {
				
			$this->session->set_userdata ( "idempresa", $idempresa );
			$dadosUsuarioEmpresa = $this->usuarios_model->buscaUsuariosPorEmpresa($id_empresa_usuario, $idusuario, 1,0,0);
			
			$this->session->set_userdata("usuario_master", $dadosUsuarioEmpresa['usuario_master']);
				
		}
		
		//$this->load->model("questoes_model");
		//$qtdQuestoesEmpresa = $this->questoes_model->buscaTodos();
	//	print_r($qtdQuestoesEmpresa);
	
		
		$this->usuarios_model->quantidadePerfisUsuario ( $idusuario );
		
		$perfilUsuario = $this->usuarios_model->buscaPerfilUsuario ( $idusuario, $id_empresa_usuario );
		//print_r($perfilUsuario); die();
		if ($perfilUsuario != null) {
			
			$perfil = $perfilUsuario;
		} else {
			$perfil = 0;
		}
		
		$this->session->set_userdata ( "perfil", $perfil );
		// echo $qtd_empresas_usuario;
		
		if ($qtd_empresas_usuario == 1) {
		
			$idempresa = $id_empresa_usuario;
			$this->session->set_userdata ( "idempresa", $idempresa );
		}
		// print_r($empresasUsuario);
		
		$isSomenteAluno = false;
		if (sizeof($perfil) == 1) {
			foreach ($perfil as $perfil) {
				if ($perfil['idperfil'] == 3) {
					$isSomenteAluno = true;
				} else {
					$isSomenteAluno = false;
						
				}
			}
		}
		
		
		$trazPessoas = array (
				"empresa" => $empresasUsuario,
				"idempresa" => $idempresa,
				"perfil" => $perfil,
				"qtd_empresas_usuario" => $qtd_empresas_usuario,
				"dadosUsuarioEmpresa" => $dadosUsuarioEmpresa,
				"isSomenteAluno" => $isSomenteAluno
		);
		// echo $id_empresa_usuario;
		
		
		
		if ($isSomenteAluno) {

			$this->load->model ( "lista_model" );
			$lista_questao = $this->lista_model->trazListasPorAluno ( true, true );
				
			
			$trazPessoas = array (
					"empresa" => $empresasUsuario,
					"idempresa" => $idempresa,
					"perfil" => $perfil,
					"qtd_empresas_usuario" => $qtd_empresas_usuario,
					"dadosUsuarioEmpresa" => $dadosUsuarioEmpresa,
					"isSomenteAluno" => $isSomenteAluno,
					"listaQuestao" => $lista_questao
			);
			
			
			$this->load->template2 ( "lista/listasParaResolver", $trazPessoas);
				
			
		} else {
	
			$this->load->template2 ( "geral/home", $trazPessoas, 'refresh' );
		
		}
	} else {
		
		$this->session->set_flashdata("success", "Você não tem acesso a essa conta!");
		
		redirect('geral/home');
	}
	}
	

	
}
	