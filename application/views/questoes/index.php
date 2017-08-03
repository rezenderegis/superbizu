<style>
#formatacao { 
    z-index: 2;
    position: relative;

}
</style>

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
				
				
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><b>ID</b></th>
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
									<td><?=$questao["nome_materia"] ?></td>
				
				
									<td style="width: 300px">
						<?=word_limiter($questao["DESCRICAO_QUESTAO"], 20)?>
						<?//=anchor("questoes/mostra/{$produto['id']}", $produto["nomeproduto"]) //NÃO PRECISEI CHAMAR O CONTROLER NO EXEMPLO ACIMA POR CONTA DO ROUTER QUE FOI CONFIGURADO NO ROUTES.PHP?>
						</td>
						
				
									<td style="width: 50px"> 
									
								<div class="btn-group btn-group-xs">
								<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-cog"></span>&nbsp;<span class="fa fa-caret-down"></span></button>
								<ul class="dropdown-menu dropdown-menu-right" id="formatacao">
									<li><?=anchor ( "questoes/formulario/{$questao['ID_QUESTAO']}", '<img src="' . base_url () . 'imagens/ic_editar.png" alt="Delete" /> &nbsp;&nbsp;&nbsp;&nbsp;Editar' )?></li>
									<li><?=anchor("questoes/listaItens/{$questao['ID_QUESTAO']}",  '<img src="'.base_url().'imagens/ic_add_box.png" alt="Delete" />  &nbsp;&nbsp;&nbsp;&nbsp;Incluir Itens')?></li>
									<li><?=anchor_popup("arquivo/novaEvidencia/{$questao['ID_QUESTAO']}", '<img src="'.base_url().'imagens/ic_insert_photo.png" alt="Delete" />  &nbsp;&nbsp;&nbsp;&nbsp;Incluir Imagem', $atts)?></li>
									<li><?=anchor ( "questoes/desativarQuestao/{$questao['ID_QUESTAO']}", '<img src="' . base_url () . 'imagens/ic_editar.png" alt="Delete" /> &nbsp;&nbsp;&nbsp;&nbsp;Excluir' )?></li>
									<?php
							
							if (! empty ( $questao ['NOME_IMAGEM_QUESTAO_SISTEMA'] )) {
								?>
									<li>
														<?=anchor(base_url("uploads/{$questao['NOME_IMAGEM_QUESTAO_SISTEMA']}"),  '<img src="'.base_url().'imagens/ic_zoom_in.png" alt="Delete" />  &nbsp;&nbsp;&nbsp;&nbsp;Ver Imagem');?>
										</li>
							<?php } else {echo "";}?>
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
