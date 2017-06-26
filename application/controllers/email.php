<?php
class Email extends CI_Controller {
	
	public function enviar_email_acoes_sem_progresso () {
		
		$this->load->model("email_model");
		
		$this->load->model("progresso_model");
		
		$acoes_sem_progresso = $this->progresso_model->busca_acoes_sem_progresso();
		
		
		$this->email_model->enviar_email_acoes_sem_progresso($acoes_sem_progresso);
		
	
		$dados = array("dados_acoes_sem_progresso" => $acoes_sem_progresso );
		
		$this->session->set_flashdata("success", "E-mails enviados com sucesso");
		
		$this->load->template("progresso/acoes_sem_progresso", $dados);
	}
	
	
}