<?php

date_default_timezone_set("America/Sao_Paulo");

$dt_atual = date('Y-m-d H:i:s');


/*
  if(isset($GLOBALS['HTTP_RAW_POST_DATA']) == TRUE){
        echo $GLOBALS['HTTP_RAW_POST_DATA'];
    }else{
        echo $HTTP_RAW_POST_DATA;
    }
*/

$json = file_get_contents('php://input'); 

include "mysale_conexao.php"; 

$parsed = json_decode(utf8_encode($json),true);
//$parsed = $json;
//print_r($parsed);

//INSERï¿½ï¿½O DE PESSOA

if (array_key_exists("pessoa", $parsed)) {

foreach ($parsed['pessoa'] as $key => $values){

 	$id = $values['id'];
    $nome = $values['nome'];
	$telefone = $values['telefone'];
	$site = $values['site'];
	$endereco = $values['endereco'];
	
	$idempresa = $values['idempresa'];
$verifica_pessoa = verificaPessoa($id, $idempresa);
if ($verifica_pessoa == null) { 
mysql_query('SET CHARACTER SET utf8');
	
$query = "INSERT INTO pessoa (IDPESSOA, NOME,TELEFONE,SITE,ENDERECO, IDEMPRESA, dt_primeira_sincronizacao)
 
VALUES ('".$id."','".$nome."', '".$telefone."','".$site."','".$endereco."', '".$idempresa."', '".$dt_atual."' )";


mysql_query($query) or die(mysql_error());

} else {
mysql_query('SET CHARACTER SET utf8');	
$query = "UPDATE pessoa SET NOME = '".$nome."', TELEFONE = '".$telefone."',SITE = '".$site."', ENDERECO = '".$endereco."', dt_ultima_sincronizacao = '".$dt_atual."' WHERE IDPESSOA = '".$id."' AND IDEMPRESA = '".$idempresa."' ";

mysql_query($query) or die(mysql_error());

}
}
mysql_close(); 
echo "Clientes sincronizados com sucesso!";
}


//INSERÇÃO DE CATEGORIAS
if (array_key_exists("categoria", $parsed)) {
	foreach ($parsed['categoria'] as $key => $values){
		$idCategoria = $values['id'];
		$nomeCategoria = $values['nome'];
		
		$idempresa = $values['idempresa'];
		//$categoria = $values['categoria'];

		$verifica_produto = verificaCategoriaExiste($idCategoria, $idempresa);
		if ($verifica_produto == null) {
			mysql_query('SET CHARACTER SET utf8');
				
			$query = "INSERT INTO categoria_produto (idcategoriaproduto, nomecategoriaproduto,idempresa, dt_primeira_sincronizacao)

			VALUES ('".$idCategoria."','".$nomeCategoria."','".$idempresa."', '".$dt_atual."')";

			mysql_query($query) or die(mysql_error());

		} else {
			//Atualizar produto
			mysql_query('SET CHARACTER SET utf8');
				
			$query = "UPDATE categoria_produto SET nomecategoriaproduto = '".$nomeCategoria."', dt_ultima_sincronizacao = '".$dt_atual."' WHERE idcategoriaproduto = '".$idCategoria."' AND IDEMPRESA = '".$idempresa."'";

			mysql_query($query) or die(mysql_error());

		}
	}
	mysql_close();
	
	echo "Categoria enviada com sucesso!";

}










//INSERï¿½ï¿½O DE PRODUTO
if (array_key_exists("produto", $parsed)) {
foreach ($parsed['produto'] as $key => $values){
 	$id = $values['id'];
   // $nomefornecedor = $values['nomefornecedor'];
	$nomeproduto = $values['nomeproduto'];
	$preco = $values['preco'];
	$idempresa = $values['idempresa'];
	$categoria = $values['categoria'];
	
$verifica_produto = verificaProduto($id, $idempresa);	
if ($verifica_produto == null) {	
	mysql_query('SET CHARACTER SET utf8');
	
$query = "INSERT INTO produto (ID, NOMEPRODUTO,PRECO, IDEMPRESA, CATEGORIA, dt_primeira_sincronizacao)
 
VALUES ('".$id."','".$nomeproduto."','".$preco."', '".$idempresa."', '".$categoria."', '".$dt_atual."')";

mysql_query($query) or die(mysql_error());

} else {
	//Atualizar produto
	mysql_query('SET CHARACTER SET utf8');
	
	$query = "UPDATE produto SET NOMEPRODUTO = '".$nomeproduto."', PRECO = '".$preco."', CATEGORIA = '".$categoria."', dt_ultima_sincronizacao = '".$dt_atual."' WHERE ID = '".$id."' AND IDEMPRESA = '".$idempresa."'";
	
	mysql_query($query) or die(mysql_error());
	
}
}
mysql_close();
//echo "Produtos sincronizados com sucesso!";

}
//print_r($json);

