

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
header("Content-Type: text/html; charset=UTF-8",true);

?>

<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>



		<script type="text/javascript">
		var dados = <?=$dados;?>;


		Highcharts.chart('container', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Quantidade de Acertos por Questão'
		    },
		    subtitle: {
		        text: ''
		    },
		    xAxis: {
		        type: 'category',
		        labels: {
		            rotation: -45,
		            style: {
		                fontSize: '13px',
		                fontFamily: 'Verdana, sans-serif'
		            }
		        }
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Quantidade de Acertos'
		        }
		    },
		    legend: {
		        enabled: false
		    },
		    tooltip: {
		        pointFormat: 'Quantidade de Acertos: <b>{point.y:1f}</b>'
		    },
		    series: [{
		        name: 'Population',
		        data: dados,
		        dataLabels: {
		            enabled: true,
		            rotation: -90,
		            color: '#FFFFFF',
		            align: 'right',
		            format: '{point.y:1f}', // one decimal
		            y: 10, // 10 pixels down from the top
		            style: {
		                fontSize: '13px',
		                fontFamily: 'Verdana, sans-serif'
		            }
		        }
		    }]
		});
</script>
	</body>
</html>




