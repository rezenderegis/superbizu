
<table class="table table-condensed">
<tr class="active"><td align="center"><b>Categorias</b></td></tr>
</table>
<?=anchor('produtos/formularioCategoria', 'Cadastrar Nova Categoria', array("class" => "btn btn-primary"))?>
<br/><br/>
<table class="table table-condensed">
<tr class="active"><td><b>Nome</b></td><td><b>Editar</b></td></tr>

	<?php 
	
	if($this->session->userdata("usuario_logado")) :
	foreach ($categoria as $categoria) : 
	?>
	<tr>
		<td><?=$categoria["nomecategoriaproduto"] ?></td>	
		<td><?=anchor("produtos/formularioCategoria/{$categoria['idcategoriaproduto']}", 'Editar')?></td>
	</tr>
<?php endforeach ?>
</table>





<?php endif?>
