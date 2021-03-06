<?php
class Email_model extends CI_Model {
	
	 
	
	private $enderecoServidor;
	
	public function __construct() {
		parent::__construct();
		//$this->enderecoServidor = 'http://localhost/superbizu/';
		$this->enderecoServidor = 'http://www.superbizu.com.br/';
		
	}
	
	public function enviar($email, $nome) {
		
		if(!extension_loaded('openssl'))
		{
			throw new Exception('This app needs the Open SSL PHP extension.');
		}
		
		
		/*
		 * $tipo_mensagem: � o tipo da mensagem que est� sendo enviada. Ser� mostrada no assunto. Sinaliza��o de problema, anota��o
		 */
		date_default_timezone_set ( "America/Sao_Paulo" );
		
		// print_r($acoes_sem_progresso);
		$this->load->model ( "usuarios_model" );
		$email = trim ( $email );
		
		$dados_usuario = $this->usuarios_model->trazDadosUsuario ( $email, '' );
		//print_r($dados_usuario); die();
		$date = date ( 'm/Y' );
		$codigo_senha = md5 ( $dados_usuario ['id'] . $email );
		/*
		 * $inicio = "<br> <b>Altera��o de senha<br><br> Informamos <a href='http://localhost/mysale/index.php/usuarios/alterar_senha/{$dados_usuario['id']}/{$codigo_senha}'>bysale.com.br/alterarSenha</a>. <br> <br>
		 */
		
		$endereco = $this->enderecoServidor."index.php/usuarios/alterar_senha";
		
		// $endereco = "http://localhost/mysale/index.php/usuarios/alterar_senha";
		$inicio = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'
'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<meta http-equiv='content-type' content='text/html; charset=utf-8' />
<title>Superbizu</title>
</head>

<body>
    <p><img src='http://www.superbizu.com.br/imagens/superbizu_email.png' id='logo' alt='Superbizu' width='70' height='61' /></p>



    <p class='text'><strong>Ol&aacute; " . $dados_usuario ['nome'] . "</strong></p>
    <p class='text'>Voc&ecirc; fez uma solicita&ccedil;&atilde;o para recuperar o acesso ao aplicativo Superbizu. </p>
    <p class='text'>Clique no <a href='" . $endereco . "/{$dados_usuario['id']}/{$codigo_senha}'>link</a> para alterar sua senha.    </p>
    <p class='text'>Atenciosamente, </p>
    <p align='center' class='text'><strong>Equipe Superbizu</strong></p>
    <p align='center' class='text'><strong>Prepare-se para a vit&oacute;ria!</strong></p>
<hr />
    <p class='text'>&nbsp;</p>

</body>
</html>";
		
		$meio = "";
		
		$rodape = "";
		
		$mensagem_completa = $inicio . $meio . $rodape;
		$this->load->library ( 'email' );
		
		$this->email->from ( 'info@superbizu.com.br', 'Superbizu - Info ' );
		$this->email->to ($email);
		//$this->email->cc ( 'rezenderegis@gmail.com' );
		
		/*
		 * $this->email->from('comercial@bysale.com.br','Bysale'); $this->email->to($email); $this->email->cc('comercial@bysale.com.br');
		 */
		
		$this->email->subject ( 'Superbizu - Alterar Senha' );
		$this->email->message ( $mensagem_completa );
		
		if ($this->email->send ()) {
			
			 $this->session->set_flashdata("success", "Solicitação feita com sucesso!");
			// echo 'E-mail para '.$acoes['email'].' enviado com sucesso!';
		} else {
			show_error ( $this->email->print_debugger () );
			return $this->email->print_debugger ();
			
		}
	}
	
