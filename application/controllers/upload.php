<?php if ( !defined('BASEPATH')) exit ('Não é permitido acesso direto ao site!');
date_default_timezone_set('America/Sao_Paulo');
class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		autoriza();
		
		$this->load->view('upload/upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		autoriza();
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|odt|jpeg|xls|csv|ppt|xlsx|pptx|xml|mpp';
		$config['max_size']	= '500000';
		//$config['max_width']  = '1024';
	//	$config['max_height']  = '768';
		$config['max_filename'] = '0';
		$dateInserirArquivo = date('dmy');
		$config['file_name'] = $this->input->post("idprogresso_acao").'_'.$dateInserirArquivo.'_';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			
			$error = array('error' => $this->upload->display_errors(), "idprogresso_acao" => $this->input->post("idprogresso_acao"), "id_acao" => $this->input->post('id_acao'),
			"origem" => $this->input->post("origem_infomacao_progresso"));

			$this->load->view('arquivo/novaEvidencia', $error);
		}
		else
		{
			
		//print_r($this->upload->data());
		//die();
			//DADOS DO ARQUIVO
			$dadosArquivo = $this->upload->data();
			$nome_salvo_sistema = $dadosArquivo['file_name'];
			$nome_arquivo_cliente = $dadosArquivo['client_name'];
			
			$this->load->model("questoes_model");
			$date = date('Y-m-d H:i:s');
			//, "dt_inclusao" => $date
			
			if ($this->input->post("tipoInsercao") == "imagem_em_questao") {
				$dados = array("nome_imagem_questao_sistema" => $nome_salvo_sistema, "nome_imagem_questao" => $nome_arquivo_cliente);
				
				$this->questoes_model->insereImagemQuestao($dados, $this->input->post('id_questao'));
			} else {
				$dados = array("nome_imagem_item_sistema" => $nome_salvo_sistema, "nome_imagem_item" => $nome_arquivo_cliente);
				
				$this->questoes_model->insereImagemItem($dados, $this->input->post('id_questao'));
				
			}
			
			$data = array('upload_data' => $this->upload->data()); //Essa vari�vel data cont�m todos o relat�rio da inser��o
			
			$id_acao = $this->input->post('id_acao');
			//$dadosProgresso = array("dadosprogresso" => $progresso, "idacao" =>$idacao, "idresponsaveltecnico" => $responsavelTecnico);
			
			//$this->load->template("progresso/index", $dadosProgresso);
			if ($this->input->post("origem_infomacao_progresso") == 'novo_progresso') {
				redirect("progresso/index/{$id_acao}/porPerfil");
				
			} else {
				$this->load->view('arquivo/sucesso');
			}
			//redirect("progresso/index/{$this->input->post("idprogresso_acao")}");
			
		//	$this->load->template('progresso/index');
			
			//$this->load->view('upload/upload_success', $data);
		}
	}
	
	
	
	function inserirFotoEmpresa()
	{
		
		autoriza();
	
		$config['upload_path'] = './uploads/imagens_contas/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|odt|jpeg|xls|csv|ppt|xlsx|pptx|xml|mpp';
		$config['max_size']	= '500000';
		//$config['max_width']  = '1024';
		//	$config['max_height']  = '768';
		$config['max_filename'] = '0';
		$dateInserirArquivo = date('dmy');
		$config['file_name'] = $this->input->post("idEmpresa").'_'.$dateInserirArquivo.'_';
		$this->load->library('upload', $config);
	
		if (!$this->upload->do_upload())
		{
	
			$error = array('error' => $this->upload->display_errors(), "idEmpresa" => $this->input->post('idEmpresa'));
	
			$this->load->view('empresa/inserirFoto', $error);
		}
		else
		{
	
		
			$dadosArquivo = $this->upload->data();
			$nome_salvo_sistema = $dadosArquivo['file_name'];
			$nome_arquivo_cliente = $dadosArquivo['client_name'];
	
			$this->load->model("empresa_model");
			$date = date('Y-m-d H:i:s');
			//, "dt_inclusao" => $date
	
	
			$dados = array("nome_foto_sistema" => $nome_salvo_sistema, "nome_foto_usuario" => $nome_arquivo_cliente);
			
			$this->empresa_model->insereFoto($dados, $this->input->post('idEmpresa'));
	
				
	
			$data = array('upload_data' => $this->upload->data()); //Essa vari�vel data cont�m todos o relat�rio da inser��o
	
			$id_acao = $this->input->post('id_acao');
			//$dadosProgresso = array("dadosprogresso" => $progresso, "idacao" =>$idacao, "idresponsaveltecnico" => $responsavelTecnico);
	
			//$this->load->template("progresso/index", $dadosProgresso);
			if ($this->input->post("origem_infomacao_progresso") == 'novo_progresso') {
				redirect("progresso/index/{$id_acao}/porPerfil");
	
			} else {
				$this->load->view('arquivo/sucesso');
			}
	
		}
	}
	
	function inserirFoto()
	{
		autoriza();
	
		$config['upload_path'] = './uploads/imagens_contas/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|odt|jpeg|xls|csv|ppt|xlsx|pptx|xml|mpp';
		$config['max_size']	= '500000';
		//$config['max_width']  = '1024';
		//	$config['max_height']  = '768';
		$config['max_filename'] = '0';
		//$dateInserirArquivo = date('America/Sao_Paulo');
		$config['file_name'] = $this->input->post("idprogresso_acao");
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
				
			$error = array('error' => $this->upload->display_errors(), "idprogresso_acao" => $this->input->post("idprogresso_acao"), "id_acao" => $this->input->post('id_acao'),
					"origem" => $this->input->post("origem_infomacao_progresso"));
	
			$this->load->view('arquivo/novaEvidencia', $error);
		}
		else
		{
				
			//print_r($this->upload->data());
			//die();
			//DADOS DO ARQUIVO
			$dadosArquivo = $this->upload->data();
			$nome_salvo_sistema = $dadosArquivo['file_name'];
			$nome_arquivo_cliente = $dadosArquivo['client_name'];
				
			$this->load->model("usuarios_model");
			//$date = date('Y-m-d H:i:s');
			//, "dt_inclusao" => $date
				
		
				$dados = array("nome_foto_sistema" => $nome_salvo_sistema, "nome_foto_usuario" => $nome_arquivo_cliente);
	
				$this->usuarios_model->insereFoto($dados, $this->input->post('idUsuario'));
	
			
				
			$data = array('upload_data' => $this->upload->data()); //Essa vari�vel data cont�m todos o relat�rio da inser��o
				
			$id_acao = $this->input->post('id_acao');
			//$dadosProgresso = array("dadosprogresso" => $progresso, "idacao" =>$idacao, "idresponsaveltecnico" => $responsavelTecnico);
				
			//$this->load->template("progresso/index", $dadosProgresso);
			if ($this->input->post("origem_infomacao_progresso") == 'novo_progresso') {
				redirect("progresso/index/{$id_acao}/porPerfil");
	
			} else {
				$this->load->view('arquivo/sucesso');
			}

		}
	}
	
	
	
	
}
?>