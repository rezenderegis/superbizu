<div class="page-header">
	<h1><span class="text-ligth-gray">Grupos de Alunos com acesso à Lista</span></h1>
</div>
<?php 


?>
<div class="panel-heading">
	<span class="panel-title">
		Inclusão de Novo Grupo para Acessar à Lista
	</span>
</div>
<div class="panel-body">

	<?php 
	echo form_open ( "grupos_alunos/incluirGrupoParaAcessoLista", array (
			'id' => 'grupoAcessoLista'
	) );
	?>
	<div class='row form-group'>
		<lable class="col-sm-4 control-label">Grupo para Acesso à Lista:</lable>
		<div class='col-sm-4'>
			<select name='grupoAcessoLista' id='grupoAcessoLista' class='form-control'>
				<option></option>"
					<?php 
					if (count ( $gruposMostrarComboInclusao )) {
						
						foreach ( $gruposMostrarComboInclusao as $key => $list ) {
							
							echo "<option value='" . $list ['idGrupo'] . "'>" . $list ['nomeGrupo'] . "</option>";
						}
					}
					?>
			</select>
		</div>
	</div>

</div>

<div class="panel-footer text-center">
	<?php 
echo form_hidden ( array (
		"idListaQuestao" => $idListaQuestao 
) );
echo form_button ( array (
		"class" => "btn btn-primary",
		"content" => "Cadastrar",
		"type" => "submit" 
) );

echo form_close ();

?>
</div>
<br/>
<div class="table-primary">
		<div class="table-header">
			<div class="table-caption">
				Grupos com Acesso
			</div>
		</div>
		<table class="table table-striped bordered">
		<thead>
		<tr><th><b>Grupo</b></th><th>Desabilitar Acesso Grupo</th></tr>
		</thead>
		<tbody>
			<?php 
			
		
			
	
			
			if($this->session->userdata("usuario_logado")) :
			foreach ($grupos as $grupo) : 
			
			?>
			<tr>
			
						<td><?=$grupo["nomeGrupo"] ?></td>	
		
				<td>
						<?=anchor("grupos_alunos/excluirGrupoAcessoLista/{$grupo['idListaGrupo']}/{$grupo['idLista']}",  '<img src="'.base_url().'imagens/delete.png" alt="Delete" />')?>
				
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
		</table>
</div>




<?php endif?>


