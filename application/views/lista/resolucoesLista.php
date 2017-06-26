
<div class="table-primary">
	<div class="table-header">
	<div class="table-caption">Lista de Questões</div>
</div>


	<table class="table table-striped bordered">
		<thead>
			<tr>
				<th>ID Lista</th>
				<th><b>Descrição da Lista</b></th>
				<th><b>Grupo Disponível</b></th>
				<th><b>Gráfico</b></th>
				
			</tr>
		</thead>
		<tbody>
	<?php
	if ($this->session->userdata ( "usuario_logado" )) :
		foreach ( $listaQuestao as $lista ) :
			
			?>
	<tr>
				<td class="idLista"><?=$lista['IDLISTAQUESTOES'] ?></td>
				<td> <?=anchor("lista/verificarAlunoResolveuLista/{$lista['IDLISTAQUESTOES']}/{$lista['idgrupo']}", $lista["DESCRICAO"])?>
				
				<td><?=$lista["nomeGrupo"]." (".$lista["idgrupo"].")"?></td>

				<td> <?=anchor("lista/graficoLista/{$lista['IDLISTAQUESTOES']}/{$lista['idgrupo']}", "Ver")?>

		
				<!-- 
				<td>
				
					<button type="button" onclick="loadDoc()" data-toggle="modal" data-target="#myModal">Request data</button>
				
								
				</td>
				 -->
			</tr>
	
<?php endforeach ?>
</tbody>
	</table>
</div>

			
				
<?php endif?>



<!-- MODAL -->

<!-- Modal -->
				<div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title" id="myModalLabel">Questões da Lista</h4>
							</div>
							<div class="modal-body">
						
							
								<p id="demo">
									 
								<div class="table-primary">
	<div class="table-header">
		<div class="table-caption">Lista de Questões</div>
	</div>

	
	<table class="table table-striped bordered" id="consulta">
		<thead>
			<tr>
				<th>ID Lista</th>
				<th><b>Nome da Matéria</b></th>
				
				<th><b>Assunto</b></th>
				<th><b>Comando</b></th>
				<th><b>Descrição Questão</b></th>

			</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
							</div> <!-- / .modal-body -->
							<div class="modal-footer text-center" >
								<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div> <!-- /.modal -->
				</div><!-- / Modal -->






