<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Matérias</span>
	</h1>
</div>
<?php
echo form_open ( "materias/alterar", array (
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
			<input type="text" name="nome" class="form-control" value="<?=$nomeMateria?>">
			
		</div>
		
		<input type="hidden" name="id_materia" value="<?=$idMateria?>">
	</div>


</div>


<div class="panel-footer text-center">
	<?php
	
	echo form_button ( array (
			"class" => "btn btn-primary",
			"content" => "Alterar",
			"type" => "submit" 
	)
	 );
	
	?>
</div>
</form>


<br />

</div>
