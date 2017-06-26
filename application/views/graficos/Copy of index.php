
<div class="table-primary">
	<div class="table-header">
		<div class="table-caption">Percentual de Acerto em Questões</div>
	</div>
</div>
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


	
							</div> <!-- / .modal-body -->
							<div class="modal-footer text-center" >
								<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
							</div>
						</div> <!-- / .modal-content -->
					</div> <!-- / .modal-dialog -->
				</div> <!-- /.modal -->
				</div><!-- / Modal -->

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<style type="text/css">

		</style>
	</head>
	<body>

<?php 











foreach ($questoesPorLista as $questoes)  {
	//print_r($questoes); die();
	$CI =& get_instance();
	header("Content-Type: text/html; charset=UTF-8",true);	
	$percentualAcertos = $CI->trazDadosQuestao($questoes['IDLISTAQUESTAO'],$questoes['idGrupo'],$questoes['ID_QUESTAO']);

	echo "<table>";
	
	for ($i = 1; $i < 21; $i++) {
		
		
		if ($i % 2 != 0) {
			
			echo "<tr>";
			echo "<td>";
?>

<div id="<?=$questoes['ID_QUESTAO']?>" style="border: 1px solid #ccc" ></div>

<?php 
			echo "</td>";
		}
		if ($i % 2 == 0) {
			
			
			echo "<td>";
?>
<div id="<?=$questoes['ID_QUESTAO']?>" style="border: 1px solid #ccc"></div>

<?php 
			echo "</td>";
			echo "</tr>";
		}
		
	}
	
	?>
</table>	
	
<script type="text/javascript">

var dados = <?=$percentualAcertos;?>;
//console.log(dados);
var dadosJsonString = JSON.stringify(dados);

//console.log(dadosJsonString);

Highcharts.chart('<?=$questoes['ID_QUESTAO']?>', {
	
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<?=$questoes['NUMERO_QUESTAO']." - ".word_limiter($questoes['DESCRICAO_QUESTAO'], 20)?>'
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
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
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


	</body>
</html>




