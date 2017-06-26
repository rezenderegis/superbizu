<style>



</style>
<?php 

$attributes = array(
		'class' => 'mycustomclass',
		'style' => 'color: #FFFFFF;'
);

$image_properties = array(
		'src' => 'imagens/2.jpg',
		'class' => 'post_images',
		'width' => '100%',
		'height' => '100%',
		'background-size' =>'100%',
		'background-repeat' => 'no-repeat',
		'moz-background-size' => '100% 100%',
		'webkit-background-size' => '100% 100%',
		'background-size' => '100% 100%',
		'rel' => 'lightbox'
);
?>
<div style="position:relative">

<?php 

echo img($image_properties);


?>
  <div style="position:absolute;left:5;top:100;  border:3px ;
    padding: 10px;">
<?php 
echo form_open("login/autenticar", array('id' => 'login'));

echo "</br>";
echo "</br>";

echo form_label("Email", "email", $attributes);
echo form_input(array(
"name" => "email",
"id" =>"email",
"size" => "20",
"style" => "width:90%",
"class" => "form-control",
"maxlength" => "255"
));

echo form_label("Senha", "senha", $attributes);
echo form_password(array(
"name" => "senha",
"id" => "senha",
"size" => "20",
"style" => "width:90%",
"class" => "form-control",
"maxlength" => "255"
));
echo "</br>";
echo form_button(array(
"class" => "btn btn-primary",
"content" => "Entrar",
"type" => "submit"

));
echo "&nbsp;&nbsp;";
echo anchor('usuarios/novoUsuario', 'Cadastrar', array("class" => "btn btn-primary")); 
echo form_close();

echo anchor('usuarios/formulario_esqueceu_senha', 'Esqueceu sua senha! Clique aqui', $attributes);

?>
 </div>
</div>
<!-- <H4> Transforme a gestão de vendas da sua empresa com o sistema BySale. Através da integração entre o aplicativo -->
<!-- e o sistema, você terá um controle criterioso de estoque, vendas e clientes.  -->
<!-- </H4> -->




