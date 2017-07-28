<?php
class Lista_model extends CI_Model {
	public function trazListasPorUsuarioEescla($idUsuario, $empresa) {
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		
		$idEmpresa = $this->session->userdata ( 'idempresa' );
		
		$this->db->select ( "lista_questoes.*" );
		$this->db->from ( "lista_questoes" );
		if ($idUsuario == true) {
			$this->db->where ( "lista_questoes.idResponsavel", $idUsuarioLogado );
		}
		if ($empresa == true) {
			$this->db->where ( "lista_questoes.idempresa", $idEmpresa );
		}
		return $this->db->get ()->result_array ();
	}
	public function trazListaPorGrupo($idUsuario, $empresa) {
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		
		$idEmpresa = $this->session->userdata ( 'idempresa' );
		
		$this->db->select ( "lq.*, g.nomeGrupo,g.idgrupo" );
		$this->db->from ( "lista_questoes lq" );
		$this->db->join ( "tb_lista_grupo lg", "lq.idlistaquestoes = lg.idLista " );
		$this->db->join ( "tb_grupo g", "g.idGrupo = lg.idGrupo" );
		if ($idUsuario == true) {
			$this->db->where ( "lq.idResponsavel", $idUsuarioLogado );
		}
		if ($empresa == true) {
			$this->db->where ( "lq.idempresa", $idEmpresa );
		}
		$this->db->where("lg.situacaoAcesso", 1);
		return $this->db->get ()->result_array ();
	}
	
	public function trazListasPorAluno($idUsuario, $empresa) {
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		
		$idEmpresa = $this->session->userdata ( 'idempresa' );
		$sql = "SELECT lq.*, professor.nome nome_professor, 
case  when (select max(idresolucao) from TB_RESOLUCAO where id_usuario = " . $idUsuarioLogado . " and id_lista = lq.idlistaquestoes) is null then 'Não Resolvida' else 'Resolvida' end as SITUACAO_LISTA
 FROM (usuario u) JOIN tb_aluno_grupo ag ON ag.idUsuario = u.id 
 JOIN tb_grupo g ON g.idGrupo = ag.idGrupo JOIN tb_lista_grupo lg ON lg.idGrupo = g.idGrupo
 JOIN lista_questoes lq ON lq.idlistaquestoes = lg.idLista 
 JOIN usuario professor ON professor.id = lq.idresponsavel 
 WHERE
	lg.situacaoAcesso = 1 
	and u.id = " . $idUsuarioLogado . "";
		
		/*
		 * $this->db->select("lq.*, professor.nome nome_professor");
		 * $this->db->from("usuario u");
		 * $this->db->join("tb_aluno_grupo ag", "ag.idUsuario = u.id");
		 * $this->db->join("tb_grupo g", "g.idGrupo = ag.idGrupo");
		 * $this->db->join("tb_lista_grupo lg", "lg.idGrupo = g.idGrupo");
		 * $this->db->join("lista_questoes lq", "lq.idlistaquestoes = lg.idLista");
		 * $this->db->join("usuario professor", "professor.id = lq.idresponsavel");
		 * //$this->db->join("TB_RESOLUCAO r", "r.id_lista = lq.idlistaquestoes", "left");
		 * $this->db->where("u.id", $idUsuarioLogado);
		 */
		$query = $this->db->query ( $sql );
		
		return $query->result_array ();
	}
	public function salvaLista($descricao) {
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		
		$idEmpresa = $this->session->userdata ( 'idempresa' );
		
		$dados = array (
				"descricao" => $descricao,
				"idEmpresa" => $idEmpresa,
				"idResponsavel" => $idUsuarioLogado 
		);
		
		$this->db->insert ( "lista_questoes", $dados );
	}
	public function buscaUltimaListaQuestaoInserida() {
		$this->db->select ( "max(l.idListaQuestoes) as idListaQuestoes" );
		$this->db->from ( "lista_questoes l" );
		return $this->db->get ()->row_array ( 0 );
	}
	public function salvaQuestaoLista($idUltimaListaInserida, $idQuestaoLista) {
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		
		$idEmpresa = $this->session->userdata ( 'idempresa' );
		
		$qtdIdQuestaoNaLista = count ( $idQuestaoLista );
		
		for($i = 0; $i < $qtdIdQuestaoNaLista; $i ++) {
			
			$dados = array (
					"idListaQuestao" => $idUltimaListaInserida,
					
					"idQuestao" => $idQuestaoLista [$i] 
			);
			
			$this->db->insert ( "questao_lista", $dados );
		}
	}
	public function trazDadosLista($idLista) {
		$this->db->select ( "lista_questoes.*" );
		$this->db->from ( "lista_questoes" );
		$this->db->where ( "lista_questoes.idlistaquestoes", $idLista );
		return $this->db->get ()->row_array ();
	}
	public function atualizarLista($dados, $idLista) {
		$this->db->where ( "lista_questoes.idlistaquestoes", $idLista );
		$this->db->update ( "lista_questoes", $dados );
	}
	public function salvarResolucao($idLista, $respostas) {
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		$this->load->model ( "uuid_model" );
		$grupo_resolucao = $this->uuid_model->v4 ();
		foreach ( $this->input->post ( "resposta" ) as $questao => $itemMarcado ) {
			$dados = array (
					"ID_QUESTAO" => $questao,
					"ID_ITEM" => $itemMarcado,
					"ID_LISTA" => $idLista,
					"ID_USUARIO" => $idUsuarioLogado,
					"ID_GRUPO_QUESTAO" => $grupo_resolucao 
			);
			$this->db->insert ( "TB_RESOLUCAO", $dados );
		}
	}
	public function verificarAlunoResolveuLista($idLista, $idGrupo) {
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );
		
		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		
		$sql = "SELECT 
    u.nome,u.id, lg.idListaGrupo,lg.idgrupo, lg.idLista, (select MAX(idResolucao) from TB_RESOLUCAO where ID_USUARIO = u.id 
        AND ID_LISTA = ".$idLista." and lg.idgrupo = " . $idGrupo . " ) AS RES

FROM
    (tb_grupo)
        JOIN
    tb_lista_grupo lg ON lg.idgrupo = tb_grupo.idgrupo
    inner join tb_aluno_grupo ag on ag.idgrupo = tb_grupo.idgrupo
    inner join usuario u on u.id = ag.idusuario
WHERE 
    lg.idlista = " . $idLista . "
        AND lg.situacaoAcesso = 1
        and ag.idgrupo = " . $idGrupo . "";
		
