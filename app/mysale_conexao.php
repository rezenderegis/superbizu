<?php
header ('Content-type: text/html; charset=UTF-8');

/*
$conexao = mysql_connect('mysql01.bizu.hospedagemdesites.ws','bizu1','rnk30g')
or die('Não foi possível conectar ao banco. Erro: '.mysql_errno().mysql_error());

mysql_selectdb('bizu1',$conexao)
or die('Não foi possível conectar ao banco. Erro: '.mysql_errno().mysql_error());
*/


$conexao = mysql_connect('localhost','root','root')
or die('Não foi possível conectar ao banco. Erro: '.mysql_errno().mysql_error());

mysql_selectdb('bizu',$conexao)
or die('Não foi possível conectar ao banco. Erro: '.mysql_errno().mysql_error());


?>
