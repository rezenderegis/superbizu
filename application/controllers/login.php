<?php if ( !defined('BASEPATH')) exit ('Não é permitido acesso direto ao site!');

class Login extends CI_Controller {
	
	public function teste() {
		
		$this->load->view('usuarios/usuarioNovo2');
		
	}

public function autenticar() {

	$this->load->model("usuarios_model");
	
	$email = $this->input->post("email");
	$senha = md5($this->input->post("senha"));
	$usuario = $this->usuarios_model->buscaPorEmailESenha($email, $senha);
	if ($usuario){

			$this->session->set_userdata("usuario_logado", $usuario);//setar a sess�o
			//$this->session->set_flashdata("success", "Logado com sucesso");//DESATIVEI ESSE FLASHDATA
			//$dados = array("mensagem" => "Logado com sucesso!");
			$id_usuario_logado = $this->session->userdata['usuario_logado']['id'];
				
			$this->load->model("usuarios_model");
			$this->usuarios_model->salva_log_acesso("Entrou no sistema");
			
			redirect('geral/home'); 

	} else {

			$this->session->set_flashdata("danger", "Usuário ou senha inválidos.");
			redirect('geral/index'); 

	}
	
}
	
	public function logout() {
		$this->session->sess_destroy();
		
		//$this->session->unset_userdata("usuario_logado");
	//	$this->session->unset_userdata("idempresa");
		//$this->session->unset_userdata("login");
		
		
		//$this->load->view("login/logout");
		//$this->session->set_flashdata("success", "Deslogado com sucesso!"); //DESATIVEI ESSE FLASHDATA
		redirect('/'); 
	}

}