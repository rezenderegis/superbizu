<style>

body, html {
    width: 100%;
    height: 100%;
    margin:0;
    padding:0;
    background: #FFFFFF;
}
.div1 {
	align: center;
    padding: 1px 2px 2px 3px;
    width: 50%;
    float: left;
    background: #FFFFFF;
    height: 100%;
}
.div2 {
	align: center;
    width: 50%;
    float: right;
    background: #FFFFFF;
    height: 100%;
}
</style>
<div class="buttons-with-margins">
<?=anchor('lista/retornaTotalAcertosErrosPorQuestao/'.$dadosGrupoLista['idLista'].'/'.$dadosGrupoLista['idgrupo'], 'Verificar Questões Corretas', array("class" => "btn btn-primary"))?>
</div>
<br /></br>

<div class="table-primary">
	<div class="table-header">
		<div class="table-caption"><?=$dadosGrupoLista['nomeGrupo']?> Lista <?=$dadosGrupoLista['descricao']?> </div>
	</div>



<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto;   background: #FFFFFF;"></div>


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





<?php 
foreach ($questoesPorLista as $questoes)  {
	//print_r($questoes); die();
	$CI =& get_instance();
	header("Content-Type: text/html; charset=UTF-8",true);	
	$percentualAcertos = $CI->trazDadosQuestao($questoes['IDLISTAQUESTAO'],$questoes['idGrupo'],$questoes['ID_QUESTAO']);

	?>
<div class="div1" id="<?=$questoes['ID_QUESTAO']?>"></div>
	
	
<script type="text/javascript">

var dados = <?=$percentualAcertos;?>;
//console.log(dados);
var dadosJsonString = JSON.stringify(dados);

//console.log(dadosJsonString);

Highcharts.chart('<?=$questoes['ID_QUESTAO']?>', {
	
    chart: {
        plotBackgroundColor: '#FFFFFF',
        plotBorderWidth: null,
        plotShadow: true,
        type: 'pie'
    },
    title: {
        text: '<?=$questoes['NUMERO_QUESTAO']." - ".word_limiter($questoes['DESCRICAO_QUESTAO'], 7)?>',
        align: 'justify',
        style: 'CSSObject'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.legend}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: dados
        	
    }]
});
		</script>
	
	
	
	
	
	
	<?php 
	
	}



?>










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




