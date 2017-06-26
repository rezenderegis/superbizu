<?php
//header ('Content-type: text/html; charset=UTF-8');

$conexao = mysql_connect('localhost','root','rnk30g')
or die('Não foi possível conectar ao banco. Erro: '.mysql_errno().mysql_error());

mysql_selectdb('mysale',$conexao)
or die('Não foi possível conectar ao banco. Erro: '.mysql_errno().mysql_error());


?>
