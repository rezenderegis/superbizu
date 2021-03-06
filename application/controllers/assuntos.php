<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class assuntos extends CI_Controller {
	
	public function index() {
		
		$this->load->model("assuntos_model");
		$assuntos = $this->assuntos_model->traz_itens();
		
		//Dados para o formulário de assuntos
		
		$idEmpresa = $this->session->userdata('idempresa');
		$this->load->model("materias_model");
		$materias = $this->materias_model->traz_materias($idEmpresa);
		$assuntosParaFormulario = $this->assuntos_model->traz_itens();
				
		
		//Dados para o formulário de assuntos
		
		
		$dados = array("assuntos" => $assuntos, "materias" => $materias, "assuntosParaFormulario" => $assuntosParaFormulario);
		$this->load->template2("assuntos/index", $dados);
	}
	
	public function formulario($id_assunto=0, $dados_formulario=0) {
	
		$this->load->model("assuntos_model");
		
		$assunto_editar = 0;
		if ($id_assunto != 0) {
			$assunto_editar = $this->assuntos_model->traz_itens($id_assunto);
			
		} 
		if ($dados_formulario != 0) {
			$assunto_editar = $dados_formulario;	
		}
		
		$materias = $this->assuntos_model->traz_materias();
		$assuntos = $this->assuntos_model->traz_itens();
		
		$dados = array("assuntos" => $assuntos, "assunto_informado" => $assunto_editar, "materias" => $materias, "id_assunto" => $id_assunto);
		
		$this->load->template2("assuntos/formulario", $dados);
	}
	
	public function novo() {
		
		$this->load->library("form_validation");
		//$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>")
		
		//RODA A VALIDA��O
	
			
		$dados = array ("descricao_assunto" => $this->input->post("descricao"),
		"id_materia" => $this->input->post("materia"),
		"id_assunto_pai" => $this->input->post("assunto_pai"),
		"ID_DONO" => $this->session->userdata("idempresa"));
		
		$this->form_validation->set_rules("descricao", "descricao", "required");
		$this->form_validation->set_rules("materia", "materia", "required");
		
		//die();
		$sucesso = $this->form_validation->run();
		
		
		if ($sucesso) {
			$this->load->model("assuntos_model");
				
			if (!$this->input->post("id_assunto_alterar")) {
				$this->assuntos_model->salva($dados);
			} else {
				
				$this->assuntos_model->atualizar_assuntos($dados, $this->input->post("id_assunto_alterar"));
			}
			redirect("assuntos/index");
		} else {
			
			$dados_formulario = array("DESCRICAO_ASSUNTO" => $this->input->post("descricao"), "ID_MATERIA" => $this->input->post("materia"), "ID_ASSUNTO_PAI" => $this->input->post("assunto_pai") 
					
			);
			
			$this->formulario($this->input->post("id_assunto_alterar"), $dados_formulario);
		}
		
		
		
	}
	
	public function novoAssuntoFromIndex() {

		$this->load->library("form_validation");
		//$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>")
		
		//RODA A VALIDA��O
		
			
		$dados = array ("descricao_assunto" => $this->input->post("descricao"),
				"id_materia" => $this->input->post("materia"),
				"id_assunto_pai" => $this->input->post("assunto_pai"),
				"ID_DONO" => $this->session->userdata("idempresa"));
		
		$this->form_validation->set_rules("descricao", "descricao", "required");
		$this->form_validation->set_rules("materia", "materia", "required");
		
		//die();
		$sucesso = $this->form_validation->run();
		
		
		if ($sucesso) {
			$this->load->model("assuntos_model");
		
			if (!$this->input->post("id_assunto_alterar")) {
				$this->assuntos_model->salva($dados);
			} else {
		
				$this->assuntos_model->atualizar_assuntos($dados, $this->input->post("id_assunto_alterar"));
			}
			redirect("assuntos/index");
		} else {
				
			$dados_formulario = array("DESCRICAO_ASSUNTO" => $this->input->post("descricao"), "ID_MATERIA" => $this->input->post("materia"), "ID_ASSUNTO_PAI" => $this->input->post("assunto_pai")
						
			);
				
			$this->index(0, $dados_formulario);
		}
		
	}
	
	public function excluir($idAssunto) {
		
		$this->load->model("assuntos_model");
		$this->assuntos_model->exluirAssunto($idAssunto);
		
	}
}