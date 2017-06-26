<?php


include "mysale_conexao.php"; 

//print_r(verificaEmpresa('meeffimiffffff@gmail.com')); 

mysql_query('SET CHARACTER SET utf8');


if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('GMT');
}


date_default_timezone_set('America/Brasilia');



$json = file_get_contents('php://input'); 
$parsed = json_decode($json,true);



if (array_key_exists("usuario", $parsed)) {
foreach ($parsed['usuario'] as $key => $values){

 	$email = $values['email'];
    $senha = md5($values['password']);
    $nome = $values['nome_usuario'];
    $nome = mysql_real_escape_string($nome);
    
    }
    
    if (!verificaUsuarioExiste($email)) {
    	 
    	inserirUsuario($nome, $email, $senha);
    	$id_usuario = verificaUsuarioExiste($email);
    	//insere empresa
    	insereExmpresaUsuario($id_usuario, $nome);
    	
    
    	$id_empresa = verificaEmpresaUsuario($id_usuario);
    	insereUsuarioEmpresa($id_usuario, $id_empresa);
    	
   
   
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


//Sï¿½ pode logar no aplicativo o usuï¿½rio que possui usuï¿½rio e senha e possui uma empresa cadastrada.

if ($usuarioExiste != null and $idempresa != null) {
	file_get_contents("http://bysale.com.br/mysale/index.php/usuarios/enviar_email_criacao_conta/".$id_usuario);
	
$acesso = 'T';
//OBJETO JSON FUNCIONANDO
$encode = array("userdetails" => array(array("acesso" => $acesso,"idempresa" => $idempresa, "idusuario" => $idusuario, 
		"tipoContaEmpresa" => $tipoContaEmpresa, "tipoEmpresa" => $tipoEmpresa, "usuario_master" => $usuario_master,
		"sincronizacaoRegistroProduto" => $sincronizacaoRegistroProduto, "sincronizacaoFechamentoVenda" => $sincronizacaoFechamentoVenda,
		"sincronizacaoEntradaAplicativo" => $sincronizacaoEntradaAplicativo)));
$json_encode = json_encode($encode);
print_r($json_encode);
}  }else {
	//Caso o usuário não seja encontrado, o sistema retorna todas os parâmetros zerados para que a verificação no aplicativo seja igual. Só a variável acesso será F, de false.
$acesso = 'F';
$encode = array("userdetails" => array(array("acesso" => $acesso,"idempresa" => 0, "idusuario" => 0, "tipoContaEmpresa" => 0, "tipoEmpresa" => 0, "usuario_master" => $usuario_master,
"sincronizacaoRegistroProduto" => 0, "sincronizacaoFechamentoVenda" => 0,
		"sincronizacaoEntradaAplicativo" => 0)));
$json_encode = json_encode($encode);
print_r($json_encode);

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

function inserirUsuario ($nome, $email, $senha) {
	
	$dt_atual = date('Y-m-d H:i:s');
	mysql_query('SET CHARACTER SET utf8');
	
	$query = "insert into usuario (nome, email, senha, dt_criacao_usuario) values ('".$nome."', '".$email."','".$senha."', '".$dt_atual."')";
	mysql_query(strtolower($query)) or die(mysql_error());
	
}


function verificaUsuarioExiste($email) {
	$query_usuario = "SELECT id FROM usuario WHERE EMAIL = '".$email."'";
	$usuario_consulta= mysql_query(strtolower($query_usuario)) or die(mysql_error());
	$verifica_usuario = mysql_fetch_array($usuario_consulta);

	return $verifica_usuario[0];
}

function insereExmpresaUsuario($id_usuario, $nome) {
	
	$query = "insert into empresa (nome_empresa, idusuario, sincronizacaoRegistroProduto, sincronizacaoFechamentoVenda, sincronizacaoEntradaAplicativo) 
			values ('".$nome."', '".$id_usuario."', 'N','N','N')";
	mysql_query($query) or die(mysql_error());
}

function insereUsuarioEmpresa ($id_usuario, $id_empresa) {
	
	
	
	$query = "insert into usuario_empresa (idusuario, idempresa, loginapp, loginsistema, usuario_master) 
			values ('".$id_usuario."', '".$id_empresa."', 'S', 'S', 'S')";
	mysql_query($query) or die(mysql_error());
}

function verificaEmpresaUsuario($id_usuario) {
	$query_usuario = "SELECT idempresa FROM empresa WHERE idusuario = '".$id_usuario."'";
	$usuario_consulta= mysql_query(strtolower($query_usuario)) or die(mysql_error());
	$verifica_usuario = mysql_fetch_array($usuario_consulta);

	return $verifica_usuario[0];
}


?>