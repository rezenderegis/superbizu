<link rel="stylesheet" href="<?=base_url("css/bootstrap.css")?>">

<table class="table table-condensed">
<tr class="active"><td align="center"><b>Inclusão de Imagem</b></td></tr>
</table>


<?php 
$texto_botao = 'Salvar';


?>
<table class="table table-condensed">
<tr class="active"><td align="left"><b>Selecione a Imagem</b></td></tr>
</table>




<?php 
$error="";
echo $error;?>
<?php echo form_open_multipart('upload/inserirFoto');

$dados = array("idUsuario" => $idUsuario);

echo form_hidden($dados);

?>

<input type="file" name="userfile" size="90" class="btn btn-primary"/>

<h6><b>Extensões nativas permitidas: gif, jpg, png</b></h6>
<input type="submit" value=<?=$texto_botao?>  class="btn btn-primary" />
<!-- onclick="window.close()" -->
</form>