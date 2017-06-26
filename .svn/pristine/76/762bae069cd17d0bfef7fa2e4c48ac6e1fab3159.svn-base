
<div class="page-header">
	<!-- Inicio div header -->
	<h1>
		<span class="text-ligth-gray">Alteração de Assunto </span>
	</h1>
</div>


<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>



<?php

// $id = $assunto_informado['ID_ITEM'];
$id = $id_assunto;
echo form_open ( "assuntos/novo", array (
		'id' => 'assunto',
		'class' => 'form-horizontal',
		'role' => 'form' 
) );

?>
<div class="panel-heading">
	<span class="panel-title">Assunto</span>
</div>

<div class="panel-body">

	<div class="row form-group">
		<label class="col-sm-4 control-label">Descrição</label>
		<div class="col-sm-4">
			<input type="text" name="descricao" class="form-control"
				value="<?=set_value("descricao", $assunto_informado['DESCRICAO_ASSUNTO']) ?>">
		</div>
	</div>

	<div class="row form-group">
		<label class="col-sm-4 control-label">Matéria</label>

		<div class="col-sm-4">
			<select id="materia" name="materia" class="form-control input-lg">
				<option></option>
			<?php
			
			$sel = '';
			if (count ( $materias )) {
				
				foreach ( $materias as $key => $list ) {
					// echo $categoria.$list['idcategoriaproduto'];
					if ($list ['ID_MATERIA'] != $assunto_informado ['ID_MATERIA']) {
						
						echo "<option value='" . $list ['ID_MATERIA'] . "'>" . $list ['NOME_MATERIA'] . "</option>";
					}
					// echo "<option value='".$list['idcategoriaproduto'].">".$list['nomecategoriaproduto']."</option>";
					if ($list ['ID_MATERIA'] == $assunto_informado ['ID_MATERIA']) {
						echo "<option value='" . $list ['ID_MATERIA'] . "' selected>" . $list ['NOME_MATERIA'] . "</option>";
					}
				}
			}
			
			?>
			
			</select>
		</div>
	</div>


	<div class="row form-group">
		<label class="col-sm-4 control-label"> Assunto Pai </label>

		<div class="col-sm-4">
			<select id="assunto_pai" name="assunto_pai"
				class="form-control input-lg">
				<option></option>
			<?php
			
			$sel = '';
			if (count ( $assuntos )) {
				foreach ( $assuntos as $key => $list ) {
					// echo $categoria.$list['idcategoriaproduto'];
					if ($list ['ID_ASSUNTO'] != $assunto_informado ['ID_ASSUNTO']) {
						
						echo "<option value='" . $list ['ID_ASSUNTO'] . "'>" . $list ['DESCRICAO_ASSUNTO'] . "</option>";
					}
					// echo "<option value='".$list['idcategoriaproduto'].">".$list['nomecategoriaproduto']."</option>";
					if ($list ['ID_ASSUNTO'] == $assunto_informado ['ID_ASSUNTO_PAI']) {
						echo "<option value='" . $list ['ID_ASSUNTO'] . "' selected>" . $list ['DESCRICAO_ASSUNTO'] . "</option>";
					}
				}
			}
			
			?>
			</select>
		</div>
	</div>

</div>
<div class="panel-footer text-center">
<?php

echo form_hidden ( array (
		"id_assunto_alterar" => $id
) );


echo form_button ( array (
		"class" => "btn btn-primary",
		"content" => "Cadastrar",
		"type" => "submit" 
) );

echo form_close ();

?>

</div>

