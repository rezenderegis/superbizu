<?php
//print_r($_REQUEST);
include "mysale_conexao.php"; 

$json = file_get_contents('php://input'); 
$parsed = json_decode($json,true);

//header ('Content-type: text/html; charset=iso-8859-1');
if (array_key_exists("usuario", $parsed)) {
foreach ($parsed['usuario'] as $key => $values){
//print_r($parsed['usuario']);
	//print_r($values[0]['tipoSincronizacao']);
//	print_r($values['tiposincronizacao']);
	if ($values['tiposincronizacao'] == 'produto') {
 	$empresa = $values['idempresa'];
	
	
	
	$resultado = verificaProdutoEmpresa($empresa);
	
} else if ($values['tiposincronizacao'] == 'cliente') {
$empresa = $values['idempresa'];
	
	
	
	$resultado = verificaClienteEmpresa($empresa);
	

} else if ($values['tiposincronizacao'] == 'categoria') {
$empresa = $values['idempresa'];
	
	
	
	$resultado = verificaCategoriaProdutoEmpresa($empresa);

} else if ($values['tiposincronizacao'] == 'busca_usuario') {
	$id_usuario = $values['idusuario'];
	$id_empresa = $values['idempresa'];
	
	$resultado = buscar_dados_usuario($id_usuario, $id_empresa);
}

    print_r($resultado);
    
}
echo "Produtos baixados com sucesso!";

}




function verificaProdutoEmpresa($idempresa) {
	mysql_query('SET CHARACTER SET utf8');
$query_empresa_usuario = "SELECT id, nomeproduto,preco,categoria FROM produto WHERE IDEMPRESA = '".$idempresa."'";
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
 
    $json_result["produtos"] [ ] =  $fields;
	}
	
	
$JSON = json_encode($json_result, JSON_UNESCAPED_UNICODE);
	
return $JSON;
			  }


function verificaCategoriaProdutoEmpresa($idempresa) {
	mysql_query('SET CHARACTER SET utf8');
	
$query_empresa_usuario = "SELECT idcategoriaproduto, nomecategoriaproduto FROM categoria_produto WHERE IDEMPRESA = '".$idempresa."'";
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
 
    $json_result["categoria"] [ ] =  $fields;
	}
	
	
$JSON = json_encode($json_result, JSON_UNESCAPED_UNICODE);
	
return $JSON;
			  }




function buscar_dados_usuario($id_usuario, $id_empresa) {
	mysql_query('SET CHARACTER SET utf8');
	
$query_empresa_usuario = "select e.sincronizacaoEntradaAplicativo as sincronizacaoEntradaAplicativo, u.id as idusuario, ue.usuario_master as usuario_master from usuario u inner join usuario_empresa ue on ue.idusuario = u.id
inner join empresa e on ue.idempresa = e.idempresa where u.id = '".$id_usuario."' and ue.idempresa = '".$id_empresa."'";
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
    
 
    $json_result["usuario"] [ ] =  $fields;
	}
		
$JSON = json_encode($json_result, JSON_UNESCAPED_UNICODE);
	return $JSON;
			  }





 function verificaClienteEmpresa($idempresa) {
			  	mysql_query('SET CHARACTER SET utf8');
			  
			  	$query_empresa_usuario = "SELECT idpessoa, nome, endereco, telefone, email,site from pessoa WHERE IDEMPRESA = '".$idempresa."'";
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
			  
			  
			  		$json_result["produtos"] [ ] =  $fields;
			  	}
			  
			  	$JSON = json_encode($json_result, JSON_UNESCAPED_UNICODE);
			  	return $JSON;
			  }

?>




 
	