<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Itens da Questão</span>
	</h1>
</div>

<div class="button-with-margins">
	<?=anchor('questoes/formulario_item/'.$id_questao, 'Incluir Item', array("class" => "btn btn-primary"))?>
</div>
<br/>
<div class="table-primary">
	
	<table class="table table-striped bordered">
<thead><tr><td><b>Letra</b></td><td><b>Descricao</b></td><td><b>Ações</b></td><td><b>Nova Img</b></td><td><b>Ver Img</b></td></tr></thead>
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
	foreach ($itens as $itens) : 
	
	?>
	<tr>
	<td>
		<?=$itens["LETRA_ITEM"]?>
		<?//=anchor("produtos/mostra/{$produto['id']}", $produto["nomeproduto"]) //NÃO PRECISEI CHAMAR O CONTROLER NO EXEMPLO ACIMA POR CONTA DO ROUTER QUE FOI CONFIGURADO NO ROUTES.PHP?>
		</td>
		<td>
		<?=$itens["DESCRICAO"]?>
		<?//=anchor("produtos/mostra/{$produto['id']}", $produto["nomeproduto"]) //NÃO PRECISEI CHAMAR O CONTROLER NO EXEMPLO ACIMA POR CONTA DO ROUTER QUE FOI CONFIGURADO NO ROUTES.PHP?>
		</td>
		<td>
		<?=anchor("questoes/formulario_item/{$id_questao}/{$itens["ID_ITEM"]}", '<img src="'.base_url().'imagens/ic_editar.png" alt="Delete" />')?>
		<?=anchor("questoes/desativarItemEspecifico/{$id_questao}/{$itens["ID_ITEM"]}", '<img src="'.base_url().'imagens/delete.png" alt="Delete" />')?>
		
		<?//=anchor("produtos/mostra/{$produto['id']}", $produto["nomeproduto"]) //NÃO PRECISEI CHAMAR O CONTROLER NO EXEMPLO ACIMA POR CONTA DO ROUTER QUE FOI CONFIGURADO NO ROUTES.PHP?>
		</td>
		
		<td>
			<?=anchor_popup("arquivo/novaImagemItem/{$itens['ID_ITEM']}", '<img src="'.base_url().'imagens/ic_insert_photo.png" alt="Delete" />', $atts)?>	
			
		</td>
		<td>
					<?php

					if (!empty($itens['NOME_IMAGEM_ITEM_SISTEMA'])) {?>
										<?=anchor(base_url("uploads/{$itens['NOME_IMAGEM_ITEM_SISTEMA']}"), '<img src="'.base_url().'imagens/ic_zoom_in.png" alt="Delete" />');?>
						
			<?php } else {echo "";}?>
					
			
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>
	

</div>





<?php endif?>
