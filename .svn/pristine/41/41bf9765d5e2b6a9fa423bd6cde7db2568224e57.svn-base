<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>
<script src="<?php echo base_url('js/jquery-ui-1.9.2.custom.js');?>" type="text/javascript"></script> 

<script>

$('#ui-bootbox-confirm').on('click', function () {
	bootbox.confirm({
		message: "Are you sure?",
		callback: function(result) {
			alert("Confirm result: " + result);
		},
		className: "bootbox-sm"
	});
});



function deleteArticle(article_id){
	//event.preventDefault();
		var self = $(this);
		var r=confirm("As questões vinculadas a esse assunto serão desvinculadas. Realmente deseja excluir?");
        if(r==true){
   $.ajax({
 type: "get",
 url: "<?=base_url(); ?>index.php/assuntos/excluir/"+article_id,

});
   location.reload();
        }

   
	self.closest("tr").hide();
};
</script>



<div class="page-header">
	<!-- Inicio div header -->
	<h1>
		<span class="text-ligth-gray"> Assuntos de Questões </span>
	</h1>
</div>
<!-- Fim div header -->

<?php
echo form_open ( "assuntos/novoAssuntoFromIndex", array (
		'id' => 'assunto',
		'class' => 'form-horizontal',
		'role' => 'form' 
) );
?>

<div class="panel-heading">
	<span class="panel-title">Novo Assunto</span>
</div>

<div class="panel-body">


	<!-- Matéria -->
	<div class="row form-group">
		<label class="col-sm-4 control-label">Disciplina</label>

			<div class="col-sm-4">
				<select id="materia" name="materia" class="form-control input-lg">
						<option value=""></option>		
									<?php
									
									$sel = '';
									if (count ( $materias )) {
										
										foreach ( $materias as $key => $list ) {
											
											echo "<option value='" . $list ['ID_MATERIA'] . "'>" . $list ['NOME_MATERIA'] . "</option>";
										}
									}
									
									?>

								</select>
			</div>

	

	</div>
	<!-- Fim Matéria -->

	<!-- Assuntos -->
	<div class="row form-group">
		<label class="col-sm-4 control-label">Macro Conteúdo</label>

			<div class="col-sm-4">
				<select id="assunto_pai" name="assunto_pai" class="form-control input-lg">
				<option value=""></option>				
									<?php
									
									$sel = '';
									if (count ( $assuntos )) {
										foreach ( $assuntosParaFormulario as $key => $list ) {
												
												echo "<option value='" . $list ['ID_ASSUNTO'] . "'>" . $list ['DESCRICAO_ASSUNTO'] . "</option>";
											
										}
									}
									
									?>

								</select>
			</div>

	</div>
	<!-- Fim Assuntos -->
	<div class="row form-group">
		<label class="col-sm-4 control-label">Micro Conteúdo</label>
		<div class="col-sm-4">
			<input type="text" name="descricao" class="form-control">
		</div>
	</div>
</div>

<div class="panel-footer text-center">
	<?php 
	
	echo form_button(array(
			"class" => "btn btn-primary",
			"content" => "Adicionar",
			"type" => "submit"
	
	));

	?>
</div>

</form>

<?php echo "<br/>"; ?>

<div class="panel">

	<div class="panel-heading">
		<!-- Inicio div panel title -->
		<span class="panel-title"> Assuntos Cadastrados </span>
	</div>
	<!-- Fim div panel title -->

	<div class="panel-body">

		<div class="table-primary">
			<table cellpadding="0" cellspacing="0" border="0"
				class="table table-striped table-bordered" id="tb-assuntos">
				<thead>
					<tr>

						<th><b>ID</b></th>
						<th><b>DISCIPLINA</b></th>
						<th><b>Macro Conteúdo</b></th>
						<th><b>Micro Conteúdo</b></th>
						<th><b>EDITAR</b></th>
					</tr>
				</thead>
				<tbody>
	<?php
	
	$atts = array (
			'width' => '500',
			'height' => '250',
			'scrollbars' => 'yes',
			'status' => 'yes',
			'resizable' => 'yes',
			'screenx' => '0',
			'screeny' => '0' 
	);
	
	if ($this->session->userdata ( "usuario_logado" )) :
		foreach ( $assuntos as $assunto ) :
			
			?>
	<tr>
						<td><?=$assunto["ID_ASSUNTO"] ?></td>
										<td>
		<?=$assunto["nome_materia"]?>
		<?//=anchor("questoes/mostra/{$produto['id']}", $produto["nomeproduto"]) //NÃO PRECISEI CHAMAR O CONTROLER NO EXEMPLO ACIMA POR CONTA DO ROUTER QUE FOI CONFIGURADO NO ROUTES.PHP?>
		</td>
								<td><?= $assunto["descricao_assunto_pai"] ?></td>
		
						<td><?=$assunto["DESCRICAO_ASSUNTO"] ?></td>

		
						<td>
				<?=anchor("assuntos/formulario/{$assunto['ID_ASSUNTO']}", '<img src="'.base_url().'imagens/ic_editar.png" alt="Delete" />', $atts)?>	
				
<a onclick="deleteArticle(<?=$assunto['ID_ASSUNTO']?>)"><img src="<?=base_url()?>imagens/delete.png" alt="Delete" /></i></a>

	</td>

					</tr>
<?php endforeach ?>

				
				
				
				
				
				<tbody>
			
			</table>

		</div>
	</div>
</div>




<?php endif?>


