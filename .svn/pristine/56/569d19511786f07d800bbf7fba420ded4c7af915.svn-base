<?php
class Exemplo extends CI_Controller {
	
	public function add_all(){
		
		#Validate entry form information
		$this->load->model("exemplo_model");
		$data['states'] = $this->exemplo_model->get_state(); //gets the available groups for the dropdown
		
		
		$this->load->template2('exemplos/formulario', $data);
		
		/*if ($this->form_validation->run() == FALSE)
		{
			$this->load->template2('exemplos/formulario', $data);
		}
		else
		{
		#Add Member to Database
			$this->Model_form->add_all();
			$this->load->view('exemplos/formulario');
		}*/
		}
	
	/*function add_all()
	{
		$v_state = $this->input->post('f_state');
		$v_membername = $this->input->post('f_membername');
	
		$data = array(
				'id' => NULL,
				'state' => $v_state,
				'member_name' => $v_membername,
		);
	
		$this->db->insert('members', $data);
	}*/
	
	function get_cities($state){
		$this->load->model('exemplo_model','', TRUE);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->exemplo_model->get_cities_by_state($state)));
	}
	
	
}