//print_r($parsed);
//INSERï¿½ï¿½O DE VENDACLIENTE
if (array_key_exists("vendacliente", $parsed)) {
//print_r($parsed[vendacliente]);
foreach ($parsed['vendacliente'] as $key => $values){
 	$idvendacliente = $values['idvendacliente'];
	$idcliente = $values['idcliente'];
	$situacaovenda = $values['situacaovenda'];
	$totalvenda = $values['totalvenda'];
	$dtvenda = $values['dtvenda'];
	
	$idempresa = $values['idempresa'];
	$idusuario = $values['idusuario'];
	
//$phpdate = 'November 20, 2009';
$dtvenda_convertida = date( 'Y-m-d H:i:s ', strtotime($dtvenda) );

//$idvendacliente_site = verificaIdVendaClienteSite($idempresa, $idusuario, $idcliente, $dtvenda_convertida);


//$verifica_venda_cliente = verificaVendaCliente($idvendacliente, $idempresa, $idusuario, $dtvenda_convertida);	
$idvendacliente_site = verificaIdVendaClienteSite($idempresa, $idusuario, $idcliente, $dtvenda_convertida, $idvendacliente);

if ($idvendacliente_site == null) {	
	mysql_query('SET CHARACTER SET utf8');

	
$query = "INSERT INTO vendacliente (idvendacliente, idcliente,situacaovenda, totalvenda, dtvenda,idempresa,idusuario, dt_primeira_sincronizacao)
 
VALUES ('".$idvendacliente."','".$idcliente."', '".$situacaovenda."','".$totalvenda."','".$dtvenda_convertida."', '".$idempresa."', '".$idusuario."', '".$dt_atual."')";
//DATE_FORMAT('".$dtvenda."','%Y-%m-%d')
mysql_query($query) or die(mysql_error());

} else {
	mysql_query('SET CHARACTER SET utf8');
	
	$query = "UPDATE vendacliente SET SITUACAOVENDA = '".$situacaovenda."', dt_ultima_sincronizacao = '".$dt_atual."' WHERE IDVENDACLIENTE = '".$idvendacliente."'";

mysql_query($query) or die(mysql_error());

}
}
mysql_close();

echo "Vendas sincronizadas com sucesso!";

}
//INSERï¿½ï¿½O DE VENDA
//print_r($parsed);
if (array_key_exists("vendas", $parsed)) {
foreach ($parsed['vendas'] as $key => $values){
 	$id = $values['id'];
	$idcliente = $values['idcliente'];
	$idproduto = $values['idproduto'];
	$idvendacliente = $values['idvendacliente'];
	$controle = $values['controle'];
	$totalproduto = $values['totalproduto'];
	$dtvendaCliente = $values['dtvendaCliente'];
	$dtvendaCliente_convertida = date( 'Y-m-d H:i:s ', strtotime($dtvendaCliente) );
	$situacaoProduto = $values['situacao'];
	
	$idempresa = $values['idempresa'];
	$idusuario = $values['idusuario'];
	$idcliente = $values['idcliente'];
//PEGA O ID DA TABELA VENDA PARA INSERIR NO ATRIUTO IDVENDALCIENTESITE DO SISTEMA	
	$idvendacliente_site = verificaIdVendaClienteSite($idempresa, $idusuario, $idcliente, $dtvendaCliente_convertida, $idvendacliente);
	$dtvenda = $values['dtvenda'];
	$dtvenda_convertida = date( 'Y-m-d H:i:s ', strtotime($dtvenda) );
	
	//echo "dtvenda -> ".$dtvenda;

$verifica_venda = verificaVenda($idusuario, $idcliente, $idproduto, $dtvenda_convertida);	
if ($verifica_venda == null) {
	mysql_query('SET CHARACTER SET utf8');
	
$query = "INSERT INTO vendas (id, idcliente,idproduto,idvendacliente,controle,totalproduto, IDVENDA_CLIENTE_SITE,dtvenda,idusuario, situacao, dt_primeira_sincronizacao)
 
VALUES ('".$id."','".$idcliente."', '".$idproduto."', '".$idvendacliente."', '".$controle."', '".$totalproduto."', '".$idvendacliente_site."', '".$dtvenda_convertida."', '".$idusuario."', '".$situacaoProduto."', '".$dt_atual."')";
mysql_query($query) or die(mysql_error());
//echo "Venda sincronizada com sucesso!";
} else {
	mysql_query('SET CHARACTER SET utf8');
	
	$query = "UPDATE vendas SET SITUACAO = '".$situacaoProduto."', dt_ultima_sincronizacao = '".$dt_atual."' WHERE id = '".$id."' AND idcliente = '".$idcliente."' and idproduto = '".$idproduto."' 
	and idvendacliente = '".$idvendacliente."' and IDVENDA_CLIENTE_SITE = '".$idvendacliente_site."'";
	mysql_query($query) or die(mysql_error());
	//print_r($query);
	//echo "Venda atualizada com sucesso!";
} 
}
echo "Vendas sincronizadas com sucesso";

mysql_close();


//echo "Vendas sincronizadas com sucesso!";

}


