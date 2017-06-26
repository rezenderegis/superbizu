<table class="table table-condensed">
<tr class="active"><td align="center"><b>Clientes</b></td></tr>
</table>
		<table class="table table-condensed">
		<tr class="active"><td><b>Nome</b></td><td><b>Endereço</b></td><td><b>Telefone</b></td><td><b>Site</b></td><td>Editar</td></tr>
			<?php foreach ($pessoas as $pessoa) : ?>

				<tr>
				<td><?=$pessoa["nome"]?> </td>
				<td>
				<?= $pessoa["endereco"]?>	
				</td>
				<td>
				<?= $pessoa["telefone"]?>	
				</td>
				<td>
				<?= $pessoa["site"]?>	
				</td>
				<td>
					<?=anchor("pessoas/formularioClientes/{$pessoa['idempresa']}/{$pessoa['idpessoa']}", 'Editar')?>
				</td>
			</tr>
					<?php endforeach ?>
					
			</table>

<?=anchor('pessoas/formularioClientes', 'Cadastrar Clientes', array("class" => "btn btn-primary"))?>

