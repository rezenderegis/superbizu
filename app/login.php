<?php
//print_r($_REQUEST);

include "mysale_conexao.php"; 


$json = file_get_contents('php://input'); 
$parsed = json_decode($json,true);


if (array_key_exists("usuario", $parsed)) {
foreach ($parsed['usuario'] as $key => $values){

 	$email = $values['email'];
    $senha = md5($values['password']);

	$resultado = verificaEmpresa($email); 
	
	$idempresa = $resultado[0];
	$idusuario = $resultado[1];
	$tipoContaEmpresa = 0;
	$tipoEmpresa = 0;
	$usuario_master = $resultado[4];
	$sincronizacaoRegistroProduto = $resultado[5];
	$sincronizacaoFechamentoVenda = $resultado[6];
	$sincronizacaoEntradaAplicativo = $resultado[7];
$usuarioExiste = verificaUsuario ($email, $senha);

/*
Sï¿½ pode logar no aplicativo o usuï¿½rio que possui usuï¿½rio e senha e possui uma empresa cadastrada.
*/
if ($usuarioExiste != null and $idempresa != null) {
$acesso = 'T';
//OBJETO JSON FUNCIONANDO
$encode = array("userdetails" => array(array("acesso" => $acesso,"idempresa" => $idempresa, "idusuario" => $idusuario, 
		"tipoContaEmpresa" => $tipoContaEmpresa, "tipoEmpresa" => $tipoEmpresa, "usuario_master" => $usuario_master,
		"sincronizacaoRegistroProduto" => $sincronizacaoRegistroProduto, "sincronizacaoFechamentoVenda" => $sincronizacaoFechamentoVenda,
		"sincronizacaoEntradaAplicativo" => $sincronizacaoEntradaAplicativo)));
$json_encode = json_encode($encode);
print_r($json_encode);
} else {
	//Caso o usuário não seja encontrado, o sistema retorna todas os parâmetros zerados para que a verificação no aplicativo seja igual. Só a variável acesso será F, de false.
$acesso = 'F';
$encode = array("userdetails" => array(array("acesso" => $acesso,"idempresa" => 0, "idusuario" => 0, "tipoContaEmpresa" => 0, "tipoEmpresa" => 0, "usuario_master" => $usuario_master,
"sincronizacaoRegistroProduto" => 0, "sincronizacaoFechamentoVenda" => 0,
		"sincronizacaoEntradaAplicativo" => 0)));
$json_encode = json_encode($encode);
print_r($json_encode);
}

}
}



//TESTE COM LOGIN COMUNICAï¿½ï¿½O NORMAL
//





//$encode = array("userdetails" => array(array("acesso" => $acesso,"idempresa" => $idempresa)), "workdetails" => array(array("company_name" => "My Company", "role" => "web application developer", "employees" => "91")));





//print_r(gettype($idstring));




function verificaUsuario($email, $senha) {
$query_usuario = "SELECT email FROM usuario WHERE EMAIL = '".$email."' AND SENHA = '".$senha."'";
$usuario_consulta= mysql_query(strtolower($query_usuario)) or die(mysql_error());
$verifica_usuario = mysql_fetch_array($usuario_consulta);

return $verifica_usuario[0];
}



/*
$email = 'fabricio';
print_r(verificaEmpresa($email));


$resultado = verificaEmpresa($email);

echo "IDEMPRESA:   ".$resultado[0];
*/


/*
Mï¿½todo verificaEmpresa
Retorna a empresa que o usuï¿½rio pode efetuar login no sistema. O usuï¿½rio sï¿½ pode logar  no aplicativo com uma ï¿½nica empresa. 
*/
function verificaEmpresa($email) {
$query_empresa_usuario = "SELECT DISTINCT(usuario_empresa.idempresa),usuario.id, empresa.tipoContaEmpresa, empresa.tipoEmpresa, usuario_empresa.usuario_master, empresa.sincronizacaoRegistroProduto, empresa.sincronizacaoFechamentoVenda, empresa.sincronizacaoEntradaAplicativo FROM usuario_empresa, usuario, empresa WHERE usuario.id = usuario_empresa.idusuario and loginapp = 'S' and empresa.idempresa = usuario_empresa.idempresa AND usuario.email = '".$email."' ";
$usuario_empresa_consulta= mysql_query(strtolower($query_empresa_usuario)) or die(mysql_error());
$verifica_usuario_empresa = mysql_fetch_array($usuario_empresa_consulta);

return $verifica_usuario_empresa;
}


?>