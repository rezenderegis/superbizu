<?php 

	function dataPrBrParaMysql($dataPrBr){
	
		$partes = explode("/",$dataPrBr);
		return "{$partes[2]}-{$partes[1]}-{$partes[0]}";
	}
	
	function dataParaPortugues($dataMysql){
		date_default_timezone_set('America/Los_Angeles');
		$data = new DateTime($dataMysql);;
		return $data->format("d/m/Y");
		
		//return DateTime::createFromFormat('d/m/Y', $dataMysql);
	}
	
	function dataComHora($dataMysql){
		date_default_timezone_set('America/Los_Angeles');
		$data = new DateTime($dataMysql);;
		return $data->format("d/m/Y h:i:s");
	
	}