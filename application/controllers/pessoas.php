<?php if ( !defined('BASEPATH')) exit ('N�o � permitido acesso direto ao site!');

	class Pessoas extends CI_Controller {
	
		public function index($idempresa = 0) {
			autoriza();
			$this->load->model("pessoas_model");
			if ($idempresa == 0) {
			$idempresa = $this->session->userdata("idempresa");
			}
		
			$pessoas = $this->pessoas_model->buscaPessoas($idempresa);
			$trazPessoas = array("pessoas" => $pessoas);

			$this->load->template2("pessoas/index", $trazPessoas);			
		}
	
		
		public function formularioClientes($id_empresa=0, $id_pessoa=0) {
		
			autoriza();
			
			$dados_pessoa_edicao = 0;
			if ($id_pessoa != 0) {
				//Busca dados para edi��o
				$this->load->model("pessoas_model");
				$dados_pessoa_edicao = $this->pessoas_model->buscaPessoasEdicao($id_empresa, $id_pessoa);
			}
			
			$dados_cliente = array("dados_pessoa_edicao" => $dados_pessoa_edicao);
			$this->load->template2("pessoas/formularioClientes", $dados_cliente);

		}
		
		public function novoCliente() {
			autoriza();
			$dt_atual = date('Y-m-d H:i:s');
				
			$this->load->library("form_validation");			
			$this->form_validation->set_rules("nome", "nome", "required");
			$sucesso = $this->form_validation->run();
			
			if ($sucesso) {
			$empresa = $this->session->userdata("idempresa");

			//BUSCA PR�XIMO ID DA PESSOA
			$this->load->model("pessoas_model");
			$proximoIdPessoaEmpresa = $this->pessoas_model->buscaProximoIdPessoaEmpresa($empresa);
			
			if ($this->input->post("id_pessoa")) {
				$id = $this->input->post("id_pessoa");
				$dt_para_incluir = "dt_alteracao_site";
			} else {
				$id = $proximoIdPessoaEmpresa['id'];
				$dt_para_incluir = "dt_criacao_site";
				
			}
			$pessoa = array(
				"idpessoa" => $id,
				"nome " => $this->input->post("nome"),
				"telefone " => $this->input->post("telefone"),
				"email" => $this->input->post("email"),
				"site" => $this->input->post("site"),
				"endereco" => $this->input->post("endereco"),
				"idempresa" => $empresa,
				"$dt_para_incluir" => $dt_atual
		);
			
		
			if ($this->input->post("id_pessoa")) {
				
				$this->pessoas_model->atualiza_pessoa($this->input->post("id_empresa"), $this->input->post("id_pessoa"), $pessoa);
			} else {
				$this->pessoas_model->salva($pessoa);
			}
			$this->session->set_flashdata("success", "Cliente salvo com sucesso");
			redirect('pessoas/index');
		} else {
		
			//$this->load->template2("pessoas/formularioClientes");				
			$this->formularioClientes();
		}
	
	}
	}

