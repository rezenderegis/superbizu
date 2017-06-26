<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Questões Cadastradas</span>
	</h1>
</div>

<!-- panel-body -->
<div class="buttons-with-margins">
<?=anchor('questoes/formulario', 'Cadastrar Questão', array("class" => "btn btn-primary"))?>
</div>
<br/>
	<div class="panel">
					
					<div class="panel-body">
						<div class="table-primary">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
								<thead>
									<tr>
<th><b>ID</b></th><th><b>Matéria</b></th><th><b>Assunto</b></th><th><b>Ano</b></th><th><b>Número</b></th><th><b>Questão</b></th><th><b>Comando</b></th><th><b>Comentário</b></th><th><b>Ações</b></th><th><b>Itens</b></th><th>Nov Img</th><th>Ver Img</th>
</tr>
</thead>
<tbody>
	<?php 
	

	
	
	$atts = array(
			'width'      => '500',
			'height'     => '250',
			'scrollbars' => 'yes',
			'status'     => 'yes',
			'resizable'  => 'yes',
			'screenx'    => '0',
			'screeny'    => '0'
	
	            );
	
	if($this->session->userdata("usuario_logado")) :
	foreach ($questoes as $questao) : 
	
	?>
	
	<tr>
				<td><?=$questao["ID_QUESTAO"] ?></td>	
					<td><?=$questao["nome_materia"] ?></td>	
					<td><?=$questao["descricao_assunto"] ?></td>	
	
			<td><?=$questao["ANO_QUESTAO"] ?></td>	
				<td><?=$questao["NUMERO_QUESTAO"] ?></td>	
	
		<td>
		<?=word_limiter($questao["DESCRICAO_QUESTAO"], 20)?>
		<?//=anchor("questoes/mostra/{$produto['id']}", $produto["nomeproduto"]) //NÃO PRECISEI CHAMAR O CONTROLER NO EXEMPLO ACIMA POR CONTA DO ROUTER QUE FOI CONFIGURADO NO ROUTES.PHP?>
		</td>
		<td><?= $questao["COMANDO_QUESTAO"] ?></td>	
		<td><?= word_limiter($questao["COMENTARIO_QUESTAO"],20) ?></td>	

		
		<td>
		<?=anchor("questoes/formulario/{$questao['ID_QUESTAO']}",
		
		'<img src="'.base_url().'imagens/ic_editar.png" alt="Delete" />')?>
				
		</td>
		<td> 
		<?=anchor("questoes/listaItens/{$questao['ID_QUESTAO']}",  '<img src="'.base_url().'imagens/ic_add_box.png" alt="Delete" />')?>
		</td>
		<td>
			<?=anchor_popup("arquivo/novaEvidencia/{$questao['ID_QUESTAO']}", '<img src="'.base_url().'imagens/ic_insert_photo.png" alt="Delete" />', $atts)?>	
			
			
			
		</td>
		<td>
					<?php

					if (!empty($questao['NOME_IMAGEM_QUESTAO_SISTEMA'])) {?>
										<?=anchor(base_url("uploads/{$questao['NOME_IMAGEM_QUESTAO_SISTEMA']}"),  '<img src="'.base_url().'imagens/ic_zoom_in.png" alt="Delete" />');?>
						
			<?php } else {echo "";}?>
					
			
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>

</div>
</div>
</div>
<?php endif?>
