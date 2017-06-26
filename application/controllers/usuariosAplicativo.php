<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'N�o � permitido acesso direto ao site!' );
class UsuariosAplicativo extends CI_Controller {
	
	
	
	public function novoUsuarioDoAplicativo($nome,$email,$senha) {
		// CARREGAR BIBLIOTECA DE VALIDA��O
		
		
		$this->load->model ( "usuarios_model" );
		
		$idempresa = 2;

			//id empresa do bizu para o caso de aluno
			$usuario = array (
					"nome" => $nome,
					"email" => $email,
					"senha" => $senha,
					"idempresa" => $idempresa 
			);
			
		
				$this->usuarios_model->salva ( $usuario );
				$idusuarioNovo =  $this->db->insert_id();//Essa função do codeigniter pega o último id inserido
				
				
				
				//Inscreve o aluno por padrão no Paulo
				$this->load->model("usuarios_model");
				$this->usuarios_model->inserirDadosPadrao($idusuarioNovo);
				
				$this->load->model("email_model");
				$this->email_model->enviar_email_criacao_conta($email, "ALUNO_FEZ_PROPRIO_CADASTRO_APLICATIVO");
				
			
	}
	
	
	public function cadastraUsuarioNativo () {
		
		
		$json = file_get_contents ( 'php://input' );
		$parsed = json_decode ( $json, true );
		//file_put_contents("codeIgniter.txt",">>>> ".$parsed['usuario']."novo vvv>>>>".print_r($_REQUEST)." POST".print_r($_POST, true)."\n",FILE_APPEND);
		
		if (array_key_exists ( "usuario", $parsed )) {
		
			foreach ( $parsed ['usuario'] as $key => $values ) {
		
				$email = $values ['email'];
		
				$senha = md5 ( $values ['password'] );
		
				$nome = $values ['nome_usuario'];
		
				$this->load->model("usuarios_model");
				
				$usuarioExiste = $this->usuarios_model->buscaPorEmail($email);
		
				if ($usuarioExiste != null) {
		
					// OBJETO JSON FUNCIONANDO
					$encode = array (
							"userdetails" => array (
									array (
											"acesso" => "U",
											"email" => $email
									)
							)
					);
					$json_encode = json_encode ( $encode );
					header('Content-Type: application/json');
						
					print_r( $json_encode) ;
				} else {
		
						
					$this->novoUsuarioDoAplicativo($nome, $email, $senha);
						
						
					$tipo_retorno = "T";
					$usuarioExiste = $this->usuarios_model->buscaPorEmail($email);
						
						
					if ($usuarioExiste == null) {
						$tipo_retorno = "F";
					}
						
						
					$encode = array (
							"userdetails" => array (
									array (
											"acesso" => $tipo_retorno,
											"email" => $email
									)
							)
					);
						
					$json_encode = json_encode ( $encode );
					header('Content-Type: application/json');
						
					print_r( $json_encode) ;
					
				}
			}
		}
		
	}
	
	
}
