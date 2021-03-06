<?php include("application/views/usuarios/constantes.php");?>
<div class="page-header">
	<h1><span class="text-ligth-gray">Usuário</span></h1>
</div>

<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>

<?=form_open("usuarios/salvarNovoUsuarioNoSite", array('id' => 'novousuario'))?>

<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">Edição dos Dados</span>
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
		 			
		 			if ($usuario_edicao['nome_foto_sistema']) {
		 				$imagem = "uploads/".$usuario_edicao['nome_foto_sistema'];
		 			} else { $imagem = "imagens/ic_no_image.png"; }
		 			
		 			?>
					
					<div class="col-sm-4">
							
	
						<?=anchor_popup("usuarios/inserirFoto/{$usuario_edicao['id']}", '<img src="'.base_url($imagem).'" alt="Delete" class="img-rounded"  width="141" height="118" align="center" >', $atts)?></li>
		 			</div>
		 </div>
		 
		 
		 <div class="row form-group">
		 	<label class="col-sm-4 control-label">Nome</label>
		 	<div class="col-sm-4">
		 		<input type="text" name="nome" id="nome" class="form-control" value="<?=set_value("nome", $usuario_edicao['nome']) ?>">
		 	</div>
		 </div>
		 
		 <div class="row form-group">
		 	<label class="col-sm-4 control-label" >E-mail</label>
		 	<div class="col-sm-4">
		 		<input type="text" name="email" id="email" class="form-control" value = "<?=set_value("email", $usuario_edicao['email'])?>">
		 	</div>
		 </div>
		 
		 <div class="row form-group">
		 	<label class="col-sm-4 control-label">Senha</label>
		 	<div class="col-sm-4">
		 		<input type="password" name="senha" id="email" class="form-control" value = "<?=set_value("senha", $usuario_edicao['senha']) ?>">
		 	</div>
		 </div>
		 <?php 
		 $professor = '';
		 $aluno = '';
		 if ($perfisUusario) {
				 foreach ($perfisUusario as $perfil) {
				 		 if ($perfil['idperfil'] == 2) {$professor = 'selected'; }
				 		 if ($perfil['idperfil'] == 3) {$aluno = 'selected'; }
				 		 
				 }
}?>
		 <div class="row form-group">
		 	<label class="col-sm-4 control-label">Perfil</label>
		 	<div class="col-sm-4">
		 			<select multiple class="form-control" id="perfil[]" name="perfil[]">
										<option value="2" <?=$professor ?>>Professor</option>
										<option value="3" <?=$aluno ?>>Aluno</option>
									</select>
		
		 	</div>
		 </div>
		 
		
		 
		 <?php 

	
		echo form_hidden(array("id_usuario" => $usuario_edicao['id'], "tipo_acesso" => $tipo_acesso));
	?>
	<div class="panel-footer text-center">
	<?php 
		echo form_button(array(
		"class" => "btn btn-primary",
		"content" => "Cadastrar",
		"type" => "submit"
		
		));
		echo form_close();
		?>
		</div>
	</div> <!-- Fim panel body -->
</div> <!-- Fim panel -->