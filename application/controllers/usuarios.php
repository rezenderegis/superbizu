<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'Não é permitido acesso direto ao site!' );
class Usuarios extends CI_Controller {
	
	public function index() {
		$this->load->model ( "usuarios_model" );
		
		$usuariosEmpresa = $this->usuarios_model->buscaUsuariosEmpresa ( $this->session->userdata ( "idempresa" ), 0, 0 );
		
		$usuarios = array (
				"usuarios" => $usuariosEmpresa 
		);
		
		$this->load->template2 ( "usuarios/index.php", $usuarios );
	}
	public function listaAlunos() {
		
		// die();
		$this->load->model ( "usuarios_model" );
		
		$usuariosEmpresa = $this->usuarios_model->buscaUsuariosPorEmpresa ( $this->session->userdata ( "idempresa" ), 0, 0, 0, 3 );
		
		$usuarios = array (
				"usuarios" => $usuariosEmpresa 
		);
		
		$this->load->template2 ( "usuarios/listaAlunos", $usuarios );
	}
	public function listaProfessores() {
		$this->load->model ( "usuarios_model" );
		
		$usuariosEmpresa = $this->usuarios_model->buscaUsuariosPorEmpresa ( $this->session->userdata ( "idempresa" ), 0, 0, 0, 2 );
		
		$usuarios = array (
				"usuarios" => $usuariosEmpresa 
		);
		
		$this->load->template2 ( "usuarios/listaProfessores", $usuarios );
	}
	
