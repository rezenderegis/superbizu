<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Matérias</span>
	</h1>
</div>
<?php
echo form_open ( "materias/salvar", array (
		'id' => 'materias' 
) );
?>



<div class="panel-heading">
	<span class="panel-title">Cadastrar Matérias</span>
</div>

<div class="panel-body">
	<div class="row form-group">
		<label class="col-sm-4 control-label">Nome da Matéria</label>
		<div class="col-sm-4">
			<input type="text" name="nome" class="form-control">
			
		</div>
	</div>


</div>


<div class="panel-footer text-center">
	<?php
	
	echo form_button ( array (
			"class" => "btn btn-primary",
			"content" => "Adicionar",
			"type" => "submit" 
	)
	 );
	
	?>
</div>
</form>


<br />

<div class="table-primary">
	<div class="table-header">
		<div class="table-caption">Matérias Cadastradas</div>
	</div>

	<table class="table table-striped bordered">
		<thead>
			<tr>
				<th><b>Nome</b></th>
				<th></th>

			</tr>
		</thead>
		<tbody>
	<?php
	
	if ($this->session->userdata ( "usuario_logado" )) :
		foreach ( $materias as $materia ) :
			
			?>
	<tr>

				<td><?=$materia["NOME_MATERIA"] ?></td>
				<td>
				<?=anchor ( "materias/editar/{$materia['ID_MATERIA']}", '<img src="' . base_url () . 'imagens/ic_editar.png" /> ' )?>

				</td>
			</tr>
<?php endforeach ?>






<?php endif?>
</tbody>
	</table>
</div>
