<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Questões da Lista</span>
	</h1>
</div>

<div class="button-with-margins">
	<?=anchor('lista/inserirQuestoesListaExistente/'.$idLista, 'Adicionar Questões', array("class" => "btn btn-primary"))?>
</div>
<br/>

<div class="table-primary">

	<table id="questoes" class="table table-striped bordered">
		<thead>
			<tr>
				<th><b>ID</b></th>
				<th><b>Matéria</b></th>
				<th><b>Assunto</b></th>
				<th><b>Questão</b></th>
				<th><b>Itens</b></th>
				<th>Ver Img</th>
			</tr>
		</thead>
		<tbody>
	<?php
	$atts = array (
			'width' => '500',
			'height' => '250',
			'scrollbars' => 'yes',
			'status' => 'yes',
			'resizable' => 'yes',
			'screenx' => '0',
			'screeny' => '0' 
	);
	
	if ($this->session->userdata ( "usuario_logado" )) :
		foreach ( $questoes as $questao ) :
			
			?>
	<tr>

				<td><?=$questao["ID_QUESTAO"] ?></td>
				<td><?=$questao["nome_materia"] ?></td>
				<td><?=$questao["descricao_assunto"] ?></td>



				<td>
		<?=word_limiter($questao["DESCRICAO_QUESTAO"], 20)?>
		<?//=anchor("questoes/mostra/{$produto['id']}", $produto["nomeproduto"]) //NÃO PRECISEI CHAMAR O CONTROLER NO EXEMPLO ACIMA POR CONTA DO ROUTER QUE FOI CONFIGURADO NO ROUTES.PHP?>
		</td>




				<td> 
		<?=anchor("questoes/listaItens/{$questao['ID_QUESTAO']}",  '<img src="'.base_url().'imagens/ic_add_box.png" alt="Delete" />')?>
		<?=anchor("questoes/deletarQuestaoDaLista/{$idLista}/{$questao['ID_QUESTAO']}",  '<img src="'.base_url().'imagens/delete.png" alt="Delete" />')?>
		
		</td>

				<td>
					<?php
			
			if (! empty ( $questao ['NOME_IMAGEM_QUESTAO_SISTEMA'] )) {
				?>
			<?=anchor(base_url("uploads/{$questao['NOME_IMAGEM_QUESTAO_SISTEMA']}"),  '<img src="'.base_url().'imagens/ic_zoom_in.png" alt="Delete" />');?>
						
			<?php } else {echo "";}?>
					
			
		</td>
			</tr>
<?php endforeach ?>
</tbody>
	</table>


</div>


<?php endif?>


