


<table class="table table-condensed">
<tr class="active"><td align="center"><b>Cadastro Nova Questão</b></td></tr>
</table>


<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>



<?php 
$attributes = array (
		'class' => 'col-sm-2 control-label',
		'style' => 'color: #000;'
);
	
	

echo form_open("grupos_alunos/salvarNovoGrupo", array (
			'id' => 'questoes',
			'class' => 'form-horizontal',
			'role' => 'form'
	) );

echo "<div class='form-group'>";
echo form_label("Nome do Grupo", "nome_grupo", $attributes);
echo "<div class='col-sm-2'>";
echo form_input(array("name" => "nome_grupo",
		"class" => "form-control",
		"id" => "nome_grupo",
		"maxlength" => "255",
		"type" => "text",
		"value" => set_value("nome_grupo", "aqui")));
echo "</div>";
echo "</div>";



echo form_button(array(
"class" => "btn btn-primary",
"content" => "Cadastrar",
"type" => "submit"
));

echo form_close();


?>
	
	

