<?php
//print_r($_REQUEST);
include "mysale_conexao.php"; 

$json = file_get_contents('php://input'); 
$parsed = json_decode($json,true);

	$resultado = verificaQuestao($empresa);
	
    print_r($resultado);
    //select * from lista_questoes
function verificaQuestao($idempresa) {
	mysql_query('SET CHARACTER SET utf8');
$query_empresa_usuario = "select * from questao_lista";
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




 
	