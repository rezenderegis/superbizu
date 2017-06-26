<?php include("application/views/usuarios/constantes.php");?>

<table class="table table-condensed">
<tr class="active"><td align="center"><b>Cadastro de Usuário</b></td></tr>
</table>
<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>

<?php 

$attributes = array (
		'class' => 'col-sm-2 control-label',
		'style' => 'color: #000;'
);


//usuarios ? o controler e novo ? a fun??o
echo form_open("usuarios/novo", array('id' => 'novousuario'));


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

echo "<div class='form-group'>";
echo form_label ( "Senha (*)", "senha", $attributes );
echo "<div class='col-sm-10'>";
echo form_password(array(
"name" => "senha",
"id" => "senha",
"class" => "form-control",
"maxlength" => "255",
		"value" => set_value("senha", $usuario_edicao['senha'])
));
echo "</div>";
echo "</div>";


/*
 * Essas duas opções somente são mostradas se o usuário estiver cadastrando outros usuários. 
 * 
 * */
if ($this->session->userdata("usuario_logado") != '') {
	echo "<div class='form-group'>";
	echo form_label ( "Usuário poderá acessar o sistema", "acessar_sistema", $attributes );
	echo "<div class='col-sm-2'>";
	echo "<select name='acessar_sistema' id='acessar_sistema' class='form-control'>";
	echo "<option></option>";
	foreach ($combo_sim_nao as $key => $dados) {
		$selected = '';
		if (($usuario_edicao['loginsistema'] == $dados['codigo']) || ($this->input->post("acessar_sistema") == $dados['codigo'])) {
			$selected = ' selected';
		}
		echo "<option value=".$dados['codigo']." ".$selected.">".$dados['descricao']."</option>";
	
	}
	
	echo "</select>";
	echo "</div>";
	echo "</div>";
	
	
	
	
		echo "<div class='form-group'>";
		echo form_label ( "Acessar aplicativo", "acessar_aplicativo", $attributes );
		echo "<div class='col-sm-2'>";
		echo "<select name='acessar_aplicativo' id='acessar_aplicativo' class='form-control'>";
		echo "<option></option>";
		foreach ($combo_sim_nao as $key => $dados) {
			$selected = '';
			if (($usuario_edicao['loginapp'] == $dados['codigo']) || ($this->input->post("acessar_aplicativo") == $dados['codigo'])) {
				$selected = ' selected';
			}
			echo "<option value=".$dados['codigo']." ".$selected.">".$dados['descricao']."</option>";
	
		}
	
		echo "</select>";
		echo "</div>";
		echo "</div>";
	
	
}

echo form_hidden(array("id_usuario" => $usuario_edicao['id'], "tipo_acesso" => $tipo_acesso));
/*Não é necessário colocar uma */
echo form_button(array(
"class" => "btn btn-primary",
"content" => "Cadastrar",
"type" => "submit"

));
echo form_close();
?>