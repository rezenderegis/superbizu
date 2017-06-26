<div class="page-header">
	<h1><span class="text-ligth-gray">Usuários</span></h1>
</div>

<div class="button-with-margins">
<?=anchor('usuarios/formularioUsuarioNoSite/', 'Cadastrar Novo Usuario', array("class" => "btn btn-primary"))?>
</div>
<br/>
<div class="table-primary">
	<div class="table-header">
		<div class="table-caption">
			Usuários Cadastrados
		</div>
	</div>


<table class="table table-striped bordered">
<thead><tr><th><b>Nome</b></th><th><b>E-mail</b></th><th><b>Perfil</b></th><th><b>Editar</b></th></tr></thead>
<tbody>
<?php 
  $CI =& get_instance();
    ?>
	<?php foreach ($usuarios as $usuario) : ?>
				<?php $proprietario = "";
				if ($usuario["usuario_master"] == "S") {$proprietario = " <b>(Criador da Conta)</b>";}?>
				<tr>
				<td><?=$usuario["nome"].$proprietario?> </td>
				<td>
				<?= $usuario["email"]?>	
				</td>
				<td>
				<?=$CI->trazPerfilUsuario($usuario["id"])?>
				</td>
			<td>
				<?=anchor("usuarios/formularioUsuarioNoSite/{$usuario['id']}", 'Editar');?>
			</td>
			</tr>
					<?php endforeach ?>
				</tbody>	
			</table>
</div>

