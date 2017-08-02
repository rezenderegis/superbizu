<?php 

class Usuarios_model extends CI_Model {

	public function salva($usuario) {
	
		$this->db->insert("usuario", $usuario);
	
	}
	
	public function edita_usuario($dados, $id_usuario) {
		$this->db->where("usuario.id", $id_usuario);
		$this->db->update("usuario", $dados);
	}

	/*
	public function buscaPorEmailESenha($email, $senha) {
		$this->db->where("email", $email);
		$this->db->where("senha", $senha);

		$usuario = $this->db->get("usuario")->row_array();
		
		return $usuario;
	}
*/

	public function buscaPorEmailESenha($email, $senha) {
	
	
		$this->db->select("usuario.email as email, usuario.senha as senha, usuario.nome as nome, usuario.id as id, usuario.nome_foto_sistema");
		$this->db->from("usuario");
		$this->db->join("usuario_empresa", "usuario_empresa.idusuario = usuario.id");
		$this->db->where("usuario.email",  $email);
		$this->db->where("usuario.senha",  $senha);
		//$this->db->where("usuario_empresa.loginsistema", 'S');

		$usuario = $this->db->get()->row_array();
		
		return $usuario;
	}
	
	public function buscaEmpresasUsuario ($idusuario) {
		
		$this->db->select("usuario_empresa.idempresa, empresa.nome_empresa");
		$this->db->from("usuario");
		$this->db->join("usuario_empresa", "usuario.id = usuario_empresa.idusuario");
		$this->db->join("empresa", "empresa.idempresa = usuario_empresa.idempresa");
		
		$this->db->join("perfil_usuario", "perfil_usuario.idusuarioempresa = usuario_empresa.idusuarioempresa");
		//$this->db->where("perfil_usuario.idperfil", 2);
		
		$this->db->where("usuario.id", $idusuario);
	
		
		return $this->db->get()->result_array();
		
		
	}
	
	
	
	/**
	 * O m�todo bucaUltimoUsuarioInseridoEmpresa traz o �ltimo usu�rio inserido para uma determinada empresa. 
	 * Como ele � utilizado, tamb�m, para usu�rios novos, se for novo, o $idempresa � igual a 0, como � o �ltimo usu�iro
	 * inserido, retornar� sempre esse �ltimo usu�rio.
	 * 
	 */
	public function bucaUltimoUsuarioInseridoEmpresa ($idempresa) {
		
		
		$this->db->select("max(usuario.id) as id");
		$this->db->from("usuario");
		$this->db->where("usuario.idempresa", $idempresa);
		
		return $this->db->get()->row_array(0);
			
	}
	
