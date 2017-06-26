<link rel="stylesheet" href="<?=base_url("css/bootstrap.css")?>">
<link rel="stylesheet" href="<?=base_url("css/main.css")?>">
<link rel="stylesheet" href="<?=base_url("css/font-awesome.min.css")?>">
<table class="table table-condensed">
<tr class="active"><td align="center"><b>Documentos</b></td></tr>
</table>
<table class="table table-condensed">
<tr class="active"><td><b>Nome do Documento</b></td><td><b>Data Inclusão</b></td><td><b>Ver</b></td><td>	<?php if ($podeExcluirArquivo == true) {?><b>Excluir</b></td>		<?php }?></tr>
			<?php 
		
			//print_r($arquivos);
			foreach ($arquivos as $dado) : ?>

			
				<tr>
				
				<td><?=$dado["nome_documento"]?> </td>
				<td><?=dataParaPortugues($dado["dt_evidencia"])?></td>
				<td>
				<?=anchor(base_url("uploads/{$dado['nome_doc_sistema']}"), "<i id='deletar' class='fa fa fa-search-plus'></i>");?>
								
				</td>
				<td>
				<?php if ($podeExcluirArquivo == true) {?>
					<?=anchor("arquivo/deletarArquivo/{$dado['iddocumento_evidencia_acao']}", "<i id='deletar' class='fa fa fa-times'></i>")?>
				<?php }?>
				</td>
				
			</tr>
					<?php endforeach ?>
					
			</table>
			
			
			
			
			
			
			