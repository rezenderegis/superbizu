
<table class="table table-condensed">
<tr class="active"><td align="center"><b>Cadastro de Nova Categoria</b></td></tr>
</table>
<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>

<?php 
	
	$id_categoria_produto = $dados_categoria_edicao['idcategoriaproduto'];
	$grupo_produto = $dados_categoria_edicao['codigogrupoproduto'];
	

$attributes = array(
		'class' => 'col-sm-2 control-label',
		'style' => 'color: #000;',
);

echo form_open("produtos/novaCategoria");

echo form_label("Nome da Categoria", "nome_categoria");
echo form_input(array("name" => "nome_categoria",
"class" => "form-control", 
"id" => "nome_categoria",
"maxlength" => "255",
"value" => set_value("nome_categoria", $dados_categoria_edicao['nomecategoriaproduto'])));

echo "<br/>";

echo  "<div class='form-group'>";

$comida = '';
$bebida = '';

if ($dados_categoria_edicao != 0) {
	if ($grupo_produto == 1) {$comida = ' selected ';} else if ($grupo_produto == 2) {$bebida = ' selected ';}
	
	
}

echo form_label("Grupo da Categoria", "grupoproduto", $attributes);
echo "<div class='col-sm-10'>";
echo "<select class='form-control' id='grupoproduto' name='grupoproduto'>";
echo "<option value='0'>Selecione</option>";
echo "<option value='1' ".$comida.">Comida</option>";
echo "<option value='2' ".$bebida.">Bebida</option>";
echo "</select>";
echo "</div>";
echo "</div>";

echo form_hidden(array("id_categoria_produto" => $id_categoria_produto));
echo form_button(array(
"class" => "btn btn-primary",
"content" => "Cadastrar",
"type" => "submit"
));

echo form_close();
?>