	public function insereUsuarioEmpresa($idusuarioempresa) {
	
				$this->db->insert("usuario_empresa", $idusuarioempresa);

	}
	
	
	public function buscaUsuariosPorEmpresa($idempresa, $id_usuario, $tipo_busca=0, $complemento=0, $tipoPerfilBuscar=0) {
	
		//$complemento = 1 -> traz somente usuarios que podem logar no aplicativo
	
		$this->db->select("usuario.*,usuario_empresa.loginapp, usuario_empresa.loginsistema, usuario_empresa.usuario_master");
		$this->db->from("usuario");
		$this->db->join("usuario_empresa", "usuario_empresa.idusuario = usuario.id");
		$this->db->join("perfil_usuario", "perfil_usuario.idusuarioempresa = usuario_empresa.idusuarioempresa");
		
		$this->db->where("usuario_empresa.idusuario = usuario.id");
		if ($tipoPerfilBuscar != 0) {
			$this->db->where("perfil_usuario.idperfil", $tipoPerfilBuscar);
		}
		
		$this->db->where("usuario_empresa.idempresa", $idempresa);
		
		if ($tipo_busca == 1) {
	
			$this->db->where("usuario.id", $id_usuario);
			return $this->db->get()->row_array();
	
		} 
			
			return $this->db->get()->result_array();
		
	
	
	
	}
	
	
	public function buscaUsuariosEmpresa($idempresa, $id_usuario, $tipo_busca=0, $complemento=0) {
	
		//$complemento = 1 -> traz somente usuarios que podem logar no aplicativo
		
		$this->db->select("usuario.*,usuario_empresa.loginapp, usuario_empresa.loginsistema, usuario_empresa.usuario_master");
		$this->db->from("usuario");
		$this->db->join("usuario_empresa", "usuario_empresa.idusuario = usuario.id");
		
		if ($tipo_busca == 1) {
		
			$this->db->where("usuario.id", $id_usuario);			
			return $this->db->get()->row_array();
				
		} else if ($idempresa && $complemento == 1) {
			$this->db->where("usuario_empresa.idempresa", $idempresa);
			$this->db->where("usuario_empresa.loginapp", 'S');
				
			return $this->db->get()->result_array();
		} else {
			$this->db->where("usuario_empresa.idempresa", $idempresa);
				
			return $this->db->get()->result_array();
		}
		
		
	
	}
	
	
	public function verificaExisteUsuarioQualquerPerfilNaEmpresa($usuario) {
	
	$idempresa = $this->session->userdata ( 'idempresa' );
		
			$this->db->select("u.id as id");
			$this->db->from("usuario u");
			$this->db->join("usuario_empresa ue", "ue.idusuario = u.id");
			$this->db->where("u.email", $usuario);
			$this->db->where("ue.idempresa", $idempresa);
			$idusuario = $this->db->get()->result_array();
			if ($idusuario != null) {
					$idusuarioExiste = $idusuario[0];
				
					return $idusuarioExiste = $idusuarioExiste["id"];
					
			} else {
				
				return false;
				
			}
			
			
			
	
	}
	
	
	
	
	//Parei aqui. verificando o erro ao abrir a tela de usuário
	public function verificaExisteUsuario($usuario, $tipoBuscar=0) {
			/*
			 * Só não deve deixar criar um novo aluno se ele já existir na empresa com perfil aluno.
			 * 
			 * 
			 * */
		
			$idempresa = $this->session->userdata ( 'idempresa' );
		
			$this->db->select("u.id as id");
			$this->db->from("usuario u");
			$this->db->join("usuario_empresa ue", "ue.idusuario = u.id");
			$this->db->join("perfil_usuario pu", "pu.idusuarioempresa = ue.idusuarioempresa");
			$this->db->where("pu.idperfil", $tipoBuscar);
			$this->db->where("u.email", $usuario);
			$this->db->where("ue.idempresa", $idempresa);
			$idusuario = $this->db->get()->result_array();
			if ($idusuario != null) {
			
				return $idusuarioExiste = $idusuario[0]["id"];
					
			} else {
				
				return false;
				
			}
			
			
		
	}
	
	
	public function usuarioPossuiAcessoAppOutraEmpresa($id) {
		$this->db->select("usuario.id as id");
		$this->db->from("usuario");
		$this->db->join("usuario_empresa", "usuario.id = usuario_empresa.idusuario");
		$this->db->where("usuario.id", $id);
		$this->db->where("usuario_empresa.loginapp", 'S');	
		$this->db->where("usuario_empresa.idempresa != 0");
		$idusuario = $this->db->get()->result_array();
		
		if ($idusuario == null) {
				
			return 'N';
				
		} else {
		
			return 'S';
		
		}
		
	}
	
	
	public function buscaPerfilUsuario($idusuario, $idempresa) {
	
		//echo "empresa".$idempresa;
		//echo "usuario".$idusuario;
		
		$this->db->select("perfil_usuario.idperfil");
		$this->db->from("perfil_usuario");
		$this->db->join("usuario_empresa", "usuario_empresa.idusuarioempresa = perfil_usuario.idusuarioempresa");
		$this->db->where("usuario_empresa.idusuario", $idusuario);
		$this->db->where("usuario_empresa.idempresa", $idempresa);
		//print_r($this->db->get()->result_array());
		
		return $this->db->get()->result_array();
		
	}
		
	
	/*
	 * M�todo quantidadeEmpresaUsuario()
	 * Traz a quantidade empresas por usu�rio. 
	 * � utilizado como um dos par�metros para mostrar ou n�o a tela de pedidos como primeiro da tela.
	 * */
	public function quantidadeEmpresaUsuario($idusuario) {
	
		$this->db->select("count(idusuario) as idusuario, idempresa");
		$this->db->from("usuario_empresa");
		$this->db->join("perfil_usuario", "perfil_usuario.idusuarioempresa = usuario_empresa.idusuarioempresa");
		$this->db->where("idusuario", $idusuario);
		
		return $this->db->get()->row_array();
	}
	
	
	public function quantidadeEmpresaUsuarioPerfilDiferenteAluno($id) {
	
			$this->db->select("count(usuario_empresa.idusuario)");
			$this->db->from("usuario");
			$this->db->join("usuario_empresa", "usuario_empresa.idusuario = usuario.id");
			$this->db->join("perfil_usuario", "perfil_usuario.idusuarioempresa = usuario_empresa.idusuarioempresa");
			$this->db->where("usuario_empresa.idusuario = usuario.id");
			$this->db->where("perfil_usuario.idperfil", 2);

			return $this->db->get()->row_array();
	
		
	}
	
