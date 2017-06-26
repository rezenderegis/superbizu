<?php include("application/views/usuarios/constantes.php");?>

<table class="table table-condensed">
<tr class="active"><td align="center"><b>Novo Aluno</b></td></tr>
</table>
<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>

<?php 

$attributes = array (
		'class' => 'col-sm-2 control-label',
		'style' => 'color: #000;'
);


//usuarios ? o controler e novo ? a fun??o
echo form_open("usuarios/adicionarUsuario", array('id' => 'novousuario'));


echo "<div class='form-group'>";
echo form_label ( "Nome (*)", "nome", $attributes );
echo "<div class='col-sm-10'>";
echo form_input(array(
"name" => "nome",
"id" => "name",
//ID faz o link do label com o input text
"class" => "form-control",
"maxlength" => "255",
		"value" => set_value("nome", $usuario_edicao['nome'])
));
echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
echo form_label ( "Email (*)", "email", $attributes );
echo "<div class='col-sm-10'>";
echo form_input(array(
"name" => "email",
"id" =>"email",
"class" => "form-control",
"maxlength" => "255",
		"value" => set_value("email", $usuario_edicao['email'])
));
echo "</div>";
echo "</div>";



echo form_hidden(array("id_usuario" => $usuario_edicao['id'], "tipo_acesso" => $tipo_acesso));
/*N�o � necess�rio colocar uma */
echo form_button(array(
"class" => "btn btn-primary",
"content" => "Cadastrar",
"type" => "submit"

));
echo form_close();
?>