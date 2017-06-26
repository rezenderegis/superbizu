<?php include("application/views/usuarios/constantes.php");?>

<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>

<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Professores</span>
	</h1>
</div>

<?php

echo form_open ( "usuarios/adicionarUsuario", array (
		'id' => 'novousuario'
) );

?>

<div class="panel-heading">
	<span class="panel-title">Novo Professor</span>
</div>

<div class="panel-body">

	<div class="row form-group">
		<label class="col-sm-4 control-label">Nome</label>
		<div class="col-sm-4">
			<input type="text" name="nome" class="form-control">
		</div>
	</div>

	<div class="row form-group">
		<lable class="col-sm-4 control-label">E-mail</lable>
		<div class="col-sm-4">
			<input type="text" name="email" class="form-control">
		</div>
	</div>

</div>


<div class="panel-footer text-center">
	<?php
	echo form_hidden(array("tipoUsuarioInserir" => 2));
	echo form_button ( array (
			"class" => "btn btn-primary",
			"content" => "Adicionar",
			"type" => "submit" 
	)
	 );
	echo "  ";
	echo form_button ( array (
			"class" => "btn btn-primary",
			"content" => "Buscar",
			"type" => "submit" 
	)
	 );
	?>
</div>
</form>

<br />
<div class="table-primary">
	<div class="table-header">
		<div class="table-caption">Professores Cadastrados</div>
	</div>


	<table class="table table-striped bordered">
		<thead>
			<tr>
				<th><b>Nome</b></th>
				<th><b>E-mail</b></th>
				<th><b>Situação</b></th>
		
			</tr>
		</thead>
		<tbody>
			<?php foreach ($usuarios as $usuario) : ?>
				<?php
				
if ($usuario ["loginapp"] == 'S') {
					$loginapp = 'Sim';
				} else {
					$loginapp = 'Não';
				}
				if ($usuario ["loginsistema"] == 'S') {
					$loginsistema = 'Sim';
				} else {
					$loginsistema = 'Não';
				}
				?>
				<tr>
				<td><?=$usuario["nome"]?> </td>
				<td>
				<?= $usuario["email"]?>	
				</td>
				<td>
				<?= $loginapp?>	
				</td>

			
			</tr>
					<?php endforeach ?>
				</tbody>
	</table>
</div>