	public function enviarEmailNotificacaoNovaLista($alunos, $nomeLista) {
		
		/*foreach ($alunos as $aluno) {
			 
			$this->enviar_email_criacao_conta($aluno['email'], "PROFESSOR_ADICIONA_LISTA_GRUPO_ALUNO", $nomeLista);
				
		}*/
		
		
	}
	
	
	public function enviar_email_criacao_conta($email, $tipoCadastroConta, $nomeLista="") {
		
		/*
		 * $tipo_mensagem: � o tipo da mensagem que est� sendo enviada. Ser� mostrada no assunto. Sinaliza��o de problema, anota��o
		 */
		date_default_timezone_set ( "America/Sao_Paulo" );
		$dadosUsuarioLogado = "";
		if (strcmp($tipoCadastroConta, "ALUNO_FEZ_PROPRIO_CADASTRO_APLICATIVO") != 0) {
			$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
			$dadosUsuarioLogado = $dadosUsuarioLogado['nome'];
		}
		
		// print_r($acoes_sem_progresso);
		$this->load->model ( "usuarios_model" );
		$email = trim ( $email );
		
		$dados_usuario = $this->usuarios_model->buscaPorEmail ( $email, '' );
	
		$date = date ( 'm/Y' );
		
		/*
		 * $inicio = "<br> <b>Altera��o de senha<br><br> Informamos <a href='http://localhost/mysale/index.php/usuarios/alterar_senha/{$dados_usuario['id']}/{$codigo_senha}'>bysale.com.br/alterarSenha</a>. <br> <br>
		 */
		
		$inicio = $this->trazerTextoEmail ( $tipoCadastroConta, $dadosUsuarioLogado, $dados_usuario ['nome'], $nomeLista );
		
		$meio = "";
		
		$rodape = "";
		
		$mensagem_completa = $inicio . $meio . $rodape;
		
		$this->load->library ( 'email' );
		
		$this->email->from ( 'superbizu.estudos@gmail.com', 'SuperBizu - Sua ferramenta de estudos ' );
		$this->email->to ( $email );
		$this->email->cc ( 'rezenderegis@gmail.com' );
		
		/*
		 * $this->email->from('comercial@bysale.com.br','Bysale'); $this->email->to($email); $this->email->cc('comercial@bysale.com.br');
		 */
		
		$this->email->subject ( 'SuperBizu, sua ferramenta de estudos!' );
		$this->email->message ( $mensagem_completa );
		
	
		
		if (@$this->email->send ()) {
				
			// $this->session->set_flashdata("success", "Solicita��o feita com sucesso!");
			// echo 'E-mail para '.$acoes['email'].' enviado com sucesso!';
		} else {
				//			show_error ( $this->email->print_debugger () );
		
			$this->session->set_flashdata("success", "Houve um erro ao enviar o email aos alunos!");
		}
		
		
	}
	public function trazerTextoEmail($tipo, $nomeProfessorCadastrouAluno, $nomeUsuarioCadastrado, $nomeLista) {
		$corpo = "";
		$link = "<a href=' https://play.google.com/apps/testing/com.bizu'>link</a>";
		$apresentacao = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'
		'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<meta http-equiv='content-type' content='text/html; charset=iso8859-1' />
		<title>SuperBizu</title>
		</head>
		
		<body>
		<p><img src='http://www.superbizu.com.br/imagens/superbizu_email.png' id='logo' alt='SuperBizu' width='80' height='50' /></p>
			<p class='text'><b>Prezado (a) " . $nomeUsuarioCadastrado . ",</b></p>
			<p class='text'>	
				";
		
		
		$textoDespedida = "";
		if (strcmp($tipo, "PROFESSOR_FEZ_PROPRIO_CADASTRO") == 0 || strcmp($tipo, "PROFESSOR_ADICIONADO_POR_ESCOLA") == 0) {
			$textoDespedida = "<br/><p class='text'>Boa aula, Professor! </p>";
		} else {
			$textoDespedida = "<br/><p class='text'>Desejamos boa sorte nos seus estudos! </p>";
				
		}
		
		$rodape = " ".$textoDespedida."
				    		
				
				<p class='text'>Atenciosamente, </p>
	    <p align='center' class='text'><strong>Equipe SuperBizu</strong></p>
	    <p align='center' class='text'><strong>Exercite seus conhecimentos!</strong></p>
	    <hr />
	    <p class='text'>&nbsp;</p>
	
	    </body>
		</html>";
		
		if (strcmp($tipo, "ALUNO_ADICIONADO_POR_PROFESSOR") == 0) {
			$corpo = "
    		
					<p>Bem vindo ao SuperBizu, um aplicativo que possibilita que voc&ecirc; resolva lista de exerc&iacute;cios dos seus professores diretamente do seu celular e que possui, tamb&eacute;m, exerc&iacute;cios comentados do ENEM.</p> <p> O professor $nomeProfessorCadastrouAluno disponibilizou uma Lista de Exerc&iacute;cios para voc&ecirc; no aplicativo para que possa fazer seus exerc&iacute;cios diretamente do seu celular.</p> <p>  Se voc&ecirc; n&atilde;o possui um dispositivo Android, em breve estar&aacute; disponivel para outras plataformas e disponibilizaremos acesso ao nosso site para resolu&ccedil;&atilde;o das listas. </p>   <p>  Se voc&ecirc; tiver um dispositivo android, baixe o aplicativo SuperBizu Google Play ou clique no $link.  </p>  
	
    		";
			
		} else if (strcmp($tipo, "PROFESSOR_ADICIONADO_POR_ESCOLA") == 0) {
			$corpo = "
	
  <p> Bem vindo a Plataforma de Estudo SuperBizu. Essa plataforma possibilita que voc&ecirc; crie exerc&iacute;cios e disponibilize para seus alunos, que poder&atilde;o resolv&ecirc;-los atrav&eacute;s do seu dispositivo android. </p> <p> A Escola $nomeProfessorCadastrouAluno o adicionou como seu professor. A partir desse momento voc&ecirc; poder&aacute; criar exerc&iacute;cios e disponibilizar aos seus alunos utilizando de todos os benef&iacute;cios de uma plataforma de estudos.  </p> <p> As vantagens de utiliza&ccedil;&atilde;o desta ferramenta s&atilde;o: </p> <p> 1. N&atilde;o sera mais necess&aacute;rio entregar listas de exerc&iacute;cios em papel para seus alunos, bastra criar a lista de exerc&iacute;cios e disponibilizar a lista para a turma do aluno. </p></p>

<p><p> 2. Os alunos poder&atilde;o responder exerc&iacute;cios diretamente do seu celular </p> <p> Atualmente, s&oacute; &eacute; poss&iacute;vel responder as listas de exerc&iacute;cios em dispositivos Android, mas em breve disponibilizaremos o aplicativo para disositivos Apple e Windows Phone.  </p> <p> Para come&ccedil;ar a utilizar siga os seguintes pa&ccedil;os: </p> <ul> <li>Crie suas quest&otilde;es ou reaproveite as que j&aacute; existem</li> <li>Crie lista de quest&otilde;es</li> <li>Cadaste seus alunos ou utilize os que j&aacute; est&atilde;o cadastrados</li> <li>Organize seus alunos em grupos</li> <li>Disponibilize as listas de quest&otilde;es para os grupos</li> </ul> 
					
					";
			
		} else if (strcmp($tipo, "ALUNO_FEZ_PROPRIO_CADASTRO") == 0) {
			 
			$corpo = "
    <p> Bem vindo ao SuperBizu, um aplicativo que possibilita que voc&ecirc; resolva lista de exerc&iacute;cios dos seus professores diretamente do seu celular e que possui, tamb&eacute;m, exerc&iacute;cios comentados do ENEM. </p> <p>  Se voc&ecirc; n&atilde;o possui um dispositivo Android, em breve estar&aacute; disponivel para outras plataformas e disponibilizaremos acesso ao nosso site para resolu&ccedil;&atilde;o das listas. </p>   <p>  Se voc&ecirc; tiver um dispositivo android, baixe o aplicativo SuperBizu na Google Play ou clique no $link.  </p>  
					";
		
		} else if (strcmp($tipo, "PROFESSOR_FEZ_PROPRIO_CADASTRO") == 0) {
			
			$corpo = "
  <p> Bem vindo a Plataforma de Estudo SuperBizu. Essa plataforma possibilita que voc&ecirc; crie exerc&iacute;cios e disponibilize para seus alunos, que poder&atilde;o resolv&ecirc;-los atrav&eacute;s do seu dispositivo android. </p> <p> As vantagens de utiliza&ccedil;&atilde;o desta ferramenta s&atilde;o: </p> <p> 1. N&atilde;o sera mais necess&aacute;rio entregar listas de exerc&iacute;cios em papel para seus alunos, bastra criar a lista de exerc&iacute;cios e disponibilizar a lista para a turma do aluno. </p></p>

<p><p> 2. Os alunos poder&atilde;o responder exerc&iacute;cios diretamente do seu celular </p> <p> Atualmente, s&oacute; &eacute; poss&iacute;vel responder as listas de exerc&iacute;cios em dispositivos Android, mas em breve disponibilizaremos o aplicativo para disositivos Apple e Windows Phone.  </p> <p> Para come&ccedil;ar a utilizar siga os seguintes pa&ccedil;os: </p> <ul> <li>Crie suas quest&otilde;es ou reaproveite as que j&aacute; existem</li> <li>Crie lista de quest&otilde;es</li> <li>Cadaste seus alunos ou utilize os que j&aacute; est&atilde;o cadastrados</li> <li>Organize seus alunos em grupos</li> <li>Disponibilize as listas de quest&otilde;es para os grupos</li> </ul> ";
		
		} else if (strcmp($tipo, "ALUNO_FEZ_PROPRIO_CADASTRO_APLICATIVO") == 0) {
			$corpo = "
   <p>
Bem vindo ao SuperBizu, um aplicativo que possibilita que voc&ecirc; resolva lista de exerc&iacute;cios dos seus professores diretamente do seu celular e que possui, tamb&eacute;m, exerc&iacute;cios comentados do ENEM. 
					</p>
					<p>
					Se voc&ecirc; n&atilde;o possui um dispositivo Android, em breve estar&aacute; disponivel para outras plataformas e disponibilizaremos acesso ao nosso site para resolu&ccedil;&atilde;o das listas.
</p>
					<p>
Se voc&ecirc; tiver um dispositivo android, baixe o aplicativo SuperBizu Google Play ou clique no ".$link.".
					
					
					</p>";
			
		} else if (strcmp($tipo, "PROFESSOR_ADICIONA_LISTA_GRUPO_ALUNO") == 0) {
			$corpo = "<p> O Prof $nomeProfessorCadastrouAluno disponibilzou uma nova lista de exerc&iacute;cios <b>$nomeLista</b> para que voc&ecirc; possa resolver no aplicativo SuperBizu.  </p> <p>Se voc&ecirc; n&atilde;o possui um dispositivo Android, em breve estar&aacute; disponivel para outras plataformas e disponibilizaremos acesso ao nosso site para resolu&ccedil;&atilde;o das listas. </p> <p> Se voc&ecirc; tiver um dispositivo android, baixe o aplicativo SuperBizu Google Play ou clique no $link. </p> 
					";
			  
  			
		}
		
		return $apresentacao . $corpo . $rodape;
	}
	
	



	
	
	
	
	
}