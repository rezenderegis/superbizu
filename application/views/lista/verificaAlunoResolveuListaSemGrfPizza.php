
<div class="table-primary">
	<div class="table-header">
		<div class="table-caption"><?=$dadosGrupoLista['nomeGrupo']?> Lista <?=$dadosGrupoLista['descricao']?> </div>
	</div>



<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


		<script type="text/javascript">

		var dados = <?=$percentualAcertoLista;?>;
		console.log(dados);
		var dadosJsonString = JSON.stringify(dados);


		
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total percent market share'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: dados
    }] 
});
		</script>




<br/>
<br/>


	<table class="table table-striped bordered">
		<thead>
			<tr>
				<th>Aluno</th>
				<th><b>Resolveu</b></th>
				<th><b>Percentual Acertos</b></th>

			</tr>
		</thead>
		<tbody>
	<?php
	$CI =& get_instance();
	
	
	if ($this->session->userdata ( "usuario_logado" )) :
		foreach ( $listaQuestao as $lista ) :
		$percentualAcertos = $CI->contaPercentualAcertos($lista['RES'],$lista['idLista']);
			?>
	<tr>
				<td class="idLista"><?=$lista['nome'] ?></td>
				<td><?php if ($lista["RES"]) {echo "Sim";}else {echo "Não";} ?></td>
				<td><?=($percentualAcertos ? $percentualAcertos."%" : "") ?></td>

				
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






