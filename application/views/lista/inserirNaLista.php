
<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Nova Lista de Questões</span>
	</h1>
</div>
<br />
<div class="panel-heading">
	<span class="panel-title"> Detalhes da Lista </span>
</div>
<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>
	

<?php

echo form_open ( "lista/alterarLista/" . $idLista, array (
		'id' => 'novaLista' 
) );
?>


<div class="panel-footer text-center">
<?php

echo form_button ( array (
		"class" => "btn btn-primary",
		"content" => "Gravar Lista",
		"type" => "submit" 
) );

?>

</div>
<br />
<div class="table-primary">
	<div class="table-header">
		<div class="table-caption">Questões Disponíveis para Inclusão na Lista
		</div>
	</div>


	<table class="table table-striped bordered">

		<thead>
			<tr>
				<th><b></b></th>
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
			)
			;
			
			if ($this->session->userdata ( "usuario_logado" )) :
				foreach ( $questoes as $questao ) :
					
					?>
			<tr>
				<td>
			<input type="checkbox"  id="inlineCheckbox1" name = "idQuestaoLista[]" value="<?=$questao ["ID_QUESTAO"] ?>" class="ibl"/> <span class="lbl"></span>
			
			
			</td>
				<td><?=$questao["ID_QUESTAO"] ?></td>
				<td><?=$questao["nome_materia"] ?></td>
				<td><?=$questao["descricao_assunto"] ?></td>



				<td>
				<?=word_limiter($questao["DESCRICAO_QUESTAO"], 20)?>
				<?//=anchor("questoes/mostra/{$produto['id']}", $produto["nomeproduto"]) //NÃO PRECISEI CHAMAR O CONTROLER NO EXEMPLO ACIMA POR CONTA DO ROUTER QUE FOI CONFIGURADO NO ROUTES.PHP?>
				</td>




				<td> 
				<?=anchor("questoes/listaItens/{$questao['ID_QUESTAO']}",  '<img src="'.base_url().'imagens/ic_add_box.png" alt="Delete" />')?>
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
		
		
		
		
		
		<?php endif?>
		
		<?php
		
		echo form_close ();
		?>

</div>
