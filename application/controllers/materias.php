<?php if ( !defined('BASEPATH')) exit ('Não é permitido acesso direto ao site!');

class Materias extends CI_Controller {

    public function index(){
       
        
        $this->load->model("assuntos_model");

		$idEmpresa = $this->session->userdata('idempresa');
        $this->load->model("materias_model");
        $materias = $this->materias_model->traz_materias($idEmpresa);
       // print_r($materias); die();

        $materias = array("materias" => $materias);
        $this->load->template2 ( "materias/index", $materias);

    }

    public function salvar () {

		$idEmpresa = $this->session->userdata('idempresa');

        $this->load->model("materias_model");

        $dados = array("NOME_MATERIA" => $this->input->post("nome"), "ID_DONO" => $idEmpresa);

        $this->materias_model->salvar($dados);

        //$this->index();
        redirect ( 'materias/index' );

    }

    public function editar($id_materia) {
        $this->load->model("materias_model");
        $materia = $this->materias_model->buscaMateria($id_materia);
       
        $dados = array("idMateria" => $id_materia,
                        "nomeMateria" => $materia['NOME_MATERIA']
        );

        $this->load->template2 ( "materias/formulario", $dados);

    }

    public function alterar () {
        
        $dados = array("nome_materia" => $this->input->post("nome"));

        $this->load->model("materias_model");
        $this->materias_model->atualiza($dados, $this->input->post("id_materia"));
        redirect ( 'materias/index' );

    }

}