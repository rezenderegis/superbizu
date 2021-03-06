	<script>
					init.push(function () {
						$('#jq-datatables-example').dataTable();
						$('#jq-datatables-example_wrapper .table-caption').text('Some header text');
						$('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
					});
				</script>

<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Questões Cadastradas</span>
	</h1>
</div>

<!-- panel-body -->
<div class="buttons-with-margins">
<?=anchor('questoes/formulario', 'Cadastrar Questão', array("class" => "btn btn-primary"))?>
</div>
<br />
<div class="panel">
	<div class="panel-body">
					<div class="table-primary">
				
				
						<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
					
							<thead>
								<tr>
									<th><b>ID</b></th>
									<th><b>Ano</b></th>
									<th><b>Aplicação</b></th>
									<th><b>Dia</b></th>
									<th><b>Número</b></th>
									<th><b>Gabarito</b></th>
									
									<th><b>Matéria</b></th>
									<th><b>Questão</b></th>
									<th><b>Ações</b></th>
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
						foreach ( $questoes as $questao ) :
							
							?>
					
					<tr>
									<td><?=$questao["ID_QUESTAO"] ?></td>
									<td><?=$questao["ANO_QUESTAO"] ?></td>
									<td><?=$questao["APLICACAO"] ?></td>
									<td><?=$questao["DIA_PROVA"] ?></td>
									<td><?=$questao["NUMERO_QUESTAO"] ?></td>
									
									<td><?=$questao["LETRA_ITEM_CORRETO"] ?></td>
									
									<td><?=$questao["nome_materia"] ?></td>
				
				
									<td style="width: 300px">
						<?=word_limiter($questao["DESCRICAO_QUESTAO"], 20)?>
						<?//=anchor("questoes/mostra/{$produto['id']}", $produto["nomeproduto"]) //NÃO PRECISEI CHAMAR O CONTROLER NO EXEMPLO ACIMA POR CONTA DO ROUTER QUE FOI CONFIGURADO NO ROUTES.PHP?>
						</td>
						
				
				
									<td style="width: 50px"> 
									
										<div class="btn-group btn-group-xs">
								<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-cog"></span>&nbsp;<span class="fa fa-caret-down"></span></button>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><?=anchor ( "questoes/formulario/{$questao['ID_QUESTAO']}", '<img src="' . base_url () . 'imagens/ic_editar.png" alt="Delete" /> &nbsp;&nbsp;&nbsp;&nbsp;Editar' )?></li>
									<li><?=anchor("questoes/listaItens/{$questao['ID_QUESTAO']}",  '<img src="'.base_url().'imagens/ic_add_box.png" alt="Delete" />  &nbsp;&nbsp;&nbsp;&nbsp;Incluir Itens')?></li>
									<li><?=anchor_popup("arquivo/novaEvidencia/{$questao['ID_QUESTAO']}", '<img src="'.base_url().'imagens/ic_insert_photo.png" alt="Delete" />  &nbsp;&nbsp;&nbsp;&nbsp;Incluir Imagem', $atts)?></li>
									<li><?php
							
							if (! empty ( $questao ['NOME_IMAGEM_QUESTAO_SISTEMA'] )) {
								?>
														<?=anchor(base_url("uploads/{$questao['NOME_IMAGEM_QUESTAO_SISTEMA']}"),  '<img src="'.base_url().'imagens/ic_zoom_in.png" alt="Delete" />  &nbsp;&nbsp;&nbsp;&nbsp;Ver Imagem');?>
										
							<?php } else {echo "";}?></li>
									<li class="divider"></li>
									<li class="dropdown-header">Ações</li>
								</ul> <!-- / .dropdown-menu -->
							</div> <!-- / .btn-group -->
									
									
							
								
						
						
							
							
								
						
						
						
									
							
						
					
							
							
							
							
							
							
								
								</tr>
				<?php endforeach ?>
				</tbody>
						</table>
				
				
				<?php endif?>
				
				
				
				</div>
	</div>
</div>
