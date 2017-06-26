<div class="page-header">
	<h1><span class="text-ligth-gray">Inclusão de Novo Item da Questão</span></h1>
</div>



<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>



<?php 

$attributes = array (
		'class' => 'col-sm-2 control-label',
		'style' => 'color: #000;'
);

	$id = $dados_item_edicao['ID_ITEM'];
?>	
<div class="panel-heading">
	<span class="panel-title">Item</span>
</div>
<div class="panel-body">
<?php 
echo form_open("questoes/novo_item", array(
	
		'class' => 'form-horizontal',
		'role' => 'form'
));

$a = "";
$b = "";
$c = "";
$d = "";
$e = "";

if (strcmp($dados_item_edicao['LETRA_ITEM'], 'A') == 0) {
	$a = "selected";
} else if (strcmp($dados_item_edicao['LETRA_ITEM'], 'B') == 0) {
		$b = "selected";
} else if (strcmp($dados_item_edicao['LETRA_ITEM'], 'C') == 0) {	
	$c = "selected";
} else if (strcmp($dados_item_edicao['LETRA_ITEM'], 'D') == 0) {
	$d = "selected";
} else if (strcmp($dados_item_edicao['LETRA_ITEM'], 'E') == 0) {
	
	$e = "selected";
}
echo form_error('letra_item', "<p class='alert alert-danger'>", "</p>");
echo "<div class='form-group'>";
echo form_label ( "Letra Item", "letra_item", $attributes );
echo "<div class='col-sm-2'>";
echo "<select name='letra_item' id='letra_item' class='form-control'>";
echo "<option value=A ".$a.">A</option>";
echo "<option value=B ".$b.">B</option>";
echo "<option value=C ".$c.">C</option>";
echo "<option value=D ".$d.">D</option>";
echo "<option value=E ".$e.">E</option>";
echo "</select>";
echo "</div>";
echo "</div>";

/*
echo form_label("Letra do Item", "letra_item");
echo form_input(array("name" => "letra_item",
		"class" => "form-control",
		"id" => "letra_item",
		"maxlength" => "255",
		"value" => set_value("letra_item", $dados_item_edicao['LETRA_ITEM'])));
*/

echo "<div class='form-group'>";
echo form_label("Descrição", "descricao", $attributes);
echo "<div class='col-sm-10'>";
echo form_textarea(array("name" => "descricao",
		"class" => "form-control",
		"id" => "descricao",
		"maxlength" => "255",
		"value" => set_value("descricao", $dados_item_edicao['DESCRICAO'])));
echo "</div>";
echo "</div>";

?>
</div>
<div class="panel-footer text-center">
<?php 
echo form_hidden(array("id_produto_alterar" => $id, "id_questao" => $id_questao, "id_item" => $id_item));
echo form_button(array(
"class" => "btn btn-primary",
"content" => "Cadastrar",
"type" => "submit"
));

echo form_close();
?>
</div>