	/*
	 * M�todo quantidadePerfisUsuario
	 * Traz a quantidade de perfis de usuario para cada usu�rio
	 * 
	 * */
	
	public function quantidadePerfisUsuario($idusuario) {
		
		$this->db->select("count(perfil_usuario.idusuarioempresa) as qtd");
		$this->db->from("perfil_usuario");
		$this->db->join("usuario_empresa", "usuario_empresa.idusuarioempresa = perfil_usuario.idusuarioempresa");
		$this->db->where("usuario_empresa.idusuario", 204);
		$dados = $this->db->get()->row_array();
		$qtd = $dados['qtd'];
		return $qtd;
	}
	
	public function atualizaUsuarioEmpresa($dados, $id_usuario, $id_empresa) {
		
		$this->db->where("usuario_empresa.idusuario", $id_usuario);
		$this->db->where("usuario_empresa.idempresa", $id_empresa);
		$this->db->update("usuario_empresa", $dados);
	
	
	}
	
	public function buscaPorEmail($email='',$id='') {
		$email = trim($email);

		$this->db->select("usuario.email as email, usuario.nome as nome, usuario.id as id");
		$this->db->from("usuario");
	;

		
		if ($email != '') {
		
			$this->db->where("usuario.email",  $email);
		} 
		
		if ($id != '') {
			$this->db->where("usuario.id",  $id);
				
		}
	
		$usuario = $this->db->get()->row_array();
		if (empty($usuario)) {
			return 0;
		} else {
			return 1;
		}
		
	}
	
	public function mudar_senha($dados, $id_usuario) {
		//print_r($dados); echo "ID USUARIO".$id_usuario; die();
		$this->db->where("usuario.id", $id_usuario);
		$this->db->update("usuario", $dados);
		
	}
	
	public function salva_log_acesso($descricao = "", $id_questao="", $comentario = "") {
		
		$id_usuario_logado = $this->session->userdata['usuario_logado']['id'];
		
		$dados = array("id_usuario" => $id_usuario_logado, "descricao" => $descricao, "id_questao" => $id_questao, "comentario_questao" => $comentario);
		
		$this->db->insert("log_usuario", $dados);
		
		
	}
	
	public function trazAlunosPorEmpresa($idempresa) {

		//$complemento = 1 -> traz somente usuarios que podem logar no aplicativo
		
		$this->db->select("usuario.id, usuario.nome,usuario.email,usuario_empresa.loginapp, usuario_empresa.loginsistema, usuario_empresa.usuario_master");
		$this->db->from("usuario");
		$this->db->join("usuario_empresa", "usuario_empresa.idusuario = usuario.id");
		$this->db->join("perfil_usuario", "usuario_empresa.idusuarioempresa = perfil_usuario.idusuarioempresa");	
		$this->db->where("perfil_usuario.idperfil", 3);
		$this->db->where("usuario_empresa.idempresa", $idempresa);
		
		return $this->db->get()->result_array();
	
	}
	
