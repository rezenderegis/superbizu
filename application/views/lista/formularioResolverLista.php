<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Lista de Exercícios - <b> <?=$descricaoLista?> </b></span>
	</h1>
</div>


<br/>
<div class="panel">
<div class="panel-body">
	<?php
	echo form_open("lista/gravarResolucaoLista", array (
			'id' => 'novaLista'
	) );
	$CI =& get_instance();
		
	if ($this->session->userdata ( "usuario_logado" )) :
		foreach ( $questoes as $questao ) :
			
			?>
		
	
		
		
		<div class="panel colourable">
				
					<div class="panel-body">
						<?="<b>Questao:</b> ".$questao["ID_QUESTAO"]." <b> Matéria: </b> ".$questao["nome_materia"]."<b>  Assunto: </b> ".$questao["descricao_assunto"] ?>
					</div>
				</div>
	<h5><?=$questao["DESCRICAO_QUESTAO"] ?></h5>
	<BR/>
	
	<?php 
	
		$imagem = "uploads/".$questao['NOME_IMAGEM_QUESTAO_SISTEMA'];
		if ($questao['NOME_IMAGEM_QUESTAO_SISTEMA'] != 1) {
		?>
		<img src='<?=base_url($imagem)?>' alt="Delete" class="img-rounded"  width="283" height="236" align="center" >
		 <?php } ?>			
	
		<!-- 
		anchor("questoes/listaItens/{$questao['ID_QUESTAO']}",  '<img src="'.base_url().'imagens/ic_add_box.png" alt="Delete" />')?>
		anchor("questoes/deletarQuestaoDaLista/{$idLista}/{$questao['ID_QUESTAO']}",  '<img src="'.base_url().'imagens/delete.png" alt="Delete" />')?>
		 -->
		 <BR/>
		 <BR/>
		 	<h5><?=$questao["COMANDO_QUESTAO"] ?></h5>
		 	<BR/>
		 	<div class="radio" style="margin-top: 0;">
		 	
							<?php
							$itens = $CI->trazItensQuestao($questao['ID_QUESTAO']);
				foreach ($itens as $item) {
						$checked = "";
						$edicao = "";
						$falso = "SIM";
						if ( strcmp($tipoTela, "VISUALIZACAO") == 0) {
								$edicao = "onclick='return false'";
								foreach ($dadosResolucao as $dados) {
								
									if ( strcmp($questao['LETRA_ITEM_CORRETO'], $item['LETRA_ITEM']) == 0) {
										$falso = "NAO";
									}			
									
									if ($dados['ID_ITEM'] == $item['ID_ITEM']) {
										$checked = "checked";
									}
									
									
								}
							
							
						}
						
						$preencher = $item['LETRA_ITEM']." )".$item['DESCRICAO'];
					if ( strcmp($falso, "SIM") == 0 && $checked) { 
						
							$preencher = "<s>".$preencher."</s>";
						}
						if ( strcmp($falso, "NAO") == 0) {
						
							$preencher = "<font color='blue'>".$preencher."</font>";
						}
					?>
					<label>
					<input type="radio" name="resposta[<?=$questao['ID_QUESTAO']?>]" id="optionsRadios1" value="<?=$item['ID_ITEM']?>" <?=$checked?> class="px" <?=$edicao ?>>
					<span class="lbl"><?=$preencher?></span>
					</label>
					
					
				<?php 
				}
				?>				
				</div>
						

<?php endforeach ?>





<?php endif;

if ( strcmp($tipoTela, "VISUALIZACAO") != 0) {

?>

<div class="button-with-margins">
<?php 
echo form_hidden(array("idListaQuestoes" => $idLista));

echo form_button(array(
		"class" => "btn btn-primary",
		"content" => "Concluir",
		"type" => "submit"
));
?>
</div>
<?php } ?>


</div>
</div>

