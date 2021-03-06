<?php if ( !defined('BASEPATH')) exit ('N�o � permitido acesso direto ao site!');
class Arquivo extends CI_Controller {
	
	
	function index() {
		autoriza();
		
		$this->load->helper('directory');
	
		$map = directory_map('uploads/', FALSE, TRUE);
		

	
	} 
	
	function trazEvidencias($idprogresso_acao=0, $informarPercentual=0) {
		autoriza();
		
		
		
		$this->load->model("arquivo_model");
		$arquivos = $this->arquivo_model->buscaArquivos($idprogresso_acao);
		
		$dados = array("arquivos" => $arquivos, "podeExcluirArquivo" => $informarPercentual);

		$this->load->view("arquivo/documentos", $dados);
		
		
	}
	
	
	function novaEvidencia($id_questao='') {
		autoriza();
		
		$dados = array("id_questao" => $id_questao, "error" => '', "tipoInsercao" => "imagem_em_questao");
		$this->load->view('arquivo/novaEvidencia', $dados);
		
	}
	
	function novaImagemItem($id_item) {
		autoriza();
		
		$dados = array("id_questao" => $id_item, "error" => '', "tipoInsercao" => "imagem_em_arquivo");
		$this->load->view('arquivo/novaEvidencia', $dados);
		
	}
	
	function deletarArquivo($idarquivo) {
		autoriza();
		
		$this->load->model("arquivo_model");
		$this->arquivo_model->deletarArquivo($idarquivo);
		
		$this->load->view("arquivo/exclusaoSucesso");
	}
	
}

?>