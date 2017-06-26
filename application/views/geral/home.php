
<?php
if ($idempresa == 0) {
	
	?>


<div class="page-header">
	<h1>
		<span class="text-light-gray">Minhas Contas</span>
	</h1>
</div>


<div class="table-primary">





	<table class="table table-striped bordered">
		<thead>
			<tr>
				<td><b>Nome da Conta</b></td>
				<td><b>Detalhes</b></td>
			</tr>
		</thead>
		<tbody>
	<?php
	if ($this->session->userdata ( "usuario_logado" )) :
		
		foreach ( $empresa as $produto ) :
			?>
	<tr>
				<td>
					<!-- Não sei explicar o que aconteceu apó a colocação do novo layot. Estava perdendo a referência do 
		idempresa na sessão e só volvou a funcionar quando passei um segundo parâmetro aqui. 
		Este 3 não serve pra nada, é uma gambiarra que tenho que descobrir por que aconteceu isso. 
		Sem esse novo layout não precisa disso. -->
		<?=anchor("geral/home/{$produto['idempresa']}/3", $produto["nome_empresa"])?>
	
		</td>
				<td>
		
		<?=anchor("empresa/empresaFormulario/{$produto['idempresa']}", 'Editar')?>
	
		</td>
			</tr>
<?php endforeach ?>
</tbody>
	</table>
</div>
<p><?=anchor("empresa/empresaFormulario", 'Criar Conta', array("class" => "btn btn-primary"))?></p>


<?php endif?>

<?php
} else {
	// $this->session->set_userdata("idempresa", $idempresa);
	
	// print_r($empresa);
	$idempresa = $this->session->userdata ( "idempresa" );
	// $empresaData = $empresa["idempresa"];
	foreach ( $empresa as $empresaUsuario ) {
		if ($empresaUsuario ["idempresa"] == $idempresa) {
			
			?>

<div class="page-header">
	<h1>
		<span class="text-ligth-grey"><?=$empresaUsuario ["nome_empresa"] ?></span>
	</h1>
</div>
<!-- WIZARDS -->

<!-- 11. $WIZARDS ==================================================================================

				Wizards
-->
				<!-- Javascript -->
				<script>
					init.push(function () {
						$('.ui-wizard-example').pixelWizard({
							onChange: function () {
								console.log('Current step: ' + this.currentStep());
							},
							onFinish: function () {
								// Disable changing step. To enable changing step just call this.unfreeze()
								this.freeze();
								console.log('Wizard is freezed');
								console.log('Finished!');
							}
						});

						$('.wizard-next-step-btn').click(function () {
							$(this).parents('.ui-wizard-example').pixelWizard('nextStep');
						});

						$('.wizard-prev-step-btn').click(function () {
							$(this).parents('.ui-wizard-example').pixelWizard('prevStep');
						});

						$('.wizard-go-to-step-btn').click(function () {
							$(this).parents('.ui-wizard-example').pixelWizard('setCurrentStep', 2);
						});

						$('#ui-wizard-modal').on('show.bs.modal', function (e) {
							var $modal = $(this),
							    $wizard = $modal.find('.ui-wizard-example'),
							    timer = null,
							    callback = function() {
							    	if (timer) clearTimeout(timer);
							    	if ($modal.hasClass('in')) {
							    		$wizard.pixelWizard('resizeSteps');
							    	} else {
							    		timer = setTimeout(callback, 10);
							    	}
							    };
							callback();
						});
					});
				</script>
				<!-- / Javascript -->

				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">Configure sua nova plataforma educacional</span>
					</div>
					<div class="panel-body">
						<div class="wizard ui-wizard-example">
							<div class="wizard-wrapper">
								<ul class="wizard-steps">
									<li data-target="#wizard-example-step1" >
										<span class="wizard-step-number">1</span>
										<span class="wizard-step-caption">
											Passo 1
											<span class="wizard-step-description">Conheça o Bizu</span>
										</span>
									</li
									>
									<li data-target="#wizard-example-step2"> <!-- ! Remove space between elements by dropping close angle -->
										<span class="wizard-step-number">2</span>
										<span class="wizard-step-caption">
											Passo 2
											<span class="wizard-step-description">Cadastre os Questões</span>
										</span>
									</li
									>
									<li data-target="#wizard-example-step3"> <!-- ! Remove space between elements by dropping close angle -->
										<span class="wizard-step-number">3</span>
										<span class="wizard-step-caption">
											Passo 3
											<span class="wizard-step-description">Cadastre os Alunos</span>
										</span>
									</li
									><li data-target="#wizard-example-step4"> <!-- ! Remove space between elements by dropping close angle -->
										<span class="wizard-step-number">4</span>
										<span class="wizard-step-caption">
											Começe a utilizar
										</span>
									</li>
								</ul> <!-- / .wizard-steps -->
							</div> <!-- / .wizard-wrapper -->
							<div class="wizard-content panel">
								<div class="wizard-pane" id="wizard-example-step1">
									
									<div class="note note-info">O SuperBizu é uma plataforma educacional com foco em exercícios</div>
								
									<div class="note note-primary">Através da plataforma, você, professor, poderá: </div>
									<ul>
										<li>Cadastrar exercícios</li>
										<li>Criar listas de exercícios</li>
										<li>Cadastrar seus alunos</li>
										<li>Organizar os alunos em grupos</li>	
									</ul>
								<div class="note note-info">Os seus alunos podem resolver os exercícios através do aplicativo SuperBizu, disponível na Google Play</div>	
									<br/><br/><br/>
									<button class="btn btn-primary wizard-next-step-btn">Próximo</button>
								</div> <!-- / .wizard-pane -->
								<div class="wizard-pane" id="wizard-example-step2" style="display: none;">
								<div class="note note-info">1 - Assuntos de Questões</div>
									<p>Cadastre os assuntos das questões para facilidatar a categorização e a disponiblização para seus alunos.</p>
									<div class="note note-info">2 - Questões</div>
									<p>Cadastre as suas questões que poderão serão disponibilziadas aos alunos.</p>
									
									
									
									<div class="note note-info">3- Lista de Questões</div>
									
									<p>Crie as listas de questões. Os seus alunos poderão visualizar suas listas e respondê-las através do aplicativo. </p>
									
									
									
									<button class="btn wizard-prev-step-btn">Voltar</button>
									<button class="btn btn-primary wizard-next-step-btn">Próximo</button>
								</div> <!-- / .wizard-pane -->
								<div class="wizard-pane" id="wizard-example-step3" style="display: none;">
									
									<div class="note note-info">1- Cadastre seus alunos</div>
									<p>Cadastre todos os seus alunos para que eles possam ter acesso às listas que você disponibilizá.</p>
									<div class="note note-info">2- Grupos de alunos</div>
									<p>Para que eles tenham acesso as listas é ncessário que você coloque-os nos devidos grupos.</p>
									<button class="btn wizard-prev-step-btn">Voltar</button>
									<button class="btn btn-primary wizard-next-step-btn">Próximo</button>
								</div> <!-- / .wizard-pane -->
								<div class="wizard-pane" id="wizard-example-step4" style="display: none;">
									
									<div class="note note-info">Divulgue para seus alunos</div>
									<p>Diga aos seus alunos para baixarem o aplicativo SuperBizu e resolver os exercícios que você dizponibilizou.</p>
									
									<div class="note note-info">Verifique o desempenho dos seus alunos</div>
									<p>Após eles resolverem os exercícios, você pode acompanhar o cada um respondeu através do superbizu.com.</p>
									
									<button class="btn wizard-prev-step-btn">Voltar</button>
									<button class="btn btn-success wizard-go-to-step-btn">Voltar ao Passo 2</button>
									<button class="btn btn-primary wizard-next-step-btn">Concluir</button>
								</div> <!-- / .wizard-pane -->
							</div> <!-- / .wizard-content -->
						</div> <!-- / .wizard -->
					</div>
				</div>
<!-- /11. $WIZARDS -->


<!-- FIM WIZARDS -->
<?php
		}
	}
}
?>


