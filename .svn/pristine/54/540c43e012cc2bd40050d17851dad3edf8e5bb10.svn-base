<?php include("application/views/usuarios/constantes.php");?>
<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Dados da Conta</span>
	</h1>
</div>

</div>


<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>

<?php
$nome = '';
$telefone = '';
$sincronizacaoEntradaAplicativo = '';
$idempresa = 0;
$cnpj = '';
$tipo_formulario = 'novo_cadastro';
$nome_foto_sistema = '';
$idempresa = '';
if ($dados_empresa_editar != 0) {
	foreach ( $dados_empresa_editar as $dados ) :
		// print_r($dados_empresa_editar);
		$nome = $dados ['nome_empresa'];
		$telefone = $dados ['telefone'];
		$sincronizacaoEntradaAplicativo = $dados ['sincronizacaoEntradaAplicativo'];
		$cnpj = $dados ['cnpj'];
		$tipo_formulario = 'edicao';
		$idempresa = $dados ['idempresa'];
		$nome_foto_sistema = $dados ['nome_foto_sistema'];
		$idempresa = $dados ['idempresa'];
		
	endforeach
	;
}



echo form_open ( "empresa/novaEmpresa", array (
		'id' => 'novaEmpresa',
		'class' => 'form-horizontal',
		'role' => 'form' 
) );

?>

<div class="panel-heading">
	<span class="panel-title">Conta</span>
</div>

<div class="panel-body">

<div class="col-sm-4">
											
										</div> <!-- / .message -->
		 
		 

	  <div class="row form-group"
		 	<label class="col-sm-4 control-label"></label>
		 			<?php $atts = array (
							'width' => '500',
							'height' => '250',
							'scrollbars' => 'yes',
							'status' => 'yes',
							'resizable' => 'yes',
							'screenx' => '0',
							'screeny' => '0' 
					);
		 			
		 			if ($nome_foto_sistema) {
		 				$imagem = "uploads/imagens_contas/".$nome_foto_sistema;
		 			} else { $imagem = "imagens/ic_no_image.png"; }
		 			
		 			?>
					
					<div class="col-sm-4">
							
	
						<?=anchor_popup("empresa/inserirFoto/{$idempresa}", '<img src="'.base_url($imagem).'" alt="Delete" class="img-rounded"  width="141" height="118" align="center" >', $atts)?></li>
		 			</div>
		 </div>


	<div class="row form-group">
		<label class="col-sm-4 control-label">
			Nome da Conta
		</label>
		<div class="col-sm-4">
		<input type="text" name="nomeempresa" class="form-control" value = "<?=$nome?>">
		</div>
	</div>

	
	<div class="row form-group">
		<label class="col-sm-4 control-label">
			Telefone
		</label>
		
		<div class="col-sm-4">
			<input type="text" name="telefone" class="form-control" value="<?=$telefone?>">
		</div>
	</div>
	
	<div class="row form-group">
		<label class="col-sm-4 control-label">
			CNPJ
		</label>
		
		<div class="col-sm-4">
			<input type="text" name="cnpj" class="form-control" value="<?=$cnpj?>">
		</div>
	</div>
</div>
<div class="panel-footer text-center">
<?php 



echo form_hidden ( array (
		"idempresa" => $idempresa,
		"tipo_formulario" => $tipo_formulario 
) );
echo form_button ( array (
		
		"class" => "btn btn-primary",
		"content" => "Alterar",
		"type" => "submit" 
) );

echo form_close ();

?>
</div>
