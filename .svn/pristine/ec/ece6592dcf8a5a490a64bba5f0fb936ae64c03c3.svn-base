
<table class="table table-condensed">
<tr class="active"><td align="center"><b>Cadastro de Cliente</b></td></tr>
</table>

<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>

<?php 




echo form_open("pessoas/novoCliente", array('id' => 'cadastro_cliente'));
echo form_label("Nome", "nome");
echo form_input(array("name" => "nome",
"class" => "form-control", 
"id" => "nome",
"maxlength" => "255",
"value" => set_value('nome', $dados_pessoa_edicao['nome'])));
//echo form_error("nome");

echo form_label("Telefone", "telefone");
echo form_input(array("name" => "telefone",
"class" => "form-control", 
"id" => "telefone",
"maxlength" => "10","value" => set_value("telefone", $dados_pessoa_edicao['telefone'])
));
//echo form_error("preco");
echo form_label("Email", "email");
echo form_input(array(
"name" => "email",
"class" => "form-control",
"id" => "email",
"value" => set_value("email", $dados_pessoa_edicao['email'])
));
//echo form_error("descricao");

echo form_label("Site", "site");
echo form_input(array(
"name" => "site",
"class" => "form-control",
"id" => "site",
"value" => set_value("site", $dados_pessoa_edicao['site'])
));

echo form_label("Endereco", "endereco");
echo form_input(array(
"name" => "endereco",
"class" => "form-control",
"id" => "endereco",
"value" => set_value("endereco", $dados_pessoa_edicao['endereco'])
));


echo form_hidden(array("id_pessoa" => $dados_pessoa_edicao['idpessoa'], "id_empresa" => $dados_pessoa_edicao['idempresa']));
echo form_button(array(
"class" => "btn btn-primary",
"content" => "Cadastrar",
"type" => "submit"
));

echo form_close();
?>