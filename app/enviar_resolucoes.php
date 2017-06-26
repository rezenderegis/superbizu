<?php
/*
 
  {
"resolucao": [
{"id_questao": 1, "id_grupo_questao":1,"id_item": 1, "date": "", "id_lista": 2,"id_simulado": 3,"id_usuario": 1, "guid_resolucao": 9892},
{"id_questao": 1, "id_grupo_questao":1,"id_item": 1, "date": "", "id_lista": 2,"id_simulado": 3,"id_usuario": 3, "guid_resolucao": 9891}        
    ]
}
  
  
  
 */
date_default_timezone_set("America/Sao_Paulo");

$dt_atual = date('Y-m-d H:i:s');

$metodo = $_SERVER['REQUEST_METHOD'];


$json = file_get_contents('php://input');

include "mysale_conexao.php";

$parsed = json_decode(utf8_encode($json),true);

//if (array_key_exists("resolucao", $parsed)) {

	foreach ($parsed['resolucao'] as $key => $values) {
		
		//$guid_pessoa = $values['id'];
		$id_questao= $values['id_questao'];
		$id_grupo_questao= $values['id_grupo_questao'];
		$id_item= $values['id_item'];
		$date= $values['date'];
		$id_lista= $values['id_lista'];
		$id_simulado= $values['id_simulado'];
		$id_usuario= $values['id_usuario'];
		
		$simuladoExiste = verificaResolucaoInserida($id_grupo_questao,$id_questao);

		if ($simuladoExiste== null) { 
			
			mysql_query('SET CHARACTER SET utf8');
			
			$query = "INSERT INTO TB_RESOLUCAO (ID_QUESTAO, ID_GRUPO_QUESTAO,ID_ITEM,DATE,ID_LISTA,ID_SIMULADO,ID_USUARIO)
					
	VALUES ('".$id_questao."','".$id_grupo_questao."', '".$id_item."','".$date."','".$id_lista."', '".$id_simulado."', '".$id_usuario."')";
			
			//file_put_contents("file4.txt","Inclusão".$query."\n",FILE_APPEND);
			
			mysql_query($query) or die(mysql_error());
			
			//return http_response_code(200);
			echo "Sincronizacao realizacao com sucesso";
			
		} else {
			// http_response_code(400);
			echo "Sinc Realizada";
			
		}
		
	}
	mysql_close();
//}



//FUNï¿½ï¿½ES DE VERIFICAï¿½ï¿½O

function verificaResolucaoInserida($guid_resolucao,$idquestao) {
	$consulta = "SELECT id_grupo_questao FROM TB_RESOLUCAO WHERE id_grupo_questao = '".$guid_resolucao."' and id_questao = '".$idquestao."'";
	$consulta= mysql_query($consulta) or die(mysql_error());
	$consulta= mysql_fetch_assoc($consulta);
	//file_put_contents("file_consulta_cpf_existe.txt",$query_pessoa."\n".$verifica_pessoa["IDPESSOA"],FILE_APPEND);
	
	return $consulta;
}


?>