		$query = $this->db->query ( $sql );
		
		return $query->result_array ();
	}
	
	public function verificarAlunoResolveuListaParaGrafico($idLista, $idGrupo) {
		$dadosUsuarioLogado = $this->session->userdata ( "usuario_logado" );

		$idUsuarioLogado = $dadosUsuarioLogado ['id'];
		
		$sql = "SELECT
    u.nome name,u.id, lg.idListaGrupo,lg.idgrupo, lg.idLista, (select MAX(idResolucao) from TB_RESOLUCAO where ID_USUARIO = u.id
        AND ID_LISTA = ".$idLista." and lg.idgrupo = " . $idGrupo . " ) AS RES
        		
FROM
    (tb_grupo)
        JOIN
    tb_lista_grupo lg ON lg.idgrupo = tb_grupo.idgrupo
    inner join tb_aluno_grupo ag on ag.idgrupo = tb_grupo.idgrupo
    inner join usuario u on u.id = ag.idusuario
WHERE
    lg.idlista = " . $idLista . "
        AND lg.situacaoAcesso = 1
        and ag.idgrupo = " . $idGrupo . "";
	//	echo $sql;die();
		$query = $this->db->query ( $sql );
		
		return $query->result_array ();
	}
	
	public function retornaSituacaoRespostas ($idGrupoQuestao="", $idLista="") {
		
		$param = "";
		
		if ($idGrupoQuestao != "" && $idLista != "") {
			$param = " R.ID_GRUPO_QUESTAO = '".$idGrupoQuestao."' AND R.ID_LISTA = '".$idLista."'";
			
			
		} else if ($idGrupoQuestao != "") {
			$param = " R.ID_GRUPO_QUESTAO = '".$idGrupoQuestao."'";
			
		}
	
		$sql = "SELECT case when Q.LETRA_ITEM_CORRETO = i.LETRA_ITEM then 'V' ELSE 'F' END as resposta
		FROM TB_RESOLUCAO R 
		INNER JOIN tb_questao Q ON Q.ID_QUESTAO = R.ID_QUESTAO
    	INNER JOIN tb_item i on i.id_item = R.id_item
    	where ".$param;


    	$query = $this->db->query($sql);
		return $query->result_array();
     
	}
	
	public function calcularTotalVerdadeiras ($lista_questao) {
		$verdadeiro = 0;
		foreach ($lista_questao as $lista) {
			if ($lista['resposta'] == 'V') {
				$verdadeiro = $verdadeiro + 1;
			}
			
		}
		
		return $verdadeiro;
	}
	
	public function verificarQuantidadeQuestoesLista($idlistaquestoes) {
		
		$sql = "select count(*) total from lista_questoes lq inner join questao_lista ql on ql.idlistaquestao = lq.idlistaquestoes
 		where lq.idlistaquestoes = '".$idlistaquestoes."'";
		$query = $this->db->query($sql);
		$quantidade = $query->row_array();
		return $quantidade['total'];
	}
	
	public function calculaPercentualVerdadeiras ($idGrupoQuestao,$idlistaquestoes) {
		
		
		$lista_questao = $this->lista_model->retornaSituacaoRespostas($idGrupoQuestao, $idlistaquestoes);
	
		$totalVerdadeiras = $this->lista_model->calcularTotalVerdadeiras($lista_questao);
		$totalQuestoesLista = $this->lista_model->verificarQuantidadeQuestoesLista($idlistaquestoes);
		
		$percentual = $totalVerdadeiras * 100 / $totalQuestoesLista;
		
		$percentual = number_format($percentual, 2);
		
		return $percentual;
		
	}
	
	public function trazGrupoResolucaoDeIdResolucao ($id) {
		
		$this->db->select("ID_GRUPO_QUESTAO");
		$this->db->from("TB_RESOLUCAO");
		$this->db->where("idResolucao",$id);
		
		 
		$id_grupo = $this->db->get ()->row_array ();
		
		return $id_grupo['ID_GRUPO_QUESTAO'];
	}
	
	public function trazerDadosGrupoLista ($idLista,$idGrupo) {
		
		$this->db->select("g.nomeGrupo, lg.idgrupo, lg.idLista,l.descricao");
		$this->db->from("tb_grupo g");
		$this->db->join("tb_lista_grupo lg", "lg.idgrupo = g.idgrupo");
		$this->db->join("lista_questoes l", "l.IDLISTAQUESTOES = lg.idlista");
		$this->db->where("lg.idlista", $idLista);
		$this->db->where("g.idgrupo", $idGrupo);
		
		return $this->db->get()->row_array();
		
	}
	
	public function trazerInformacoesListas ($idListaQuestao,$idGrupo, $idQuestao) {
		header("Content-Type: text/html; charset=UTF-8",true);
		
		mysql_set_charset('utf8');
		
		$sql = "SELECT concat(i.letra_item, ' - ', i.descricao) name,COUNT(R.ID_ITEM) y FROM TB_RESOLUCAO R
		 INNER JOIN tb_lista_grupo lg ON lg.idLista = R.ID_LISTA
		INNER JOIN tb_item i on i.ID_ITEM = R.ID_ITEM

		WHERE R.ID_QUESTAO = '".$idQuestao."' AND R.ID_LISTA = '".$idListaQuestao."'  AND lg.idGrupo = '".$idGrupo."'
		GROUP BY R.ID_ITEM,R.ID_QUESTAO-- ,lg.idGrupo = 44";
		
		$query = $this->db->query($sql);
		
		$dados1 =  $query->result_array();
		
		$dados = json_encode($dados1, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		
		return $dados;
		
		/*foreach ($dados as $dado) {
			echo print_r($dado);
			die();
		}*/
		
	}
	
	public function trazQuestoesPorLista($idListaQuestao,$idGrupo) {
		
		$this->db->select("Q.DESCRICAO_QUESTAO,Q.ID_QUESTAO,ql.IDLISTAQUESTAO,lg.idGrupo,Q.NUMERO_QUESTAO");
		$this->db->from("tb_questao Q");
		$this->db->join("questao_lista ql","ql.IDQUESTAO = Q.ID_QUESTAO");
		$this->db->join("tb_lista_grupo lg", "lg.idLista = ql.idlistaquestao" );
		
		$this->db->where("ql.idlistaquestao", $idListaQuestao);
		$this->db->where("lg.idGrupo", $idGrupo);
		
		return $this->db->get()->result_array();
		
		
	}
	
	
	public function contaPercentualAcertos ($idGrupo, $idLista) {
		// Teste: '0b768ffd-b21c-4622-9f2c-2f842dea219d', 1
		
		if ($idGrupo) {
			$dado = $this->lista_model->trazGrupoResolucaoDeIdResolucao($idGrupo);
			
			return $this->lista_model->calculaPercentualVerdadeiras($dado, $idLista);
		} else {
			return "";
		}
	}
	
	
	public function calculaPercentualAcertoLista($idLista,$idGrupo,$tipoRetorno="RETORNAR_ARRAY") {
		autoriza ();
		
		$lista_questao = $this->verificarAlunoResolveuListaParaGrafico( $idLista,$idGrupo);
		$dadosGrupoLista = $this->trazerDadosGrupoLista( $idLista,$idGrupo);
		
		$listaComPercentual = [];
		
		foreach ( $lista_questao as $lista ) {
			
			$percentualAcertos = $this->contaPercentualAcertos($lista['RES'],$lista['idLista']);
			//print($percentualAcertos); die();
			if ($percentualAcertos == "") {
				$percentualAcertos = 0;
			}
			$lista["y"] = $percentualAcertos;
			unset($lista["idListaGrupo"]);
			unset($lista["idgrupo"]);
			unset($lista["idLista"]);
			unset($lista["RES"]);
			unset($lista["id"]);
			
			array_push($listaComPercentual, $lista);
			
		} 
		if ($tipoRetorno == "RETORNAR_ARRAY") {
			return $listaComPercentual;
		} else if ($tipoRetorno == "RETORNAR_JSON") {
		
			return json_encode($listaComPercentual, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
			
		}
		
	}
	
	
	public function retornaTotalAcertosErrosPorQuestao($idLista,$idGrupo) {
	
	
		$sql = "SELECT concat (Q.ID_QUESTAO, ' - ', SUBSTRING(Q.descricao_questao, 1, 60)) as name, count(*) as y, case when Q.LETRA_ITEM_CORRETO = i.LETRA_ITEM then 'V' ELSE 'F' END as resposta
FROM TB_RESOLUCAO R 
	INNER JOIN tb_questao Q ON Q.ID_QUESTAO = R.ID_QUESTAO
    INNER JOIN tb_item i on i.id_item = R.id_item
    INNER JOIN questao_lista ql on ql.IDQUESTAO = Q.ID_QUESTAO
    INNER JOIN lista_questoes lq ON lq.IDLISTAQUESTOES = ql.IDLISTAQUESTAO
	INNER JOIN tb_lista_grupo lg ON lg.idLista = R.ID_LISTA
    where lq.IDLISTAQUESTOES = '".$idLista."' and lg.idGrupo = '".$idGrupo."' 
    and (Q.LETRA_ITEM_CORRETO = i.LETRA_ITEM)
    group by resposta,Q.ID_QUESTAO
    order by Q.ID_QUESTAO
    ";
		
		/*
		$sql = "SELECT count(*) total, case when Q.LETRA_ITEM_CORRETO = i.LETRA_ITEM then 'V' ELSE 'F' END as resposta, q.id_questao
FROM TB_RESOLUCAO R 
	INNER JOIN tb_questao Q ON Q.ID_QUESTAO = R.ID_QUESTAO
    INNER JOIN tb_item i on i.id_item = R.id_item
    INNER JOIN questao_lista ql on ql.IDQUESTAO = Q.ID_QUESTAO
    INNER JOIN lista_questoes lq ON lq.IDLISTAQUESTOES = ql.IDLISTAQUESTAO
	INNER JOIN tb_lista_grupo lg ON lg.idLista = R.ID_LISTA
    where lq.IDLISTAQUESTOES = '".$idLista."' and lg.idGrupo = '".$idGrupo."'
    group by resposta,q.id_questao 
    order by q.id_questao
    ";*/
	
	$query = $this->db->query($sql);
	return $query->result_array();
		
	}
	
	
	
	
}
	
	
	
	
	
	
	
