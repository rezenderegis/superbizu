<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'Não é permitido acesso direto ao site!' );
class cadastroUsuario extends CI_Controller {

	public function formularioCadastroUsuario($cadastroDoSite=false) {

		$dados = array("cadastroDoSite" => $cadastroDoSite);
		
		$this->load->view ( "usuarios/formularioCadastroUsuario", $dados);
	}
	
	
	public function salvarUsuario() {

		$this->load->library ( "form_validation" );
		
		$this->form_validation->set_rules ( "nome", "nome", "required" ); 
				
		$this->form_validation->set_rules ( "email", "email", "required|callback_usuarioDuplicado" ); // REGRA PARA O CAMPO NOME LABEL NOME
			
		$this->form_validation->set_rules ( "senha", "senha", "required|min_length[3]" ); // REGRA PARA O CAMPO NOME LABEL NOME
				
		$sucesso = $this->form_validation->run ();
				
		$this->load->model ( "usuarios_model" );
		
		$usuarioEmail = $this->usuarios_model->verificaUsuarioExiste( trim ($this->input->post ( "email" )));
			
			if ($sucesso) {
				
				$usuario = array (
						"nome" => $this->input->post ( "nome" ),
						"email" => trim ($this->input->post ( "email" )),
						"senha" => md5 ( trim ($this->input->post ( "senha" )) ),
				);
				
				$this->usuarios_model->salva ( $usuario );
				
				$idusuarioBanco = $this->db->insert_id (); // Essa função do codeigniter pega o último id inserido
				
				$this->load->model ( "empresa_model" );
				
				
				// Enviar e-mail após criação da conta
				$tipoCadastroConta = "";
				
				if ($this->input->post ( "perfil" ) == 2) {
					$tipoCadastroConta = "PROFESSOR_FEZ_PROPRIO_CADASTRO";
				} else if ($this->input->post ( "perfil" ) == 3) {
					$tipoCadastroConta = "ALUNO_FEZ_PROPRIO_CADASTRO";
				}
				
				$this->enviar_email_criacao_conta ( $idusuarioBanco, $tipoCadastroConta );
				
				$idEmpresa = "";
				
				if ($this->input->post ( "perfil" ) != 3) {
					
					$idEmpresa = $this->adicionaContaUsuario($idusuarioBanco, $this->input->post ( "nome" ));
					
				}
				
					
				$this->salvaPerfilUsuarios($idusuarioBanco, $this->input->post ( "perfil" ), $idEmpresa);
				
			
				if ($this->input->post("cadastroDoSite") == true) {
					
					redirect ( '/' );
					
				} else {
					
					$this->session->set_flashdata ( "success", "Sucesso! </br>
												Pressione botão voltar para ir ao APLICATIVO.");
					
					//$this->formularioCadastroUsuario();
					redirect ( 'cadastroUsuario/formularioCadastroUsuario' );
					
				}
				

			} else {
				
				$this->formularioCadastroUsuario($this->input->post("cadastroDoSite"));
			}
	}
	
	public function adicionaContaUsuario($idusuarioBanco, $nomeUsuario) {
		
		$empresa = array (
				"idusuario" => $idusuarioBanco,
				"nome_empresa" => $nomeUsuario,
				"tipoempresa" => 3,
				"tipocontaempresa" => 2
		);
		
		$this->empresa_model->salva ( $empresa );
		
		// TODO
		$ultimaEmpresaInserida = $this->empresa_model->buscaEmpresaInserida ( $idusuarioBanco );
		$idempresa = $ultimaEmpresaInserida ['id'];
		
		return $idempresa;
	}
	
	public function salvaPerfilUsuarios($idUsuario, $idPerfil, $idEmpresa) {
		
		
		if ($idPerfil == 3) {
			// Inscreve o aluno por padrão no Paulo
			$this->load->model ( "usuarios_model" );
			
			
			//Produção
			$idEmpresaPadrao = 112;
			$idGrupoPadrao = 48;
		
			/*
			 //Desenvolvimento
			$idEmpresaPadrao = 105;
			$idGrupoPadrao = 40;
			 */
			
			$this->usuarios_model->inserirDadosPadrao ( $idUsuario, $idEmpresaPadrao, $idGrupoPadrao);
		}
		
		
		$perfil = 0;
		
		if ($idPerfil!= 3) {
			$perfil = 2;
			$insereUsuarioEmpresa = array (
					"idusuario" => $idUsuario,
					"idempresa" => $idEmpresa,
					"loginSistema" => "S",
					"usuario_master" => "S"
			);
			
			$this->usuarios_model->insereUsuarioEmpresa ( $insereUsuarioEmpresa );
			
			$ultimoUsuarioEmpresaInserida = $this->db->insert_id (); // Essa função do codeigniter pega o último id inserido
			
			$this->load->model ( "usuarios_model" );
			
			// INSERE PERFIL PROFESSOR
			$this->usuarios_model->salvaPerfil ( $ultimoUsuarioEmpresaInserida, $perfil );
		}
		
	}

	public function enviar_email_criacao_conta($id_usuario, $tipoCadastroConta) {
		/*$this->load->model ( "usuarios_model" );
		 $email = $this->usuarios_model->buscaPorEmail ( '', $id_usuario );
		 
		 $this->load->model ( "email_model" );*/
		//$this->email_model->enviar_email_criacao_conta ( $email ['email'], $tipoCadastroConta );
		
		return null;
	}
	
	
	
	//FIM MÉTODOS PADRÃO DE CRIAÇÃO DE CONTA DE USUÁRIO
	
	
	public function usuarioDuplicado() {
		
		$this->load->model ( "usuarios_model" );
		$usuarioEmail = $this->usuarios_model->buscaPorEmail( $this->input->post ( "email" ));
		//echo $usuarioEmail; die();
		
		if ($usuarioEmail == 0) {
						
			return true;
		} else {
			 $this->form_validation->set_message("usuarioDuplicado", "Já existe um usuário cadastrado com esse email");
			return false;
		}
	}
	
}