//FUNï¿½ï¿½ES DE VERIFICAï¿½ï¿½O

function verificaPessoa($idpessoa, $idempresa) {
$query_pessoa = "SELECT IDPESSOA FROM pessoa WHERE IDPESSOA = '".$idpessoa."' AND IDEMPRESA = '".$idempresa."'";
$pessoaConsulta= mysql_query($query_pessoa) or die(mysql_error());
$verifica_pessoa = mysql_fetch_assoc($pessoaConsulta);

return $verifica_pessoa;
}

function verificaVenda($idusuario, $idcliente, $idproduto, $dtvenda_convertida) {
$query_venda = "SELECT ID FROM vendas WHERE IDUSUARIO = '".$idusuario."' AND IDCLIENTE = '".$idcliente."' AND IDPRODUTO =  '".$idproduto."' AND DTVENDA = '".$dtvenda_convertida." AND SITUACAO = 1'";
$vendaConsulta= mysql_query($query_venda) or die(mysql_error());
$verifica_venda = mysql_fetch_array($vendaConsulta);
return $verifica_venda[0];
}

//echo "Clientes sincronizados com sucesso!";

function verificaProduto($id, $idempresa) {
$query_produto = "SELECT ID FROM produto WHERE ID = '".$id."' AND IDEMPRESA = '".$idempresa."'";
$produtoConsulta= mysql_query($query_produto) or die(mysql_error());
$verifica_produto = mysql_fetch_assoc($produtoConsulta);

return $verifica_produto;
}



function verificaCategoriaExiste($idCategoria, $idempresa) {
	$query_categoria = "SELECT idcategoriaproduto FROM categoria_produto WHERE idcategoriaproduto = '".$idCategoria."' AND IDEMPRESA = '".$idempresa."'";
	$categoria_consulta = mysql_query($query_categoria) or die(mysql_error());
	$verifica_categoria = mysql_fetch_assoc($categoria_consulta);

	return $verifica_categoria;
}


/*
function verificaVendaCliente($idvendacliente, $idempresa, $idusuario, $dtvenda_convertida) {
$query_vendaCliente = "SELECT IDVENDACLIENTE FROM VENDACLIENTE WHERE IDVENDACLIENTE = '".$idvendacliente."' AND IDEMPRESA = '".$idempresa."' AND IDUSUARIO = '".$idusuario."' AND DTVENDA = '".$dtvenda_convertida."'";
$vendaClienteConsulta= mysql_query($query_vendaCliente) or die(mysql_error());
$verifica_venda_cliente = mysql_fetch_assoc($vendaClienteConsulta);

return $verifica_venda_cliente;
}
*/

function verificaIdVendaClienteSite($idempresa, $idusuario, $idcliente, $dtvenda,$idvendacliente) {
$query_vendaCliente = "SELECT VC.ID FROM vendacliente VC  WHERE VC.IDEMPRESA = '".$idempresa."' AND VC.IDUSUARIO = '".$idusuario."' AND VC.IDCLIENTE = '".$idcliente."' AND VC.DTVENDA = '".$dtvenda."' AND VC.IDVENDACLIENTE = '".$idvendacliente."'";
//AND VC.DTVENDA = '".$dtvenda_convertida."'
$vendaClienteConsulta= mysql_query($query_vendaCliente) or die(mysql_error());
$verifica_venda_cliente = mysql_fetch_array($vendaClienteConsulta);
//echo $query_vendaCliente;
return $verifica_venda_cliente[0];
}


/*
function verificaIdVendaClienteSite($idempresa, $idusuario, $idcliente, $dtvenda) {
$query_vendaCliente = "SELECT VC.ID FROM VENDACLIENTE VC INNER JOIN VENDAS V ON V.IDVENDA_CLIENTE_SITE = VC.ID
WHERE VC.IDEMPRESA = '".$idempresa."' AND VC.IDUSUARIO = '".$idusuario."' AND VC.IDCLIENTE = '".$idcliente."' AND VC.DTVENDA = '".$dtvenda."'";
//AND VC.DTVENDA = '".$dtvenda_convertida."'
$vendaClienteConsulta= mysql_query($query_vendaCliente) or die(mysql_error());
$verifica_venda_cliente = mysql_fetch_assoc($vendaClienteConsulta);
print_r($query_vendaCliente);
return $verifica_venda_cliente;
}
*/

 ?>

