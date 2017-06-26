<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils extends CI_Controller {

	public function migrate(){
	
		$this->load->library("migration");
		$success = $this->migration->current();
		
		if ($success){
		
			echo 'Migrado';
		
		} else {
		
		
			show_error($this->migration->error_string());
		
		}
	}
	
	
	public function converteArrayEmString ($array, $parametro) {
		
		$qtd = count($array);
		
		$contador = 0;
		$grupoRetorno = "";
		
		foreach ($array as $dados) {
				
			$contador++;
			$grupoRetorno .= $dados[$dados];
				
			if ($contador < $qtd) {
				$grupoRetorno .= ",";
			}
		}
		return $grupoRetorno;
	
		
	}


}