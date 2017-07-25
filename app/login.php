<?php
// print_r($_REQUEST);
include "mysale_conexao.php";

$json = file_get_contents ( 'php://input' );
$parsed = json_decode ( $json, true );

if (array_key_exists ( "usuario", $parsed )) {
	foreach ( $parsed ['usuario'] as $key => $values ) {
		
		$email = $values ['email'];
		$senha = md5 ( $values ['password'] );
		
		$usuarioExiste = verificaUsuario ( $email, $senha );
		
		if ($usuarioExiste != null) {
			$acesso = 'T';
			// OBJETO JSON FUNCIONANDO
			$encode = array (
					"userdetails" => array (
							array (
									"acesso" => $acesso,
									"idusuario" => $usuarioExiste ['id'],
									"usuario_master" => 'S'
									
							) 
					) 
			);
			$json_encode = json_encode ( $encode );
			
			print_r ( $json_encode );
			
		} else {
			
			// Caso o usu�rio n�o seja encontrado, o sistema retorna todas os par�metros zerados para que a verifica��o no aplicativo seja igual. S� a vari�vel acesso ser� F, de false.
			$acesso = 'F';
			$encode = array (
					"userdetails" => array (
							array (
									"acesso" => $acesso,
									"idusuario" => 0,
									"usuario_master" => 'S'
									
							) 
					) 
			);
			$json_encode = json_encode ( $encode );
			print_r ( $json_encode );
		}
	}
}

// TESTE COM LOGIN COMUNICA��O NORMAL
//

// $encode = array("userdetails" => array(array("acesso" => $acesso,"idempresa" => $idempresa)), "workdetails" => array(array("company_name" => "My Company", "role" => "web application developer", "employees" => "91")));

// print_r(gettype($idstring));
function verificaUsuario($email, $senha) {
	$query_usuario = "SELECT email,id FROM usuario WHERE EMAIL = '" . $email . "' AND SENHA = '" . $senha . "'";
	$usuario_consulta = mysql_query ( strtolower ( $query_usuario ) ) or die ( mysql_error () );
	$verifica_usuario = mysql_fetch_assoc ( $usuario_consulta );
	
	return $verifica_usuario;
}

/*
 * $email = 'fabricio';
 * print_r(verificaEmpresa($email));
 *
 *
 * $resultado = verificaEmpresa($email);
 *
 * echo "IDEMPRESA: ".$resultado[0];
 */

/*
 * M�todo verificaEmpresa
 * Retorna a empresa que o usu�rio pode efetuar login no sistema. O usu�rio s� pode logar no aplicativo com uma �nica empresa.
 */
function verificaEmpresa($email) {
	$query_empresa_usuario = "SELECT DISTINCT(usuario_empresa.idempresa),usuario.id, empresa.tipoContaEmpresa, empresa.tipoEmpresa, usuario_empresa.usuario_master, empresa.sincronizacaoRegistroProduto, empresa.sincronizacaoFechamentoVenda, empresa.sincronizacaoEntradaAplicativo FROM usuario_empresa, usuario, empresa WHERE usuario.id = usuario_empresa.idusuario and loginapp = 'S' and empresa.idempresa = usuario_empresa.idempresa AND usuario.email = '" . $email . "' ";
	$usuario_empresa_consulta = mysql_query ( strtolower ( $query_empresa_usuario ) ) or die ( mysql_error () );
	$verifica_usuario_empresa = mysql_fetch_array ( $usuario_empresa_consulta );
	
	return $verifica_usuario_empresa;
}

?>