	public function trazAlunosPorEmpresaForaGrupoEspecificado($idempresa, $idGrupo) {
		//$complemento = 1 -> traz somente usuarios que podem logar no aplicativo
		/*
		$this->db->select("usuario.id, usuario.nome,usuario.email,usuario_empresa.loginapp, usuario_empresa.loginsistema, usuario_empresa.usuario_master");
		$this->db->from("usuario");
		$this->db->join("usuario_empresa", "usuario_empresa.idusuario = usuario.id");
		$this->db->join("perfil_usuario", "usuario_empresa.idusuarioempresa = perfil_usuario.idusuarioempresa");
		$this->db->join("tb_aluno_grupo ag", "ag.idUsuario = usuario.id");
		$this->db->where("perfil_usuario.idperfil", 3);
		$this->db->where("ag.idEmpresa", $idempresa);
		$this->db->where("usuario_empresa.idempresa", $idempresa);
		$this->db->where("ag.idGrupo !=", 40);
		*/
		
		$sql = "
				SELECT usuario.id, usuario.nome, usuario.email, usuario_empresa.loginapp, 
				 usuario_empresa.loginsistema, 
				 usuario_empresa.usuario_master,ag.idGrupo  
				 FROM (usuario) JOIN usuario_empresa
				 ON usuario_empresa.idusuario = usuario.id 
				 LEFT JOIN tb_aluno_grupo ag ON ag.idUsuario = usuario.id
				 JOIN perfil_usuario 
				 ON usuario_empresa.idusuarioempresa = perfil_usuario.idusuarioempresa 
				 WHERE 
				 perfil_usuario.idperfil = 3 
				 AND usuario.id not in ( SELECT usuario.id 
				 FROM (usuario) JOIN usuario_empresa
				 ON usuario_empresa.idusuario = usuario.id 
				 LEFT JOIN tb_aluno_grupo ag ON ag.idUsuario = usuario.id
				
				 WHERE 
				  ag.idGrupo = '".$idGrupo."'
				 AND usuario_empresa.idempresa = '".$idempresa."')
				 AND usuario_empresa.idempresa = '".$idempresa."';
";
		
		
		$query = $this->db->query($sql);	
		$retorno = $query->result_array();
		//print_r($this->db->last_query());
		return $retorno;
	}
	
