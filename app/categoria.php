<?php
date_default_timezone_set ( "America/Sao_Paulo" );

$dt_atual = date ( 'Y-m-d H:i:s' );

/*
 * if(isset($GLOBALS['HTTP_RAW_POST_DATA']) == TRUE){ echo $GLOBALS['HTTP_RAW_POST_DATA']; }else{ echo $HTTP_RAW_POST_DATA; }
 */

$json = file_get_contents ( 'php://input' );

include "mysale_conexao.php";

$parsed = json_decode ( utf8_encode ( $json ), true );


if (array_key_exists ( "categoria", $parsed )) {
	foreach ( $parsed ['categoria'] as $key => $values ) {
		$idCategoria = $values ['id'];
		$nomeCategoria = $values ['nome'];
		
		$idempresa = $values ['idempresa'];
		// $categoria = $values['categoria'];
		
		$verifica_produto = verificaCategoriaExiste ( $idCategoria, $idempresa );
		if ($verifica_produto == null) {
			mysql_query ( 'SET CHARACTER SET utf8' );
			
			$query = "INSERT INTO categoria_produto (idcategoriaproduto, nomecategoriaproduto,idempresa, dt_primeira_sincronizacao)

			VALUES ('" . $idCategoria . "','" . $nomeCategoria . "','" . $idempresa . "', '" . $dt_atual . "')";
			
			mysql_query ( $query ) or die ( mysql_error () );
		} else {
			// Atualizar produto
			mysql_query ( 'SET CHARACTER SET utf8' );
			
			$query = "UPDATE categoria_produto SET nomecategoriaproduto = '" . $nomeCategoria . "', dt_ultima_sincronizacao = '" . $dt_atual . "' WHERE idcategoriaproduto = '" . $idCategoria . "' AND IDEMPRESA = '" . $idempresa . "'";
			
			mysql_query ( $query ) or die ( mysql_error () );
		}
	}
	mysql_close ();
	
	echo "Categoria enviada com sucesso!";
}



function verificaCategoriaExiste($idCategoria, $idempresa) {
	$query_categoria = "SELECT idcategoriaproduto FROM categoria_produto WHERE idcategoriaproduto = '" . $idCategoria . "' AND IDEMPRESA = '" . $idempresa . "'";
	$categoria_consulta = mysql_query ( $query_categoria ) or die ( mysql_error () );
	$verifica_categoria = mysql_fetch_assoc ( $categoria_consulta );
	
	return $verifica_categoria;
}

?>

