<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Questoes extends CI_Controller {

	public function teste() {
		echo "asdfasdfasd";
	}
	public function index($idEmpresaNaoUtilizado = 0, $id_questao=0) {
		autoriza ();
		// UTILIZADO PARA DEBUGAR
		// $this->output->enable_profiler(TRUE);

		// CARREGA O BANCO DE DADOS
		// $this->load->database();

		// CARREGAR O MODELO PARA US�L-LO
		$idEmpresa = $this->session->userdata('idempresa');

		$this->load->model ( "questoes_model" );
		// $empresa = $this->session->userdata("idempresa");
		$questoes = $this->questoes_model->buscaTodos ($id_questao);

		$this->load->helper ( array (
				"currency"
		) );
		// $this->load->helper("currency");

		// ADICIONA HELPER DE CRIA��O DE FORMUL�RIO
		// $this->load->helper("form");

		$dados = array (
				"questoes" => $questoes
		);
		// $this->load->view("cabecalho.php");
		$this->load->template2 ( "questoes/index.php", $dados );
		// $this->load->view("rodape.php");
	}

	public function indexEnem($idEmpresaNaoUtilizado = 0, $id_questao=0) {
		autoriza ();
		// UTILIZADO PARA DEBUGAR
		// $this->output->enable_profiler(TRUE);

		// CARREGA O BANCO DE DADOS
		// $this->load->database();

		// CARREGAR O MODELO PARA US�L-LO
		$idEmpresa = $this->session->userdata('idempresa');

		$this->load->model ( "questoes_model" );
		// $empresa = $this->session->userdata("idempresa");
		$questoes = $this->questoes_model->buscaTodos ($id_questao, "ENEM");

		$this->load->helper ( array (
				"currency"
		) );
		// $this->load->helper("currency");

		// ADICIONA HELPER DE CRIA��O DE FORMUL�RIO
		// $this->load->helper("form");

		$dados = array (
				"questoes" => $questoes
		);
		// $this->load->view("cabecalho.php");
		$this->load->template2 ( "questoes/indexEnem.php", $dados );
		// $this->load->view("rodape.php");
	}

	public function listaItens($id_questao) {
		$this->load->model ( "questoes_model" );
		$dados_itens = $this->questoes_model->buscaItens ( $id_questao );
		$dados = array (
				"itens" => $dados_itens,
				"id_questao" => $id_questao
		);
		$this->load->template2 ( "questoes/listaItens", $dados );
	}
	public function formulario_item($id_questao = 0, $id_item = 0) {

		// $this->load->model("questoes_model");
		// $dados_item = $this->questoes_model->buscaItens();
		$dados_item = 0;

		if ($id_item != 0) {
			$this->load->model ( "questoes_model" );
			$dados_item = $this->questoes_model->traz_dados_item ( $id_item );
		}

		$dados = array (
				"dados_item_edicao" => $dados_item,
				"id_questao" => $id_questao,
				"id_item" => $id_item
		);

		$this->load->template2 ( "questoes/formulario_item", $dados );
	}
	public function formulario($id_questao = 0, $dados_formulario = 0) {
		autoriza ();

		$this->load->model ( "questoes_model" );
		$assunto_questao = 0;
		$dados_produto = 0;
		if ($id_questao != 0) {
			$dados_produto = $this->questoes_model->traz_dados_edicao ( $id_questao );
			$assunto_questao = $this->questoes_model->busca_assunto_materia ( $id_questao );
		}

		if ($dados_formulario != 0) {
			$dados_produto = $dados_formulario;
			$assunto_questao = $dados_formulario ['ASSUNTO_QUESTAO'];
		}

		$categoria_produto = $this->questoes_model->busca_categoria ();
		$dados_categoria = array (
				"categoria_produto" => $categoria_produto,
				"dados_produto_edicao" => $dados_produto,
				"assunto_questao" => $assunto_questao,
				"id_questao" => $id_questao

		);

		$this->load->template2 ( "questoes/formulario", $dados_categoria );
	}
	public function novo_item() {
		$this->load->model ( "questoes_model" );
		$this->load->library ( "form_validation" );

		///$this->form_validation->set_rules ( "descricao", "Descrição da ítem", "required" );

	//	$sucesso = $this->form_validation->run ();
		$sucesso = 1;
		if ($sucesso) {

			if (! $this->input->post ( "id_item" )) {
				$item = array (
						"descricao" => $this->input->post ( "descricao" ),
						"id_questao" => $this->input->post ( "id_questao" ),
						"letra_item" => $this->input->post ( "letra_item" )
				);

				$this->questoes_model->salva_item ( $item );
			} else {
				$item = array (
						"descricao" => $this->input->post ( "descricao" ),
						"letra_item" => $this->input->post ( "letra_item" )
				);

				$this->questoes_model->atualiza_item ( $item, $this->input->post ( "id_item" ) );
			}
			$this->session->set_flashdata ( "success", "Item criado com sucesso!" );

			redirect ( 'questoes/listaItens/' . $this->input->post ( "id_questao" ) );
		} else {

			if ($this->input->post ( "id_item" ) != 0) {

				$id_item = $this->input->post ( "id_item" );

			}else {
				$id_item = 0;
			}
			$id_questao = $id_questao = $this->input->post ( "id_questao" );

			/*
			$dados_item = 0;
			if ($id_item != 0) {
				$this->load->model ( "questoes_model" );
				$dados_item = $this->questoes_model->traz_dados_item ( $id_item );
			}
			$id_questao = $id_questao = $this->input->post ( "id_questao" );

			$dados = array (
					"dados_item_edicao" => $dados_item,
					"id_questao" => $id_questao,
					"id_item" => $id_item
			);
			*/



			//$this->load->helper('url');
			//redirect_back();
			//$this->load->template2("questoes/formulario_item", $dados);
			//redirect('questoes/formulario_item/'.$id_questao."/".$id_item, 'refresh');
				$this->formulario_item($id_questao,$id_item);
		}
	}




	public function novo() {
		autoriza ();
		$dt_atual = date ( 'Y-m-d H:i:s' );

		// CARREGAR BIBLIOTECA DE VALIDA��O
		$this->load->library ( "form_validation" );

		// ADICIONAR UMA REGRA DE VALIDAÇÃO
		$this->form_validation->set_rules ( "nome", "Questão", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME
	//	$this->form_validation->set_rules ( "numero_questao", "Número da Questão", "required" );
	//	$this->form_validation->set_rules ( "ano", "Ano da Questão", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME
	//	$this->form_validation->set_rules ( "comando", "Comando da Questão", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME
	//	$this->form_validation->set_rules ( "comentario_questao", "Comentário da Questão", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME
		$this->form_validation->set_rules ( "letra_item", "Item Correto", "letra_item" );

	//	$this->form_validation->set_rules ( "assunto_questao", "Assunto da Questão", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME

	//	$this->form_validation->set_rules ( "ano", "ano" );
		// $this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>")

		// RODA A VALIDA��O
		$sucesso = $this->form_validation->run ();

		// SE PASSAR NAS REGRAS DE VALIDA��O
		if ($sucesso) {
			$empresa = $this->session->userdata ( "idempresa" );
			$usuarioLogado = $this->session->userdata ( "usuario_logado" );
			$this->load->model ( "questoes_model" );

			$produto = array (
					"descricao_questao" => $this->input->post ( "nome" ),
					"ano_questao" => $this->input->post ( "ano" ),
					"comando_questao" => $this->input->post ( "comando" ),
					"comentario_questao" => $this->input->post ( "comentario_questao" ),
					"numero_questao" => $this->input->post ( "numero_questao" ),
					"letra_item_correto" => $this->input->post ( "letra_item" ),
					"aplicacao" => $this->input->post ( "aplicacao" ),
					"dia_prova" => $this->input->post ( "dia_prova" ),
					"ID_DONO" => $this->session->userdata("idempresa")

			)
			;

			$this->load->model ( "questoes_model" );
			$this->load->model("usuarios_model");
			if ($this->input->post ( "id_produto_alterar" )) {

				// Altera��o de produto
				//$this->questoes_model->atualizar_produto ( $this->input->post ( "id_produto_alterar" ), $this->input->post ( "id_produto_alterar" ), $produto );
				//$this->usuarios_model->salva_log_acesso("Alterou Questão", $this->input->post ( "id_produto_alterar" ));

				$this->questoes_model->atualizar_questao ( $this->input->post ( "id_produto_alterar" ), $this->input->post ( "id_produto_alterar" ), $produto );

				if ($produto['comentario_questao']) {
					$comentario = "Comentário Inserido ".$produto['comentario_questao'];
				} else {
					$comentario = "Sem Comentário";
				}
				$this->usuarios_model->salva_log_acesso("Alterou Questão", $this->input->post ( "id_produto_alterar" ), $comentario);

				$this->questoes_model->deleta_assuntos_anteriores ( $this->input->post ( "id_produto_alterar" ) );
				$dados_assunto = array (
						"ID_QUESTAO" => $this->input->post ( "id_produto_alterar" ),
						"ID_ASSUNTO" => $this->input->post ( "assunto_questao" )
				);
				// print_r($dados_assunto);

				$this->questoes_model->salva_assunto_questao ( $dados_assunto );
				$ultimaQuestaoInserida = $this->input->post ( "id_produto_alterar" );
			} else {
				// Cria��o de novo produto

				$this->questoes_model->salva ( $produto );

				if ($produto['comentario_questao']) {
					$comentario = "Comentário Inserido ".$produto['comentario_questao'];
				} else {
					$comentario = "Sem Comentário";
				}


				$ultimaQuestaoInserida = $this->questoes_model->buscaUltimaQuestaoInserida ();
				$this->usuarios_model->salva_log_acesso("Cadastrou Questão", $ultimaQuestaoInserida['id_questao'], $comentario);

				$dados_assunto = array (
						"ID_QUESTAO" => $ultimaQuestaoInserida ['id_questao'],
						"ID_ASSUNTO" => $this->input->post ( "assunto_questao" )
				);
				// print_r($dados_assunto);

				$this->questoes_model->salva_assunto_questao ( $dados_assunto );

				$ultimaQuestaoInserida = $ultimaQuestaoInserida ['id_questao'];
			}

			$this->session->set_flashdata ( "success", "Questão salvo com sucesso" );

			// redirect ( 'questoes/index/0/'.$ultimaQuestaoInserida);
			redirect ( 'questoes/exibir/'.$ultimaQuestaoInserida);
		} else {

			$dados_formulario = array (
					"DESCRICAO_QUESTAO" => $this->input->post ( "nome" ),
					"ANO_QUESTAO" => $this->input->post ( "ano" ),
					"COMANDO_QUESTAO" => $this->input->post ( "comando" ),
					"COMENTARIO_QUESTAO" => $this->input->post ( "comentario_questao" ),
					"NUMERO_QUESTAO" => $this->input->post ( "numero_questao" ),
					"ASSUNTO_QUESTAO" => $this->input->post ( "assunto_questao" ),
					"LETRA_ITEM_CORRETO" => $this->input->post ( "letra_item" ),
					"APLICACAO" => $this->input->post ( "aplicacao" ),
					"DIA_PROVA" => $this->input->post ( "dia_prova" )
			);

			$this->formulario ( 0, $dados_formulario );
		}
	}
	public function mostra($id) {
		// $id = $this->input->get("id");
		$this->load->model ( "questoes_model" );
		$produto = $this->questoes_model->busca ( $id );
		$dados = array (
				"produto" => $produto
		);
		$this->load->helper ( "typography" );
		$this->load->template2 ( "produtos/mostra", $dados );
	}
	public function formularioCategoria($id_produto = 0) {
		autoriza ();

		$dados_categoria_edicao = 0;
		if ($id_produto != 0) {
			$this->load->model ( "questoes_model" );
			$dados_categoria_edicao = $this->questoes_model->busca_categoria ( $id_produto );
		}

		$dados = array (
				"dados_categoria_edicao" => $dados_categoria_edicao
		);
		$this->load->template2 ( "produtos/formularioCategoria", $dados );
	}
	public function novaCategoria() {
		autoriza ();
		$dt_atual = date ( 'Y-m-d H:i:s' );

		// CARREGAR BIBLIOTECA DE VALIDA��O
		$this->load->library ( "form_validation" );

		// ADICIONAR UMA REGRA DE VALIDA��O

		$this->form_validation->set_rules ( "nome_categoria", "nome_categoria", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME
		$this->form_validation->set_rules ( "grupoproduto", "grupoproduto", "required" ); // REGRA PARA O CAMPO NOME LABEL NOME

		$sucesso = $this->form_validation->run ();

		if ($sucesso) {

			$this->load->model ( "questoes_model" );
			// die();
			if (! $this->input->post ( "id_categoria_produto" )) {
				$categoria = array (
						"nomecategoriaproduto" => $this->input->post ( "nome_categoria" ),
						"idempresa" => $this->session->userdata ( "idempresa" ),
						"codigogrupoproduto" => $this->input->post ( "grupoproduto" ),
						"dt_criacao_site" => $dt_atual
				)
				;
				$this->questoes_model->salvaCategoria ( $categoria );
			} else {
				$categoria = array (
						"nomecategoriaproduto" => $this->input->post ( "nome_categoria" ),
						"idempresa" => $this->session->userdata ( "idempresa" ),
						"codigogrupoproduto" => $this->input->post ( "grupoproduto" ),
						"dt_alteracao_site" => $dt_atual
				)
				;
				$this->questoes_model->atualizar_categoria ( $categoria, $this->session->userdata ( "idempresa" ), $this->input->post ( "id_categoria_produto" ) );
			}
			redirect ( "produtos/indexCategoria" );
		} else {

			// $this->load->template2("produtos/formularioCategoria");
			$this->formularioCategoria ();
		}
	}
	public function indexCategoria() {
		$this->load->model ( "questoes_model" );
		$categoria = $this->questoes_model->busca_categoria ();
		$dadosCategoria = array (
				"categoria" => $categoria
		);

		$this->load->template2 ( "produtos/indexCategoria", $dadosCategoria );
	}


	public function verDetalheQuestao ($idLista) {

		autoriza ();

		$this->load->model ( "questoes_model" );
		// $empresa = $this->session->userdata("idempresa");
		$questoes = $this->questoes_model->buscaQuestoesPorLista ($idLista);

		$this->load->helper ( array (
				"currency"
		) );
		// $this->load->helper("currency");

		// ADICIONA HELPER DE CRIA��O DE FORMUL�RIO
		// $this->load->helper("form");

		$dados = array (
				"questoes" => $questoes, "idLista" => $idLista
		);
		// $this->load->view("cabecalho.php");
		$this->load->template2 ( "questoes/verDetalheQuestao.php", $dados );
		// $this->load->view("rodape.php");


	}

	public function verDetalhePopup ($idLista=1) {


		autoriza ();

		$this->load->model ( "questoes_model" );
		// $empresa = $this->session->userdata("idempresa");
		$questoes = $this->questoes_model->buscaQuestoesPorListaJSON ($idLista);

		$this->load->helper ( array (
				"currency"
		) );
		print_r($questoes);

	}

	public function desativarQuestao ($idQuestao) {

		$this->load->model("questoes_model");

		$this->questoes_model->desativarQuestao($idQuestao);

		$this->questoes_model->desativarItem($idQuestao);

		redirect ( 'questoes/index/0/');

	}

	public function desativarItemEspecifico ($idQuestao, $idItem) {

		$this->load->model("questoes_model");

		$this->questoes_model->desativarItemEspecifico($idItem);

		$this->listaItens($idQuestao);

	}

	public function deletarQuestaoDaLista ($idLista, $idQuestao) {

		$this->load->model("questoes_model");

		$this->questoes_model->deletarQuestaoDaLista($idLista, $idQuestao);

		$this->verDetalheQuestao($idLista);

	}

    /**
    * Ações: Exibi a questão e gerencia seus itens.
    * @param integer $id_questao
    * @return string
    */
	public function exibir($id_questao) {
        autoriza();
        $this->load->model('questoes_model');
        $model = $this->questoes_model;
        $questao = $model->dados($id_questao);

        if (!$questao) show_error('Página não encontrada', 404);

        $this->load->helper('url');

        $this->load->template2('questoes/exibir.php', [
            'model' => $this->questoes_model,
            'questao' => $questao,
        ]);
    }

    /**
    * @return string Itens de uma questão em formato json.
    */
    public function itens($id_questao) {
        $this->load->model('questoes_model');
        $model = $this->questoes_model;
        $itens = $model->buscaItens($id_questao);

        // foreach ($itens as &$item) {
        //     $item['DESCRICAO'] = htmlentities($item['DESCRICAO']);
        // }

        echo json_encode(array_values($itens));
	}

    /**
    * @return string Cadastra o item de uma questão e retorna um json.
    */
    public function cadastrarItem($id_questao) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('questoes_model');
        $model = $this->questoes_model;
        $validation = $this->form_validation;
        $letras = ['' => 'Selecione', 'A' => 'A','B' => 'B','C' => 'C','D' => 'D','E' => 'E'];
        $eValido = false;
        $vazio = [
            'ID_QUESTAO' => $id_questao,
            'ID_ITEM' => '',
            'LETRA_ITEM' => '',
            'DESCRICAO' => '',
        ];

        $validation->set_rules('LETRA_ITEM', 'Letra', 'required');
        $validation->set_rules('DESCRICAO', 'Descrição', 'required');

        $dados = $this->input->post(null, true);
        $ePost = $dados !== false;
        $dados['ID_QUESTAO'] = $id_questao;

        if ($ePost && ($eValido = $validation->run())) {
            $model->salva_item($dados);
            $dados = $vazio;
            $dados['status'] = 'save';
        }

        if (!$ePost) {
            $dados = $vazio;
        }

        $this->load->view('questoes/_form-item', [
            'item' => $dados,
            'letras' => $letras
        ]);
    }

    /**
    * @return string Altera um item de uma questão e retorna um json.
    */
    public function alterarItem($id_item) {
        $this->load->model('questoes_model');
        $model = $this->questoes_model;
        $item = $model->traz_dados_item($id_item);
        $letras = ['' => 'Selecione', 'A' => 'A','B' => 'B','C' => 'C','D' => 'D','E' => 'E'];

        if (!$item) show_error('Página não encontrada', 404);

        $this->load->helper('form');
        $this->load->library('form_validation');
        $validation = $this->form_validation;
        $eValido = false;
        $resultado = $model->buscaItens($item['ID_QUESTAO']);

        $validation->set_rules('LETRA_ITEM', 'Letra', 'required');
        $validation->set_rules('DESCRICAO', 'Descrição', 'required');

        $dados = $this->input->post(null, true);

        if ($dados && ($eValido = $validation->run())) {
            $model->atualiza_item($dados, $id_item);
            $item = $dados;
            $item['ID_ITEM'] = $id_item;
        }

        $this->load->view('questoes/_form-item', [
            'item' => $item,
            'letras' => $letras
        ]);
    }

    /**
    * @return void Exclui um item.
    */
    public function excluirItem() {
        $this->load->model('questoes_model');
        $dados = $this->input->post(null, true);
        $this->questoes_model->desativarItemEspecifico($dados['id_item']);
    }

    /**
    * @return string Retorna um json com a url para o arquivo.
    */
    public function upload() {
        if (($file = $_FILES['image']) && isset($file)) {
            if ($file['error'] == UPLOAD_ERR_OK) {
                $local = 'uploads/var';
                $uploads_dir = dirname(__DIR__) . "/../$local";
                $rand = time() . rand(0,9);
                $newname = hash('crc32', $rand, false);
                $tmp_name = $file['tmp_name'];
                $oldname = basename($file['name']);
                $dot = strrpos($oldname,'.');
                $ext = substr($oldname, $dot);
                $newname .= $dot === false ? '' : $ext;
                $path = "$uploads_dir/$newname";
                move_uploaded_file($tmp_name, $path);
                echo json_encode(['url' => base_url("$local/$newname")]);
            }
        }
    }

}