	public function trazAlunosPorGrupo($idGrupo, $idEmpresa) {
		
		$this->db->select("usuario.nome,usuario.id,usuario.email,usuario_empresa.loginapp, usuario_empresa.loginsistema, usuario_empresa.usuario_master,
				ag.situacaoAlunoGrupo, ag.idalunogrupo");
		$this->db->from("usuario");
		$this->db->join("usuario_empresa", "usuario_empresa.idusuario = usuario.id");
		$this->db->join("perfil_usuario", "usuario_empresa.idusuarioempresa = perfil_usuario.idusuarioempresa");
		$this->db->join("tb_aluno_grupo ag", "ag.idUsuario = usuario.id");
		$this->db->where("perfil_usuario.idperfil", 3);
		$this->db->where("usuario_empresa.idempresa", $idEmpresa);
		$this->db->where("ag.idgrupo", $idGrupo);
	//	$this->db->where("ag.situacaoAlunoGrupo", 1);
		return $this->db->get()->result_array();
		
	}
	
	public function retornaPerfisUsuario($id) {
		$idempresa = $this->session->userdata ( "idempresa" );
		
		$this->db->select("perfil_descricao.nomeperfil, perfil_descricao.idperfil, usuario_empresa.idusuarioempresa");
		$this->db->from("usuario");
		$this->db->join("usuario_empresa", "usuario_empresa.idusuario = usuario.id");
		$this->db->join("perfil_usuario", "usuario_empresa.idusuarioempresa = perfil_usuario.idusuarioempresa", "left");
		$this->db->join("perfil_descricao", "perfil_descricao.idperfil = perfil_usuario.idperfil", "left");
		$this->db->where("usuario.id", $id);
		$this->db->where("usuario_empresa.idempresa", $idempresa);
	
		return $this->db->get()->result_array();
		
	}
	
	
	public function salvaPerfil($idUsuarioEmpresa, $idPerfil) {
		//echo "aqui";
		//die();
		//1 administrador
		//2 professor
		//3 aluno
	
		$dados = array("idusuarioempresa" => $idUsuarioEmpresa,
	
					"idperfil" => $idPerfil
			);
	
			$this->db->insert("perfil_usuario", $dados);
	
	
	
	}
	
	
	public function salvaPerfilUsuario($idUsuarioEmpresa, $idPerfil) {
		//echo "aqui";
		//die();
		$qtdPerfilNaLista = count($idPerfil);
		
		for ($i=0; $i<$qtdPerfilNaLista; $i++) {
				
			$dados = array("idusuarioempresa" => $idUsuarioEmpresa,
		
					"idperfil" => $idPerfil[$i]
			);
	
			$this->db->insert("perfil_usuario", $dados);
				
		}
		
		
		
	}
	
	public function insereFoto($dados, $idUsuario) {
		
		$this->db->where("id", $idUsuario);
		$this->db->update("usuario", $dados);		
	}
	
	public function apagaPerfil($idUsuarioEmprea) {
		
		$this->db->where("idusuarioempresa", $idUsuarioEmprea);
		$this->db->delete("perfil_usuario");
	}
	
	/*
	 * Este método insere os novos usuários no grupo público do Paulo e na sua conta
	 * 
	 * */	
	public function inserirDadosPadrao($idusuarioNovo) {
		
		//$this->insereUsuarioEmpresaPerfil(105,$idusuarioNovo);
		//$this->insereAlunoGrupo($idusuarioNovo, 105,40);
		
		
		$this->insereUsuarioEmpresaPerfil(112,$idusuarioNovo);
		$this->insereAlunoGrupo($idusuarioNovo,112,48);
		
	}
	
	
	
	public function insereAlunoGrupo($idusuarioNovo, $idEmpresa, $idGrupo) {
	
		$dados = array("idUsuario" => $idusuarioNovo, "idEmpresa" => $idEmpresa,
				"idGrupo" => $idGrupo, "situacaoAlunoGrupo" => 1);
	
		$this->load->model("grupos_alunos_model");
		$this->grupos_alunos_model->adicionaAlunoNoGrupo($dados);
	
	
	}
	
	public function insereUsuarioEmpresaPerfil($idempresa, $idusuarioNovo) {
	
		$this->load->model ( "empresa_model" );
	
	
		//$idusuarioBanco = $this->usuarios_model->bucaUltimoUsuarioInseridoEmpresa ( $idempresa );
	
		// Envia e-mail ap�s cria��o de um novo usu�rio
		// $this->enviar_email_criacao_conta ( $idusuarioNovo );
		/*
		 * Adicionado em 17-11-2014. Cadastra a empresa com o mesmo nome do usu�rio Se o usu�rio for novo, cadastra a empresa com o mesmo nome do usu�rio. No sistema o usu�rio dever� ser orientado a fazer a edi��o do nome da empresa
		*/
	
		/*	if ($this->session->userdata ( 'idempresa' ) == '' && $this->input->post ( "perfil" ) != 3) {
	
		$empresa = array (
				"idusuario" => $idusuarioNovo,
				"nome_empresa" => $this->input->post ( "nome" ),
				"tipoempresa" => 3,
				"tipocontaempresa" => 2
		);
		// echo $idempresa;
			
		$this->empresa_model->salva ( $empresa );
			
		// TODO
		$ultimaEmpresaInserida = $this->empresa_model->buscaEmpresaInserida ( $idusuarioNovo );
		$idempresa = $ultimaEmpresaInserida ['id'];
			
		}*/
	
		$usuario_master = 'N';
			
		$perfil = 0;
		$perfil = 2;
		$insereUsuarioEmpresa = array (
				"idusuario" => $idusuarioNovo,
				"idempresa" => $idempresa,
				"loginSistema" => "S",
				"usuario_master" => "S"
		);
	
		/* else {
		 // Entra se o perfil informado for aluno
		$perfil = 3;
		$insereUsuarioEmpresa = array (
				"idusuario" => $idusuarioNovo,
				"idempresa" => 1,
				"usuario_master" => "N"
		);
		}*/
			
		$this->usuarios_model->insereUsuarioEmpresa ( $insereUsuarioEmpresa );
		$ultimoUsuarioEmpresaInserida =  $this->db->insert_id();//Essa função do codeigniter pega o último id inserido
	
		$this->load->model ( "usuarios_model" );
			
		// INSERE PERFIL PROFESSOR
		$this->usuarios_model->salvaPerfil ( $ultimoUsuarioEmpresaInserida, 3 );
	
	}
	
	
	public function verificaUsuarioExiste($email='',$id='') {
		$email = trim($email);
		
		$this->db->select("usuario.email as email, usuario.nome as nome, usuario.id as id");
		$this->db->from("usuario");
		
		
		
		if ($email != '') {
			
			$this->db->where("usuario.email",  $email);
		}
		
		if ($id != '') {
			$this->db->where("usuario.id",  $id);
			
		}
		
		$usuario = $this->db->get()->row_array();
		return $usuario;
	}
	
	
	
	
	
}

