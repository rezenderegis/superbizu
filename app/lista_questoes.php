<?php
// print_r($_REQUEST);
include "mysale_conexao.php";

//$json = file_get_contents ( 'php://input' );
//$parsed = json_decode ( $json, true );
include "constantes.php";


$resultado = verificaQuestao ( $empresa, $_GET['emailUsuario']);


print_r ( $resultado );


function verificaQuestao($idempresa, $emailAlunoProcurar) {
	mysql_query ( 'SET CHARACTER SET utf8' );
	
	$query_empresa_usuario = "SELECT * FROM lista_questoes lq
inner join tb_lista_grupo lg on lg.idLista = lq.idlistaquestoes
inner join tb_grupo g on g.idGrupo = lg.idGrupo
inner join tb_aluno_grupo ag on ag.idGrupo = g.idGrupo
inner join usuario u on u.id = ag.idUsuario
where u.email = '" . $emailAlunoProcurar . "'";
	$tipo = mysql_query ( strtolower ( $query_empresa_usuario ) ) or die ( mysql_error () );
	
	$query_log = "insert into tb_log_aplicativo (email, tabela,tipoSincronizacao) values ('".$emailAlunoProcurar."', 'LISTA_QUESTOES', 'EMAIL')";
	
	mysql_query(strtolower($query_log)) or die(mysql_error());
	
	
	while ( $row_tipo = mysql_fetch_array ( $tipo ) ) {
		
		$i = 0;
		
		foreach ( $row_tipo as $key => $value ) {
			
			if (is_string ( $key )) {
				$fields [mysql_field_name ( $tipo, $i ++ )] = $value;
			}
		}
		
		$json_result [] = $fields;
	}
	
	// $JSON = json_encode($json_result, JSON_UNESCAPED_UNICODE);
	
	$JSON = json_encode ( $json_result );
	
	return $JSON;
}

?>




 
	