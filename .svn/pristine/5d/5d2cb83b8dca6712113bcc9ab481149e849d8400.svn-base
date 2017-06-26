<?php if ( !defined('BASEPATH')) exit ('N�o � permitido acesso direto ao site!');


class MY_Loader extends CI_Loader {

	public function template($nome, $dados = array()) {
		//DEFINI O VALOR PADR�O COMO ARRAY VAZIA POR QUE NEM TODOS TEM O SEGUNDO PAR�METRO
		$this->view("cabecalho.php");
		$this->view($nome,$dados);
		$this->view("rodape.php");
	}
	
	
	
	public function template2($nome, $dados = array()) {
		//DEFINI O VALOR PADR�O COMO ARRAY VAZIA POR QUE NEM TODOS TEM O SEGUNDO PAR�METRO
		$this->view("cabecalho");
		$this->view($nome,$dados);
		$this->view("rodape2.php");
	}
	
	public function templateCelular($nome, $dados = array()) {
		//DEFINI O VALOR PADR�O COMO ARRAY VAZIA POR QUE NEM TODOS TEM O SEGUNDO PAR�METRO
		$this->view("cabecalhoCelular.php");
		$this->view($nome,$dados);
		$this->view("rodape.php");
	}

}