	/*
	 * Adiciona um novo aluno a escolha
	 */
	public function adicionarUsuario() {
		$this->load->library ( "form_validation" );
		if ($this->input->post ( "tipoUsuarioInserir" ) == 3) {
			
			// Se o tipo do usuario inserido for aluno
			$this->form_validation->set_rules ( "email", "email", "required|callback_verificaAlunoExisteEmpresa" ); // REGRA PARA O CAMPO NOME LABEL NOME
		}
		if ($this->input->post ( "tipoUsuarioInserir" ) == 2) {
			// Se o tipo do usuario inserido for professor
			$this->form_validation->set_rules ( "email", "email", "required|callback_verificaProfessorExisteEmpresa" ); // REGRA PARA O CAMPO NOME LABEL NOME
		}
		
		$this->form_validation->set_rules ( "nome", "nome", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME
		
		$sucesso = $this->form_validation->run ();
		
		$this->load->model ( "usuarios_model" );
		$this->load->model ( "empresa_model" );
		
		// Só entra se o usuário não existir na empresa no perfil de aluno
		if ($sucesso) {
			
			if ($this->session->userdata ( 'idempresa' ) != null) {
				
				$idempresa = $this->session->userdata ( 'idempresa' );
			} else {
				$idempresa = 0;
			}
			
			// Verifica o id do usuário para adicionar o perfil
			$idusuarioNovo = $this->usuarios_model->buscaPorEmail ( $this->input->post ( "email" ) );
			
			if (count ( $idusuarioNovo ) != 0) {
				
				$idusuarioNovo = $idusuarioNovo ['id'];
			} else {
				
				$usuario = array (
						"nome" => $this->input->post ( "nome" ),
						"email" => trim ($this->input->post ( "email" )),
						"idempresa" => $idempresa,
						"senha" => md5 ( trim ( $this->input->post ( "email" ) ) ) 
				);
				
				// $this->load->database();
				
				$this->usuarios_model->salva ( $usuario );
				
				$idusuarioBanco = $this->usuarios_model->bucaUltimoUsuarioInseridoEmpresa ( $idempresa );
				
				$idusuarioNovo = $idusuarioBanco ['id'];
			}
			
			$login = "";
			if ($this->input->post ( "tipoUsuarioInserir" ) == 3) {
				// Tipo 3 é aluno, tipo 2 é professor
				$login = "N";
			} else if ($this->input->post ( "tipoUsuarioInserir" ) == 2) {
				$login = "S";
			}
			
			// Insere o usuário na empresa no perfil de aluno
			$insereUsuarioEmpresa = array (
					"idusuario" => $idusuarioNovo,
					"idempresa" => $idempresa,
					"loginSistema" => $login 
			);
			
			$this->usuarios_model->insereUsuarioEmpresa ( $insereUsuarioEmpresa );
			$ultimoUsuarioEmpresaInserida = $this->empresa_model->buscaUltimoUsuarioEmpresaInserida ( $idusuarioNovo );
			
			$this->load->model ( "usuarios_model" );
			
			$this->usuarios_model->salvaPerfil ( $ultimoUsuarioEmpresaInserida ['id'], $this->input->post ( "tipoUsuarioInserir" ) );
			$tipoCadastroConta = "";
			if ($this->input->post ( "tipoUsuarioInserir" ) == 2) {
				$tipoCadastroConta = "PROFESSOR_ADICIONADO_POR_ESCOLA";
			} else if ($this->input->post ( "tipoUsuarioInserir" ) == 3) {
				$tipoCadastroConta = "ALUNO_ADICIONADO_POR_PROFESSOR";
			}
			
			//$this->enviar_email_criacao_conta ( $idusuarioNovo, $tipoCadastroConta );
			
			$this->session->set_flashdata ( "success", "Usuario salvo com sucesso!" );
			
			if ($this->input->post ( "tipoUsuarioInserir" ) == 3) {
				redirect ( "usuarios/listaAlunos" );
			} else if ($this->input->post ( "tipoUsuarioInserir" ) == 2) {
				redirect ( "usuarios/listaProfessores" );
			}
		} else {
			
			if ($this->input->post ( "tipoUsuarioInserir" ) == 3) {
				$this->listaAlunos ();
			} else if ($this->input->post ( "tipoUsuarioInserir" ) == 2) {
				$this->listaProfessores ();
			}
		}
	}
	public function salvarNovoUsuarioNoSite() {
		// CARREGAR BIBLIOTECA DE VALIDA��O
		$this->load->library ( "form_validation" );
		
		$this->form_validation->set_rules ( "nome", "nome", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME
		
		if (! $this->input->post ( "id_usuario" )) {
			// N�o deve entrar aqui na edi��o de usu�rio
			$this->form_validation->set_rules ( "email", "email", "required|callback_usuarioDuplicadoNaEmpresa" ); // REGRA PARA O CAMPO NOME LABEL NOME
		}
		$this->form_validation->set_rules ( "senha", "senha", "required|min_length[3]" ); // REGRA PARA O CAMPO NOME LABEL NOME
		
		$sucesso = $this->form_validation->run ();
		
		$this->load->model ( "usuarios_model" );
		
		$idempresa = '';
		if ($sucesso) {
			
			if ($this->session->userdata ( 'idempresa' ) != null) {
				
				$idempresa = $this->session->userdata ( 'idempresa' );
			} else {
				$idempresa = 0;
			}
			
			$usuario = array (
					"nome" => $this->input->post ( "nome" ),
					"email" => trim ($this->input->post ( "email" )),
					"senha" => md5 ( trim ($this->input->post ( "senha" )) ),
					"idempresa" => $idempresa 
			);
			
			// $this->load->database();
			
			if ($this->input->post ( "id_usuario" )) {
				
				$this->usuarios_model->edita_usuario ( $usuario, $this->input->post ( "id_usuario" ) );
				$usuarioEmpresa = $this->usuarios_model->retornaPerfisUsuario ( $this->input->post ( "id_usuario" ) );
				
				$idUsuarioEmpresa = $usuarioEmpresa [0];
				$idUsuarioEmpresa = $idUsuarioEmpresa ['idusuarioempresa'];
				
				$this->usuarios_model->apagaPerfil ( $idUsuarioEmpresa );
				
				$this->usuarios_model->salvaPerfilUsuario ( $idUsuarioEmpresa, $this->input->post ( "perfil" ) );
			} else {
				
				$this->usuarios_model->salva ( $usuario );
				$idusuarioBanco = $this->usuarios_model->bucaUltimoUsuarioInseridoEmpresa ( $idempresa );
				// $idusuarioNovo = $this->usuarios_model->buscaPorEmail ( $this->input->post ( "email" ), 0 );
				
				$idusuarioNovo = $idusuarioBanco ['id'];
				
				$this->load->model ( "empresa_model" );
				
				// Desabilitado dia 07/06/2017 por conta do erro de conexão no servidor de email do google.
				$this->enviar_email_criacao_conta ( $idusuarioNovo );
				/*
				 * Adicionado em 17-11-2014. Cadastra a empresa com o mesmo nome do usu�rio Se o usu�rio for novo, cadastra a empresa com o mesmo nome do usu�rio. No sistema o usu�rio dever� ser orientado a fazer a edi��o do nome da empresa
				 */
				
				$insereUsuarioEmpresa = array (
						"idusuario" => $idusuarioNovo,
						"idempresa" => $idempresa,
						"loginSistema" => "S" 
				);
				
				/*
				 * if ($this->input->post ( "id_usuario" )) { $this->usuarios_model->atualizaUsuarioEmpresa ( $insereUsuarioEmpresa, $this->input->post ( "id_usuario" ), $idempresa ); } else {
				 */
				$this->usuarios_model->insereUsuarioEmpresa ( $insereUsuarioEmpresa );
				$ultimoUsuarioEmpresaInserida = $this->empresa_model->buscaUltimoUsuarioEmpresaInserida ( $idusuarioNovo );
				
				$this->load->model ( "usuarios_model" );
				
				// INSERE PERFIL PROFESSOR
				$this->usuarios_model->salvaPerfilUsuario ( $ultimoUsuarioEmpresaInserida ['id'], $this->input->post ( "perfil" ) );
				// }
			}
			
			$usuariosEmpresa = $this->usuarios_model->buscaUsuariosEmpresa ( $this->session->userdata ( "idempresa" ), 0, 0 );
			
			$usuarios = array (
					"usuarios" => $usuariosEmpresa 
			);
			
			$this->session->set_flashdata ( "success", "Usuario salvo com sucesso!" );
			
			redirect ( "geral/home/" . $this->session->userdata ( "idempresa" ) . "/3" );
		} else {
			
			redirect ( "usuarios/formularioUsuarioNoSite" );
		}
	}
	public function alterarConta() {
		// CARREGAR BIBLIOTECA DE VALIDA��O
		$this->load->library ( "form_validation" );
		
		$this->form_validation->set_rules ( "nome", "nome", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME
		
		if (! $this->input->post ( "id_usuario" )) {
			// N�o deve entrar aqui na edi��o de usu�rio
			$this->form_validation->set_rules ( "email", "email", "required|callback_usuarioDuplicadoNaEmpresa" ); // REGRA PARA O CAMPO NOME LABEL NOME
		}
		$this->form_validation->set_rules ( "senha", "senha", "required|min_length[3]" ); // REGRA PARA O CAMPO NOME LABEL NOME
		
		$sucesso = $this->form_validation->run ();
		
		$this->load->model ( "usuarios_model" );
		
		$idempresa = '';
		if ($sucesso) {
			
			if ($this->session->userdata ( 'idempresa' ) != null) {
				
				$idempresa = $this->session->userdata ( 'idempresa' );
			} else {
				$idempresa = 0;
			}
			
			$usuario = array (
					"nome" => $this->input->post ( "nome" ),
					"email" => trim ($this->input->post ( "email" )),
					"senha" => md5 ( trim ($this->input->post ( "senha" )) ),
					"idempresa" => $idempresa 
			);
			
			// $this->load->database();
			
			if ($this->input->post ( "id_usuario" )) {
				
				$this->usuarios_model->edita_usuario ( $usuario, $this->input->post ( "id_usuario" ) );
				$usuarioEmpresa = $this->usuarios_model->retornaPerfisUsuario ( $this->input->post ( "id_usuario" ) );
			}
			
			$usuariosEmpresa = $this->usuarios_model->buscaUsuariosEmpresa ( $this->session->userdata ( "idempresa" ), 0, 0 );
			
			$usuarios = array (
					"usuarios" => $usuariosEmpresa 
			);
			
			$this->session->set_flashdata ( "success", "Usuario salvo com sucesso!" );
			
			redirect ( "geral/home/" . $this->session->userdata ( "idempresa" ) . "/3" );
		} else {
			
			redirect ( "usuarios/formularioUsuarioNoSite" );
		}
	}
	public function alteracaoConta() {
		// tipo_abertura = 1: significa que a abertura foi do app
		$usuario = $this->session->userdata ['usuario_logado'];
		$idUsuarioLogado = $usuario ['id'];
		
		$this->load->model ( "usuarios_model" );
		
		$dados_edicao = 0;
		$perfisUsuario = 0;
		
		$dados_edicao = $this->usuarios_model->buscaUsuariosEmpresa ( 0, $idUsuarioLogado, 1 );
		
		$perfisUsuario = $this->usuarios_model->retornaPerfisUsuario ( $idUsuarioLogado );
		
		$usuario = array (
				"usuario_edicao" => $dados_edicao,
				"perfisUusario" => $perfisUsuario 
		);
		
		$this->load->template2 ( "usuarios/formularioAlteracaoConta", $usuario );
	}
	public function formularioUsuarioNoSite($id_usuario = 0, $tipo_acesso = 0) {
		// tipo_abertura = 1: significa que a abertura foi do app
		$this->load->model ( "usuarios_model" );
		
		$dados_edicao = 0;
		$perfisUsuario = 0;
		if ($id_usuario != 0) {
			
			$dados_edicao = $this->usuarios_model->buscaUsuariosEmpresa ( 0, $id_usuario, 1 );
			
			$perfisUsuario = $this->usuarios_model->retornaPerfisUsuario ( $id_usuario );
		}
		
		$usuario = array (
				"usuario_edicao" => $dados_edicao,
				"tipo_acesso" => $tipo_acesso,
				"perfisUusario" => $perfisUsuario 
		);
		
		$this->load->template2 ( "usuarios/formularioUsuarioNoSite", $usuario );
	}
	
	/*
	 * Controller da criação de usuário fora do site.
	 */
	public function novoUsuario($id_usuario = 0, $tipo_acesso = 0) {
		// tipo_abertura = 1: significa que a abertura foi do app
		// verificarAcessoSite();
		$this->load->model ( "usuarios_model" );
		
		$dados_edicao = 0;
		$perfisUsuario = 0;
		if ($id_usuario != 0) {
			
			$dados_edicao = $this->usuarios_model->buscaUsuariosEmpresa ( 0, $id_usuario, 1 );
			
			$perfisUsuario = $this->usuarios_model->retornaPerfisUsuario ( $id_usuario );
		}
		$usuario = array (
				"usuario_edicao" => $dados_edicao,
				"tipo_acesso" => $tipo_acesso,
				"perfisUusario" => $perfisUsuario 
		);
		
		$this->load->view ( "usuarios/usuarioNovo", $usuario );
	}
	public function novo() {
		// CARREGAR BIBLIOTECA DE VALIDA��O
		$this->load->library ( "form_validation" );
		
		// ADICIONAR UMA REGRA DE VALIDA��O
		
		$this->form_validation->set_rules ( "nome", "nome", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME
		
		if (! $this->input->post ( "id_usuario" )) {
			
			$this->form_validation->set_rules ( "email", "email", "required|callback_usuarioDuplicado" ); // REGRA PARA O CAMPO NOME LABEL NOME
		}
		$this->form_validation->set_rules ( "senha", "senha", "required|min_length[3]" ); // REGRA PARA O CAMPO NOME LABEL NOME
		
		$sucesso = $this->form_validation->run ();
		
		$this->load->model ( "usuarios_model" );
		
		$idempresa = '';
		if ($sucesso) {
			
			if ($this->session->userdata ( 'idempresa' ) != null) {
				
				$idempresa = $this->session->userdata ( 'idempresa' );
			} else {
				$idempresa = 0;
			}
			
			$usuario = array (
					"nome" => $this->input->post ( "nome" ),
					"email" => trim ($this->input->post ( "email" )),
					"senha" => md5 ( trim ($this->input->post ( "senha" )) ),
					"idempresa" => $idempresa 
			);
			
			// $this->load->database();
			
			$this->usuarios_model->salva ( $usuario );
			
			// Busca �ltimo id do usu�rio inserido para vincular a empresa
			$idusuarioBanco = $this->db->insert_id (); // Essa função do codeigniter pega o último id inserido
			
			$this->load->model ( "empresa_model" );
			
			// Envia e-mail ap�s cria��o de um novo usu�rio
			$tipoCadastroConta = "";
			
			if ($this->input->post ( "perfil" ) == 2) {
				$tipoCadastroConta = "PROFESSOR_FEZ_PROPRIO_CADASTRO";
			} else if ($this->input->post ( "perfil" ) == 3) {
				$tipoCadastroConta = "ALUNO_FEZ_PROPRIO_CADASTRO";
			}
			
			$this->enviar_email_criacao_conta ( $idusuarioBanco, $tipoCadastroConta );
			
			/*
			 * Adicionado em 17-11-2014. Cadastra a empresa com o mesmo nome do usu�rio Se o usu�rio for novo, cadastra a empresa com o mesmo nome do usu�rio. No sistema o usu�rio dever� ser orientado a fazer a edi��o do nome da empresa
			 */
			
			if ($this->session->userdata ( 'idempresa' ) == '' && $this->input->post ( "perfil" ) != 3) {
				
				$empresa = array (
						"idusuario" => $idusuarioBanco,
						"nome_empresa" => $this->input->post ( "nome" ),
						"tipoempresa" => 3,
						"tipocontaempresa" => 2 
				);
				// echo $idempresa;
				
				$this->empresa_model->salva ( $empresa );
				
				// TODO
				$ultimaEmpresaInserida = $this->empresa_model->buscaEmpresaInserida ( $idusuarioBanco );
				$idempresa = $ultimaEmpresaInserida ['id'];
				
				// Fim cadatro empresa com o mesmo nome do usu�rio
			}
			
			if ($this->input->post ( "perfil" ) == 3) {
				// Inscreve o aluno por padrão no Paulo
				$this->load->model ( "usuarios_model" );
				$this->usuarios_model->inserirDadosPadrao ( $idusuarioBanco );
			}
			
			$usuario_master = 'N';
			
			$perfil = 0;
			if ($this->input->post ( "perfil" ) != 3) {
				$perfil = 2;
				$insereUsuarioEmpresa = array (
						"idusuario" => $idusuarioBanco,
						"idempresa" => $idempresa,
						"loginSistema" => "S",
						"usuario_master" => "S" 
				);
				
				$this->usuarios_model->insereUsuarioEmpresa ( $insereUsuarioEmpresa );
				
				$ultimoUsuarioEmpresaInserida = $this->db->insert_id (); // Essa função do codeigniter pega o último id inserido
				
				$this->load->model ( "usuarios_model" );
				
				// INSERE PERFIL PROFESSOR
				$this->usuarios_model->salvaPerfil ( $ultimoUsuarioEmpresaInserida, $perfil );
			}
			
			$this->session->set_flashdata ( "success", "Usuario salvo com sucesso!" );
			
			/*
			 * Esse trecho de c�digo verifica se o usu�rio est� logado. Se estiver logado, ap�s o cadastramento, � redirecionado para a tela de consulta de usu�rios da sua empresa. Caso contr�rio, � redirecionado para a tela de login.
			 */
			
			if ($this->session->userdata ( 'idempresa' ) != null) {
				$usuariosEmpresa = $this->usuarios_model->buscaUsuariosEmpresa ( $this->session->userdata ( "idempresa" ), 0, 0 );
				
				$usuarios = array (
						"usuarios" => $usuariosEmpresa 
				);
				
				$this->load->template2 ( "usuarios/index", $usuarios );
			} else {
				redirect ( '/' );
			}
		} else {
			
			$this->novoUsuario ();
		}
	}
	public function novoAluno($id_usuario = 0, $tipo_acesso = 0) {
		// tipo_abertura = 1: significa que a abertura foi do app
		$this->load->model ( "usuarios_model" );
		
		$dados_edicao = 0;
		$perfisUsuario = 0;
		if ($id_usuario != 0) {
			
			$dados_edicao = $this->usuarios_model->buscaUsuariosEmpresa ( 0, $id_usuario, 1 );
			
			$perfisUsuario = $this->usuarios_model->retornaPerfisUsuario ( $id_usuario );
		}
		$usuario = array (
				"usuario_edicao" => $dados_edicao,
				"tipo_acesso" => $tipo_acesso,
				"perfisUusario" => $perfisUsuario 
		);
		
		if ($tipo_acesso == 0) {
			$this->load->template2 ( "usuarios/alunoNovo", $usuario );
		} else {
			$this->load->template2Celular ( "usuarios/usuarioNovoAplicativo", $usuario );
		}
	}
	public function verificaProfessorExisteEmpresa($email) {
		
		// echo "sfalsdfasdfçasdf: s".$email;
		$this->load->model ( "usuarios_model" );
		$usuarioEmail = $this->usuarios_model->verificaExisteUsuario ( $email, 2 );
		// echo "<br/>";
		// print_r($usuarioEmail['id']);
		// die();
		if ($usuarioEmail) {
			
			$this->form_validation->set_message ( "verificaProfessorExisteEmpresa", "Ja existe um professor cadastrado com esse email" );
			
			return FALSE;
		} else {
			// $this->form_validation->set_message("usuarioduplicado", "J� existe um usu�rio cadastrado com esse email");
			return TRUE;
		}
	}
	public function verificaAlunoExisteEmpresa($email) {
		
		// echo "sfalsdfasdfçasdf: s".$email;
		$this->load->model ( "usuarios_model" );
		$usuarioEmail = $this->usuarios_model->verificaExisteUsuario ( $email, 3 );
		// echo "<br/>";
		// print_r($usuarioEmail['id']);
		// die();
		if ($usuarioEmail) {
			
			$this->form_validation->set_message ( "verificaAlunoExisteEmpresa", "Ja existe um aluno cadastrado com esse email" );
			
			return FALSE;
		} else {
			// $this->form_validation->set_message("usuarioduplicado", "J� existe um usu�rio cadastrado com esse email");
			return TRUE;
		}
	}
	public function usuarioDuplicadoNaEmpresa($email) {
		
		// echo "sfalsdfasdfçasdf: s".$email;
		$this->load->model ( "usuarios_model" );
		$usuarioEmail = $this->usuarios_model->verificaExisteUsuarioQualquerPerfilNaEmpresa ( $email );
		// echo "<br/>";
		// print_r($usuarioEmail['id']);
		// die();
		if ($usuarioEmail) {
			
			$this->form_validation->set_message ( "usuarioDuplicado", "Ja existe um usuário cadastrado com esse email" );
			
			return FALSE;
		} else {
			// $this->form_validation->set_message("usuarioduplicado", "J� existe um usu�rio cadastrado com esse email");
			return TRUE;
		}
	}
	public function usuarioDuplicado($email) {
		
		// echo "sfalsdfasdfçasdf: s".$email;
		$this->load->model ( "usuarios_model" );
		$usuarioEmail = $this->usuarios_model->verificaExisteUsuario ( $email );
		// echo "<br/>";
		// print_r($usuarioEmail['id']);
		// die();
		if ($usuarioEmail) {
			
			$this->form_validation->set_message ( "usuarioDuplicado", "Ja existe um usu�rio cadastrado com esse email" );
			
			return FALSE;
		} else {
			// $this->form_validation->set_message("usuarioduplicado", "J� existe um usu�rio cadastrado com esse email");
			return TRUE;
		}
	}
	function formulario_esqueceu_senha() {
		$this->load->view ( "usuarios/formulario_esqueceu_senha" );
	}
	function solicitar_alteracao_senha() {
		$this->load->model ( "usuarios_model" );
		$email = $this->usuarios_model->buscaPorEmail ( $this->input->post ( "email" ), '' );
		
		if ($email) {
			
			$this->load->model ( "email_model" );
			$this->email_model->enviar ( $this->input->post ( "email" ), $this->input->post ( "nome" ) );
			
			$this->session->unset_userdata ( "usuario_logado" );
			$this->session->unset_userdata ( "idempresa" );
			$this->session->unset_userdata ( "login" );
			
			$this->session->set_flashdata ( "success", "Solicitação efetuada com sucesso! Siga as instruções no seu e-mail." );
			
			redirect ( 'geral/index' );
		} else {
			$this->session->set_flashdata ( "success", "E-mail não cadastrado na base do BySale!" );
			
			redirect ( 'usuarios/formulario_esqueceu_senha' );
		}
	}
	
	/*
	 * FORMULÁRIO DE ALTERAÇÃO DE SENHA ESQUECIDA
	 * */
	function alterar_senha($id_usuario=0, $codigo=0) {
		$this->load->model ( "usuarios_model" );
		$email = $this->usuarios_model->buscaPorEmail ( '', $id_usuario );
		//print_r($email); die();
		
		//$codigo_senha = md5 ( $id_usuario . $email ['email'] );
		
		//if ($codigo == $codigo_senha) {
			$dados_cliente = array (
					"dados_pessoa_edicao" => $id_usuario 
			);

			$this->load->view( "usuarios/formularioCadastrarNovaSenha", $dados_cliente);
		
			//$this->load->template2 ( "usuarios/formulario_alteracao_senha", $dados_cliente );
	//	} else {
		//	echo "Aconteceu um problema ao alterar sua senha";
	//	}
		
	}
	function mudar_senha($id_usuario) {
		//echo $this->input->post ( "senha" ); die();
		$this->load->model ( "usuarios_model" );
		$dados = array (
				"senha" => md5 ( $this->input->post ( "senha" ) ) 
		);
		
		$this->usuarios_model->mudar_senha ( $dados, $id_usuario );
		$this->session->set_flashdata ( "success", "Senha alterada com sucesso" );
		
		// limpar se��o
		$this->session->unset_userdata ( "usuario_logado" );
		$this->session->unset_userdata ( "idempresa" );
		$this->session->unset_userdata ( "login" );
		$this->session->set_flashdata ( "success", "Senha alterada com sucesso!" );
		redirect ( 'geral/index' );
		// $this->load->template2("geral/index");
	}
	public function enviar_email_criacao_conta($id_usuario, $tipoCadastroConta) {
		/*$this->load->model ( "usuarios_model" );
		$email = $this->usuarios_model->buscaPorEmail ( '', $id_usuario );
		
		$this->load->model ( "email_model" );*/
		//$this->email_model->enviar_email_criacao_conta ( $email ['email'], $tipoCadastroConta );
		
		return null;
	}
	function inserirFoto($idUsuario) {
		autoriza ();
		
		$dados = array (
				"idUsuario" => $idUsuario,
				"error" => '' 
		);
		$this->load->view ( 'usuarios/inserirFoto', $dados );
	}
	public function trazPerfilUsuario($idUsuario) {
		$this->load->model ( "usuarios_model" );
		
		$perfisUsuario = $this->usuarios_model->retornaPerfisUsuario ( $idUsuario );
		
		$perfilRetorno = array ();
		foreach ( $perfisUsuario as $perfil ) {
			
			array_push ( $perfilRetorno, $perfil ['nomeperfil'] );
		}
		
		return implode ( ",", $perfilRetorno );
	}
}
