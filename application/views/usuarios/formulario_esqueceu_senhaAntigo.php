
<?php 
echo form_open("usuarios/solicitar_alteracao_senha", array('id' => 'login'));

echo "</br>";
echo "</br>";

echo form_label("Email", "email");
echo form_input(array(
"name" => "email",
"id" =>"email",
"size" => "20",
"style" => "width:30%",
"class" => "form-control",
"maxlength" => "255"
));


echo "</br>";
echo form_button(array(
"class" => "btn btn-primary",
"content" => "Solicitar Senha",
"type" => "submit"

));

echo "&nbsp;&nbsp;";
echo form_close();
echo "<h5>Ser� enviado um link para seu e-mail, acesse para alterar sua senha!</h5>";

?>

<!-- <H4> Transforme a gest�o de vendas da sua empresa com o sistema BySale. Atrav�s da integra��o entre o aplicativo -->
<!-- e o sistema, voc� ter� um controle criterioso de estoque, vendas e clientes.  -->
<!-- </H4> -->




