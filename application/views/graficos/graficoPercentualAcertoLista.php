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
    background: #ccc;
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
        text: 'Browser market shares. January, 2015 to May, 2015'
    },
    subtitle: {
        text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
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







	</body>
</html>




