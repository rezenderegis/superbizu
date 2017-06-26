
<!-- Gráficos -->


<div class="row">
<div class="col-md-6">

<!-- 5. $MORRISJS_GRAPH ============================================================================

Morris.js Graph
-->
<!-- Javascript -->
<script>
init.push(function () {
		var tax_data = [
	{"period": "2011 Q3", "licensed": 3407, "sorned": 660},
	{"period": "2011 Q2", "licensed": 3351, "sorned": 629},
	{"period": "2011 Q1", "licensed": 3269, "sorned": 618},
	{"period": "2010 Q4", "licensed": 3246, "sorned": 661},
	{"period": "2009 Q4", "licensed": 3171, "sorned": 676},
	{"period": "2008 Q4", "licensed": 3155, "sorned": 681},
	{"period": "2007 Q4", "licensed": 3226, "sorned": 620},
	{"period": "2006 Q4", "licensed": 3245, "sorned": null},
	{"period": "2005 Q4", "licensed": 3289, "sorned": null}
	];
						Morris.Line({
								element: 'hero-graph',
								data: tax_data,
								xkey: 'period',
								ykeys: ['licensed', 'sorned'],
								labels: ['Licensed', 'Off the road'],
								lineColors: PixelAdmin.settings.consts.COLORS,
								lineWidth: 2,
								pointSize: 4,
								gridLineColor: '#cfcfcf',
								resize: true
								});
								});
								</script>
								<!-- / Javascript -->

								<div class="panel">
								<div class="panel-heading">
								<span class="panel-title">Morris.js Graph</span>
								</div>
								<div class="panel-body">
						<div class="note note-info">More info and examples at <a href="http://www.oesmith.co.uk/morris.js/" target="_blank">http://www.oesmith.co.uk/morris.js/</a></div>

						<div class="graph-container">
							<div id="hero-graph" class="graph"></div>
									</div>
									</div>
									</div>
									<!-- /5. $MORRISJS_GRAPH -->

									<!-- 6. $MORRISJS_AREA =============================================================================

									Morris.js Area
									-->
									<!-- Javascript -->
									<script>
									init.push(function () {
										Morris.Area({
										element: 'hero-area',
										data: [
										{ period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647 },
										{ period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441 },
										{ period: '2010 Q3', iphone: 4912, ipad: 1969, itouch: 2501 },
										{ period: '2010 Q4', iphone: 3767, ipad: 3597, itouch: 5689 },
										{ period: '2011 Q1', iphone: 6810, ipad: 1914, itouch: 2293 },
										{ period: '2011 Q2', iphone: 5670, ipad: 4293, itouch: 1881 },
										{ period: '2011 Q3', iphone: 4820, ipad: 3795, itouch: 1588 },
										{ period: '2011 Q4', iphone: 15073, ipad: 5967, itouch: 5175 },
										{ period: '2012 Q1', iphone: 10687, ipad: 4460, itouch: 2028 },
										{ period: '2012 Q2', iphone: 8432, ipad: 5713, itouch: 1791 }
										],
										xkey: 'period',
										ykeys: ['iphone', 'ipad', 'itouch'],
										labels: ['iPhone', 'iPad', 'iPod Touch'],
										hideHover: 'auto',
										lineColors: PixelAdmin.settings.consts.COLORS,
										fillOpacity: 0.3,
										behaveLikeLine: true,
												lineWidth: 2,
												pointSize: 4,
												gridLineColor: '#cfcfcf',
												resize: true
										});
										});
												</script>
												<!-- / Javascript -->

												<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">Morris.js Area</span>
					</div>
					<div class="panel-body">
							<div class="note note-info">More info and examples at <a href="http://www.oesmith.co.uk/morris.js/" target="_blank">http://www.oesmith.co.uk/morris.js/</a></div>

							<div class="graph-container">
							<div id="hero-area" class="graph"></div>
							</div>
							</div>
							</div>
							<!-- /6. $MORRISJS_AREA -->

							</div>
							<div class="col-md-6">

							<!-- 7. $MORRISJS_BARS =============================================================================

							Morris.js Bars
							-->
							<!-- Javascript -->
							<script>
							init.push(function () {
							Morris.Bar({
							element: 'hero-bar',
							data: [
								{ device: 'iPhone', geekbench: 136 },
								{ device: 'iPhone 3G', geekbench: 137 },
								{ device: 'iPhone 3GS', geekbench: 275 },
								{ device: 'iPhone 4', geekbench: 380 },
								{ device: 'iPhone 4S', geekbench: 655 },
								{ device: 'iPhone 5', geekbench: 1571 }
								],
								xkey: 'device',
								ykeys: ['geekbench'],
								labels: ['Geekbench'],
								barRatio: 0.4,
								xLabelAngle: 35,
								hideHover: 'auto',
								barColors: PixelAdmin.settings.consts.COLORS,
							gridLineColor: '#cfcfcf',
							resize: true
										});
										});
										</script>
				<!-- / Javascript -->

				<div class="panel">
				<div class="panel-heading">
						<span class="panel-title">Morris.js Bars</span>
						</div>
						<div class="panel-body">
						<div class="note note-info">More info and examples at <a href="http://www.oesmith.co.uk/morris.js/" target="_blank">http://www.oesmith.co.uk/morris.js/</a></div>

						<div class="graph-container">
						<div id="hero-bar" class="graph"></div>
						</div>
						</div>
						</div>
						<!-- /7. $MORRISJS_BARS -->

						<!-- 8. $MORRISJS_DONUT ============================================================================

								Morris.js Donut
								-->
				<!-- Javascript -->
				<script>
				init.push(function () {
				Morris.Donut({
						element: 'hero-donut',
						data: [
						{ label: 'Jam', value: 25 },
						{ label: 'Frosted', value: 40 },
						{ label: 'Custard', value: 25 },
						{ label: 'Sugar', value: 10 }
						],
						colors: PixelAdmin.settings.consts.COLORS,
								resize: true,
								labelColor: '#888',
								formatter: function (y) { return y + "%" }
										});
										});
				</script>
				<!-- / Javascript -->

						<div class="panel">
						<div class="panel-heading">
						<span class="panel-title">Morris.js Donut</span>
						</div>
						<div class="panel-body">
						<div class="note note-info">More info and examples at <a href="http://www.oesmith.co.uk/morris.js/" target="_blank">http://www.oesmith.co.uk/morris.js/</a></div>

						<div class="graph-container">
							<div id="hero-donut" class="graph"></div>
						</div>
					</div>
				</div>


			</div>
		</div>



<!-- Fim Gráficos -->