<?php
class Questoes_model extends CI_Model {
	public function buscaTodos($id_item = 0, $tipoConsulta="",$trazerQuestoesDoBizu=false) {
		//tipoConsulta = ENEM busca as questões do ENEM, a única diferença é que deve ordenar
		// return $this->db->get("produto")->result_array();
		
		$empresa_trazer = "";
		if ($trazerQuestoesDoBizu == true) {
			$empresa_trazer = array($this->session->userdata ( "idempresa"), 82);
		
		} else {
			$empresa_trazer = array($this->session->userdata ( "idempresa"));
		}
		
		
		$this->db->select ( "tb_questao.*, tb_materia.nome_materia, tb_assunto.descricao_assunto" );
		$this->db->from ( "tb_questao" );
		$this->db->join ( "tb_assunto_questao aq", "aq.id_questao = tb_questao.id_questao", "left" );
		$this->db->join ( "tb_assunto", "tb_assunto.id_assunto = aq.id_assunto", "left" );
		$this->db->join ( "tb_materia", "tb_materia.id_materia = tb_assunto.id_materia", "left" );
		$this->db->where_in ( "tb_questao.ID_DONO", $empresa_trazer );
		
		if ($id_item != 0) {
			$this->db->where ( "tb_questao.id_questao", $id_item );
		}
		$this->db->where("tb_questao.situacao", 1);
		if ($tipoConsulta == "ENEM") {
			$this->db->order_by ( "tb_questao.ano_questao desc, tb_questao.aplicacao, tb_questao.dia_prova,tb_questao.numero_questao asc");
		}
		
		return $this->db->get ()->result_array ();
		
	}
	
	
	public function buscaQuestoesNaoAdicionadasLista($idLista = 0) {
		$sql = "SELECT tb_questao.*, tb_materia.nome_materia, tb_assunto.descricao_assunto 
FROM (tb_questao) LEFT JOIN tb_assunto_questao aq ON aq.id_questao = tb_questao.id_questao
 LEFT JOIN tb_assunto ON tb_assunto.id_assunto = aq.id_assunto
 LEFT JOIN tb_materia ON tb_materia.id_materia = tb_assunto.id_materia 
 WHERE tb_questao.ID_DONO = ".$this->session->userdata ( "idempresa" )."
 AND tb_questao.id_questao not in (select idQuestao from questao_lista where idListaQuestao = ".$idLista."
)";
		
		/*$this->db->select ( "tb_questao.*, tb_materia.nome_materia, tb_assunto.descricao_assunto" );
		$this->db->from ( "tb_questao" );
		$this->db->join ( "tb_assunto_questao aq", "aq.id_questao = tb_questao.id_questao", "left" );
		$this->db->join ( "tb_assunto", "tb_assunto.id_assunto = aq.id_assunto", "left" );
		$this->db->join ( "tb_materia", "tb_materia.id_materia = tb_assunto.id_materia", "left" );
		$this->db->where ( "tb_questao.ID_DONO", $this->session->userdata ( "idempresa" ) );
		return $this->db->get ()->result_array ();*/
		
		// print_r($this->db->last_query());
		// die();
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function buscaItens($id_questao) {
		$this->db->select ( "tb_item.*" );
		$this->db->from ( "tb_item" );
		$this->db->where ( "tb_item.id_questao", $id_questao );
		$this->db->where("tb_item.situacao", 1);
		return $this->db->get ()->result_array ();
	}
	public function salva($produto) {
		
		// $empresa = $this->session->userdata("idempresa");
		// $this->db->set('idempresa', $empresa);
		$this->db->insert ( "tb_questao", $produto );
	}
	public function salva_item($item) {
		$this->db->insert ( "tb_item", $item );
	}
	public function atualiza_item($item, $id_item) {
		$this->db->where ( "tb_item.id_item", $id_item );
		$this->db->update ( "tb_item", $item );
	}
	public function atualizar_questao($id_empresa, $id_produto, $dados_produto) {
		// print_r($dados_produto);
		/*
		 * echo "Empresa".$id_empresa; echo "Produto".$id_produto; die();
		 */
		$this->db->where ( "tb_questao.ID_QUESTAO", $id_produto );
		$this->db->update ( "tb_questao", $dados_produto );
	}
	public function busca($id) {
		return $this->db->get_where ( "produto", array (
				"id" => $id 
		) )->row_array ();
		// O RESULT_ARRAY TRAZ TODOS, O ROW_ARRAY TRAZ SOMENTE O PRIMEIRO
		// OUTRA FORMA DE FAZER O WHERE
	}
	public function buscaVendidos($usuario, $idempresa, $tipo) {
		if ($tipo == 1) {
			$tipoVendas = array (
					1,
					2 
			);
			$this->db->select ( "produto.*, vendas.idcliente,  vendacliente.situacaovenda, vendacliente.dtvenda, pessoa.nome as nomecliente,vendacliente.idvendacliente,  sum(produto.preco) as totalvenda, sum((produto.preco * vendas.totalproduto)) as totalVenda, vendacliente.id as id,
		vendacliente.porcentagemadicional, vendacliente.formapagamento, usuario.nome as nome_usuario" );
			$this->db->from ( "produto" );
			$this->db->join ( "vendas", "vendas.idproduto = produto.id" );
			$this->db->join ( "vendacliente", "vendacliente.id = vendas.idvenda_cliente_site" );
			$this->db->join ( "pessoa", "pessoa.idpessoa = vendacliente.idcliente" );
			$this->db->join ( "usuario", "vendacliente.idusuario = usuario.id" );
			$this->db->where ( "produto.idempresa", $idempresa );
			$this->db->where ( "pessoa.idempresa", $idempresa );
			$this->db->where ( "vendacliente.idempresa", $idempresa );
			$this->db->where ( "vendas.situacao", 1 );
			$this->db->where_in ( 'vendacliente.situacaovenda', $tipoVendas );
			
			$this->db->group_by ( "vendacliente.id" );
			$this->db->order_by ( "vendacliente.dtvenda", "desc" );
			
			$this->db->order_by ( "vendacliente.situacaovenda" );
		} else {
			
			$this->db->select ( "produto.*, vendas.idcliente,  vendacliente.situacaovenda, vendacliente.dtvenda, pessoa.nome as nomecliente,vendacliente.idvendacliente,  sum(produto.preco) as totalvenda, sum((produto.preco * vendas.totalproduto)) as totalVenda, vendacliente.id as id,
			vendacliente.porcentagemadicional, vendacliente.formapagamento, usuario.nome as nome_usuario" );
			$this->db->from ( "produto" );
			$this->db->join ( "vendas", "vendas.idproduto = produto.id" );
			$this->db->join ( "vendacliente", "vendacliente.id = vendas.idvenda_cliente_site" );
			$this->db->join ( "pessoa", "pessoa.idpessoa = vendacliente.idcliente" );
			$this->db->join ( "usuario", "vendacliente.idusuario = usuario.id" );
			
			$this->db->where ( "produto.idempresa", $idempresa );
			$this->db->where ( "pessoa.idempresa", $idempresa );
			$this->db->where ( "vendacliente.idempresa", $idempresa );
			
			$this->db->group_by ( "vendacliente.id" );
			$this->db->order_by ( "vendacliente.dtvenda" );
			$this->db->order_by ( "vendacliente.situacaovenda" );
		}
		// $id = $usuario["id"];
		
		// print_r($this->db->select());
		// $this->db->where("vendido", true);
		// $this->db->where("idusuario", $id);
		
		return $this->db->get ()->result_array ();
	}
	public function detalheVenda($idvendacliente) {
		$idempresa = $this->session->userdata ( "idempresa" );
		// $id = $usuario["id"];
		$this->db->select ( "produto.*, vendas.idcliente, vendas.totalproduto as totalProduto, vendacliente.situacaovenda, vendacliente.dtvenda, pessoa.nome as nomecliente, vendacliente.idvendacliente, (produto.preco * vendas.totalproduto) as totalProdutoVenda, pessoa.nome as nome, vendacliente.id as idvendaclientesite" );
		$this->db->from ( "produto" );
		$this->db->join ( "vendas", "vendas.idproduto = produto.id" );
		$this->db->join ( "vendacliente", "vendacliente.id = vendas.idvenda_cliente_site" );
		$this->db->join ( "pessoa", "pessoa.idpessoa = vendacliente.idcliente" );
		$this->db->where ( "vendacliente.id", $idvendacliente );
		$this->db->where ( "pessoa.idempresa", $idempresa );
		$this->db->where ( "vendacliente.idempresa", $idempresa );
		$this->db->where ( "produto.idempresa", $idempresa );
		$this->db->where ( "vendas.situacao", 1 );
		// $this->db->where("idusuario", $id);
		return $this->db->get ()->result_array ();
	}
	public function buscaProximoIdProdutoEmpresa($empresa) {
		$this->db->select ( "max(produto.id)+1 as id" );
		$this->db->from ( "produto" );
		$this->db->where ( "produto.idempresa", $empresa );
		return $this->db->get ()->row_array ( 0 );
	}
	public function busca_categoria($id_questao = 0) {
		// $id_produto - s� deve vir preenchido para buscar alguma categoria espec�fica. atualmente, s�
		// � utilizado no formul�rio de ed��o
		$idempresa = $this->session->userdata ( "idempresa" );
		
		$this->db->select ( "a.id_assunto as id_assunto, concat(m.nome_materia, ' - ' ,a.descricao_assunto) as assunto", false );
		$this->db->from ( "tb_assunto a" );
		$this->db->join ( "tb_materia m", "m.id_materia = a.id_materia" );
		$this->db->where ( "a.ID_DONO", $this->session->userdata ( "idempresa" ) );
		$this->db->order_by("m.nome_materia, a.descricao_assunto");
		return $this->db->get ()->result_array ();
	}
	public function busca_assunto_materia($id_questao = 0) {
		// $id_produto - s� deve vir preenchido para buscar alguma categoria espec�fica. atualmente, s�
		// � utilizado no formul�rio de ed��o
		$this->db->select ( "am.id_assunto as id" );
		$this->db->from ( "tb_questao q" );
		$this->db->join ( "tb_assunto_questao am", "am.id_questao = q.id_questao" );
		$this->db->where ( "q.id_questao", $id_questao );
		$questao = $this->db->get ()->row_array ( 0 );
		
		if ($questao != null) {
			
			return $questao ['id'];
		} else {
			return 0;
		}
	}
	public function salvaCategoria($categoria) {
		$this->db->insert ( "categoria_produto", $categoria );
	}
	public function atualizar_categoria($categoria, $id_empresa, $id_categoria) {
		$this->db->where ( "categoria_produto.idempresa", $id_empresa );
		$this->db->where ( "categoria_produto.idcategoriaproduto", $id_categoria );
		$this->db->update ( "categoria_produto", $categoria );
	}
	public function traz_dados_edicao($id_questao) {
		// mysql_query('SET CHARACTER SET iso88591');
		// mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		$this->db->select ( "tb_questao.*" );
		$this->db->from ( "tb_questao" );
		$this->db->where ( "tb_questao.id_questao", $id_questao );
		
		return $this->db->get ()->row_array ();
	}
	public function insereImagemQuestao($dados, $id_questao) {
		$this->db->where ( "tb_questao.id_questao", $id_questao );
		$this->db->update ( "tb_questao", $dados );
	}
	public function insereImagemItem($dados, $id_item) {
		$this->db->where ( "tb_item.id_item", $id_item );
		$this->db->update ( "tb_item", $dados );
	}
	public function buscaUltimaQuestaoInserida() {
		$this->db->select ( "max(q.id_questao) as id_questao" );
		$this->db->from ( "tb_questao q" );
		return $this->db->get ()->row_array ( 0 );
	}
	public function salva_assunto_questao($dados) {
		$this->db->insert ( "tb_assunto_questao", $dados );
	}
	public function deleta_assuntos_anteriores($id_questao) {
		$this->db->where ( "tb_assunto_questao.ID_QUESTAO", $id_questao );
		$this->db->delete ( "tb_assunto_questao" );
	}
	public function traz_dados_item($id_item) {
		$this->db->select ( "tb_item.*" );
		$this->db->from ( "tb_item" );
		$this->db->where ( "tb_item.id_item", $id_item );
		return $this->db->get ()->row_array ();
	}
	public function buscaQuestoesPorLista($idLista) {
		$this->db->select ( "tb_questao.*, tb_materia.nome_materia, tb_assunto.descricao_assunto" );
		$this->db->from ( "tb_questao" );
		$this->db->join ( "tb_assunto_questao aq", "aq.id_questao = tb_questao.id_questao", "left" );
		$this->db->join ( "tb_assunto", "tb_assunto.id_assunto = aq.id_assunto", "left" );
		$this->db->join ( "tb_materia", "tb_materia.id_materia = tb_assunto.id_materia", "left" );
		$this->db->join ( "questao_lista ql", "ql.idQuestao = tb_questao.id_questao" );
		$this->db->join ( "lista_questoes lq", "lq.idListaQuestoes = ql.idListaQuestao" );
		$this->db->where ( "lq.idListaQuestoes", $idLista );
		return $this->db->get ()->result_array ();
	}
	public function buscaQuestoesPorListaJSON($idLista) {
		$this->db->select ( "tb_questao.*, tb_materia.nome_materia, tb_assunto.descricao_assunto" );
		$this->db->from ( "tb_questao" );
		$this->db->join ( "tb_assunto_questao aq", "aq.id_questao = tb_questao.id_questao", "left" );
		$this->db->join ( "tb_assunto", "tb_assunto.id_assunto = aq.id_assunto", "left" );
		$this->db->join ( "tb_materia", "tb_materia.id_materia = tb_assunto.id_materia", "left" );
		$this->db->join ( "questao_lista ql", "ql.idQuestao = tb_questao.id_questao" );
		$this->db->join ( "lista_questoes lq", "lq.idListaQuestoes = ql.idListaQuestao" );
		$this->db->where ( "lq.idListaQuestoes", $idLista );
		// return $this->db->get()->result_array();
		
		return json_encode ( $this->db->get ()->result_array (), JSON_UNESCAPED_UNICODE );
	}
	
	public function desativarQuestao($idQuestao) {
		
		$dados = array("SITUACAO" => 0);
		
		$this->db->where("tb_questao.ID_QUESTAO", $idQuestao);
		$this->db->update("tb_questao", $dados);
		
	}
	
	public function desativarItem($idQuestao) {
		
		$dados = array("SITUACAO" => 0);
		
		$this->db->where("tb_item.ID_QUESTAO", $idQuestao);
		$this->db->update("tb_item", $dados);
		
	}
	
	
	
	public function desativarItemEspecifico($idItem) {
		
		$dados = array("SITUACAO" => 0);
	
		$this->db->where("tb_item.ID_ITEM", $idItem);
		$this->db->update("tb_item", $dados);
	
	}
	
	
	public function deletarQuestaoDaLista ($idLista, $idQuestao) {
		
		$this->db->where("questao_lista.IDLISTAQUESTAO", $idLista);
		$this->db->where("questao_lista.IDQUESTAO", $idQuestao);
		$this->db->delete("questao_lista");
		
	}
	
}