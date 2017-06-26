<?php if ( !defined('BASEPATH')) exit ('Não é permitido acesso direto ao site!');

class Empresa extends CI_Controller {

	public function empresaFormulario($idEmpresa=0) {
	
			autoriza();

			/*
			 * Verifica se o usu�rio que est� logado possui acesso a outra empresa. Se possuir, n�o pode acessar o aplicativo  na nova empresa.
			 * Ent�o, passo para o forml�rio de cria��o da tela o par�metro, caso possua, o check-box "poder� acessar empresa do aplicativo" n�o ser� mostrado.
			 * */
			$this->load->model("usuarios_model");
			$dados_empresa_editar = 0;
			$dados_usuario = 0;
			if ($idEmpresa) {
				$this->load->model("empresa_model");
				$dados_empresa = $this->empresa_model->traz_dados_empresa($idEmpresa);
				
				$dados_usuario = $this->usuarios_model->buscaUsuariosEmpresa($idEmpresa, 0,0, 1);
				
				$dados_empresa_editar = $dados_empresa;
			}
			$dados_retorno = $this->session->userdata("usuario_logado");
			$idusuario = $dados_retorno['id'];
			
			$acesso_outra_empresa = $this->usuarios_model->usuarioPossuiAcessoAppOutraEmpresa($idusuario);
			$acesso_outra_empresa = array("acesso_outra_empresa" => $acesso_outra_empresa, "dados_empresa_editar" => $dados_empresa_editar, "dados_usuario" => $dados_usuario);
				
			$this->load->template2("empresa/empresaFormulario",$acesso_outra_empresa);
			
	
	}

	public function novaEmpresa() {
	//echo $tipo_formulario;
		
		autoriza();
			
			$empresa = $this->session->userdata("idempresa");
			$usuario = $this->session->userdata("usuario_logado");
			$idusuario = $usuario['id']; 
			//BUSCA PR�XIMO ID DA PESSOA
			$this->load->model("empresa_model");
			//$proximoIdPessoaEmpresa = $this->pessoas_model->buscaProximoIdPessoaEmpresa($empresa);
			//$id = $proximoIdPessoaEmpresa['id'];
			//echo "tipocontaempresa".$this->input->post("tipocontaempresa");
		//	die();
			if ($this->input->post("acessar_aplicativo") == 'S') {
				$acessar_aplicativo = 'S';
			} else {
				$acessar_aplicativo = 'N';
			}
			//echo "cnpj".$this->input->post("cnpj");
			//echo "Tel".$this->input->post("telefone");
			//die();
			$empresa = array(
			"idusuario" => $idusuario,
			"nome_empresa" => $this->input->post("nomeempresa"),
			"telefone " => $this->input->post("telefone"),
			"cnpj" => $this->input->post("cnpj"),
			"tipoempresa" => $this->input->post("tipoempresa"),		
			"tipocontaempresa" => $this->input->post("tipocontaempresa"),
			"sincronizacaoEntradaAplicativo" => $this->input->post("sincronizacaoEntradaAplicativo")			

		);
			
				
			if ($this->input->post("tipo_formulario") != 'edicao') {
			
		//	echo $this->input->post("tipo_formulario");
			//die();
				$this->empresa_model->salva($empresa);
				
					$ultimaEmpresaInserida = $this->empresa_model->buscaEmpresaInserida($idusuario);
					$empresaVincular =  $ultimaEmpresaInserida['id'];
					
					$usuarioEmpresa = array(
					"idusuario" => $idusuario,
					"loginApp" => $acessar_aplicativo,
					"loginsistema" => 'S',			
					"idempresa" => $empresaVincular);
					
					$this->empresa_model->salvaUsuarioEmpresa($usuarioEmpresa);
					
					$this->empresa_model->deletarIdFicticiaInserida($idusuario);
					
			} else {
			
				$this->empresa_model->atualiza_empresa($empresa, $this->input->post("idempresa"));
				
				$dados_retirada_usuario = array("usuario_master" => "N");
				$this->empresa_model->retira_ultimo_master_empresa($this->input->post("idempresa"), $dados_retirada_usuario);
				
				 $dados_inclusao_usuario_master = array(
						"usuario_master" => "S");
			
				$this->empresa_model->atualiza_usuario_master($this->input->post("idempresa"), $this->input->post("usuario_master"), $dados_inclusao_usuario_master);
			
			$this->session->set_flashdata("success", "Empresa criada com sucesso");
			redirect('geral/home');
	
	
	
	
	}

	}

	function inserirFoto($idEmpresa) {
		autoriza ();
	
		$dados = array (
				"idEmpresa" => $idEmpresa,
				"error" => ''
		);
		
		$this->load->view ( 'empresa/inserirFoto', $dados );
	}
	
	
}
