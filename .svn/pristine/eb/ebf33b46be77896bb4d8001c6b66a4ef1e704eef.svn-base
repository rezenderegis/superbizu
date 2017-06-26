<?php include("application/views/usuarios/constantes.php");?>
<div class="page-header">
	<h1><span class="text-ligth-gray">Usuário</span></h1>
</div>

<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>

<?=form_open("lista/salvarDadosAtualizacaoLista", array('id' => 'novousuario'))?>


		<div class="panel-heading">
			<span class="panel-title">Edição dos Dados</span>
		</div>
		 <div class="panel-body">
		 
		 <div class="row form-group">
		 	
		 	<label class="col-sm-4 control-label">Descicao Lista</label>
		 	<div class="col-sm-4">
		 		<input type="text" name="descricao" id="descricao" class="form-control" value="<?=set_value("nome", $dadosLista['DESCRICAO']) ?>">
		 	</div>
		
		</div> 
		
	
		</div>
		
		<div class="panel-footer text-center">
		
			<?php 
				echo form_hidden(array("idLista" => $dadosLista['IDLISTAQUESTOES']));
			
				echo form_button(array (
		
		"class" => "btn btn-primary",
		"content" => "Alterar",
		"type" => "submit" 
) );
			?>
		
		</div>
	
