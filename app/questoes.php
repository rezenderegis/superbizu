<?php
//print_r($_REQUEST);
include "mysale_conexao.php"; 

$json = file_get_contents('php://input'); 
$parsed = json_decode($json,true);
//file_put_contents("file96.txt",">>>> ".$parsed['tipoSincronizacao']." valor".$parsed['valor'],FILE_APPEND);


	$resultado = verificaQuestao($empresa, $parsed['tipoSincronizacao'], $parsed['valor']);
	
    print_r($resultado);
    
function verificaQuestao($idempresa, $tipoSincronizacao, $valor) {
	mysql_query('SET CHARACTER SET utf8');
	
	$query_empresa_usuario = "";
if (strcmp($tipoSincronizacao, "ANO") == 0) {
	//file_put_contents("file100.txt","QUESTAO ENTROU TIPO: ".$tipoSincronizacao." Valor: ".$valor,FILE_APPEND);
	
	$query_empresa_usuario = "select * from tb_questao where (ano_questao = ".$valor." && id_dono = 82) || id_dono != 82";
	
	} else if (strcmp($tipoSincronizacao, "EMAIL") == 0) {
		//file_put_contents("file1cc.txt","QUESTAO ENTROU EMAIL: ".$tipoSincronizacao." Valor: ".$valor,FILE_APPEND);
		
		
		$query_empresa_usuario = "select q.* from tb_questao q INNER JOIN questao_lista ql ON ql.idquestao = q.id_questao
inner join lista_questoes l on l.idlistaquestoes = ql.idlistaquestao
inner join tb_lista_grupo lg on lg.idlista = l.idlistaquestoes
inner join tb_grupo g on g.idgrupo = lg.idgrupo
inner join tb_aluno_grupo ag on ag.idgrupo = g.idgrupo
inner join usuario u on u.id = ag.idusuario
where u.email = '".$valor."' group by q.id_questao";
		
		
	} else {
//	file_put_contents("file96.txt",">>>> ".$tipoSincronizacao." --> nao ENTORU FILTRO 2015"."Comparacao: -".strcmp($parsed['tipoSincronizacao'], "2015"),FILE_APPEND);
	$tipoSincronizacao = "GERAL";
		
	$query_empresa_usuario = "select * from tb_questao";
	
}	

$query_log = "insert into tb_log_aplicativo (email, tabela,tipoSincronizacao) values ('".$valor."', 'TB_QUESTAO', '".$tipoSincronizacao."')";

mysql_query(strtolower($query_log)) or die(mysql_error());

$tipo= mysql_query(strtolower($query_empresa_usuario)) or die(mysql_error());
 


while ($row_tipo = mysql_fetch_array($tipo))  
{
 
    $i=0;
                 
    foreach($row_tipo as $key => $value)    
    {
 
        if (is_string($key)) 
        {
         $fields[mysql_field_name($tipo,$i++)] = $value;
        }
 
    }
 
    $json_result [ ] =  $fields;
	}
	
//$JSON = json_encode($json_result, JSON_UNESCAPED_UNICODE);

$JSON = json_encode($json_result);
	
return $JSON;

			  }


?>




 
	