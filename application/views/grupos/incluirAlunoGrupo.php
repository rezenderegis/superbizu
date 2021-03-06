<div class="page-header">
	<h1><span class="text-ligth-gray">Alunos do Grupo</span></h1>
</div>

<?php
echo form_open ( "grupos_alunos/salvarAlunoGrupo", array (
		'id' => 'inclusaoAlunoGrupo'
) );

?>

<div class="panel-heading">
	<span class="panel-title">
		Inclusao de Aluno no Grupo
	</span>
</div>

<div class="panel-body">


<div class="row form-group">
<label class="col-sm-4 control-label">Aluno</label>
	<div class="col-sm-4">
		<select id="aluno_grupo" name="aluno_grupo" class="form-control input-lg">
		<option value=""></option>
		<?php 
	
		if (count ( $alunosPorEmpresa )) {
		
			foreach ( $alunosPorEmpresa as $key => $list ) {
				// echo $categoria.$list['idcategoriaproduto'];
		
				echo "<option value='" . $list ['id'] . "'>" . $list ['nome'] . "</option>";
			}
		}
		
		?>
		</select>
	</div>
</div>

<?php

/*
echo "<div class='form-group'>";
echo form_label ( "Aluno:", "aluno_grupo" );
echo "<div class='col-sm-10'>";
echo "<select name='aluno_grupo' id='aluno_grupo' class='form-control'>";
// echo "<select name='state_id' id='state_id'>";

echo "<option></option>";
if (count ( $alunosPorEmpresa )) {
	
	foreach ( $alunosPorEmpresa as $key => $list ) {
		// echo $categoria.$list['idcategoriaproduto'];
		
		echo "<option value='" . $list ['id'] . "'>" . $list ['nome'] . "</option>";
	}
}
echo "</select>";
echo "</div>";
echo "</div>";
*/
echo form_hidden ( array (
		"idGrupoDoFormulario" => $idGrupo 
) );

?>
<div class="panel-footer text-center">
<?php
echo form_button ( array (
		"class" => "btn btn-primary",
		"content" => "Cadastrar",
		"type" => "submit" 
) );

echo form_close ();

?>
</div>
</div>
<br/>
<div class="table-primary">
	<div class="table-header">
		<div class="table-caption">
			Alunos Grupos
		</div>
	</div>


<table class="table table-striped bordered">
	<thead>
	
		<tr>
			<th><b>Nome</b></th>
			<th>E-mail</th>
			<th>Ação</th>
			</th>
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
	);
	
	if ($this->session->userdata ( "usuario_logado" )) :
		foreach ( $alunosDoGrupo as $aluno ) :
			
			?>
	<tr>

		<td><?=$aluno["nome"] ?></td>
		<td><?=$aluno["email"] ?></td>
		<?php if ($aluno["situacaoAlunoGrupo"] == 1) {?>
		<td><?=anchor("grupos_alunos/desativarAlunoGrupo/{$aluno['idalunogrupo']}/{$idGrupo}",  '<img src="'.base_url().'imagens/active-icon.png" alt="Delete" />') ?></td>
		<?php } else { ?>
				<td><?=anchor("grupos_alunos/ativarAlunoGrupo/{$aluno['idalunogrupo']}/{$idGrupo}",  '<img src="'.base_url().'imagens/delete.png" alt="Delete" />') ?></td>
		
		<?php }?>
	</tr>
<?php endforeach ?>

</tbody>
</table>


</div>



<?php endif?>


