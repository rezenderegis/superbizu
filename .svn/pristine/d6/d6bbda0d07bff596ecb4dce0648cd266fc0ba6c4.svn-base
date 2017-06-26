<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Grupos de Alunos</span>
	</h1>
</div>
<?php
echo form_open ( "grupos_alunos/salvarNovoGrupo", array (
		'id' => 'questoes' 
) );
?>



<div class="panel-heading">
	<span class="panel-title">Incluir Novo Grupo de Alunos</span>
</div>

<div class="panel-body">
	<div class="row form-group">
		<label class="col-sm-4 control-label">Nome do Grupo</label>
		<div class="col-sm-4">
			<input type="text" name="nome_grupo" class="form-control">
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
		<div class="table-caption">Grupos Cadastrados</div>
	</div>

	<table class="table table-striped bordered">
		<thead>
			<tr>
				<th><b>Nome do Grupo</b></th>
				<th>Incluir Aluno no Grupo</th>
			</tr>
		</thead>
		<tbody>
	<?php
	
	if ($this->session->userdata ( "usuario_logado" )) :
		foreach ( $grupos as $grupo ) :
			
			?>
	<tr>

				<td><?=$grupo["nomeGrupo"] ?></td>

				<td>
				<?=anchor("grupos_alunos/incluir_aluno_grupo/{$grupo['idGrupo']}",  '<img src="'.base_url().'imagens/ic_add_box.png" alt="Delete" />')?>
		
		</td>
			</tr>
<?php endforeach ?>






<?php endif?>
</tbody>
	</table>
</div>
