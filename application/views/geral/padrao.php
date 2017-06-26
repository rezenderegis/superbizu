<!DOCTYPE html>
<!--

TABLE OF CONTENTS.

Use search to find needed section.

=====================================================

|  1. $BODY                 |  Body                 |
|  2. $MAIN_NAVIGATION      |  Main navigation      |
|  3. $NAVBAR_ICON_BUTTONS  |  Navbar Icon Buttons  |
|  4. $MAIN_MENU            |  Main menu            |
|  5. $CONTENT              |  Content              |

=====================================================

-->


<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="gt-ie8 gt-ie9 not-ie">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Bizu Estudos</title>
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

<!-- Open Sans font from Google CDN -->
<link
	href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin"
	rel="stylesheet" type="text/css">

<!-- Pixel Admin's stylesheets -->
<link href="<?=base_url("assets/stylesheets/bootstrap.min.css")?>"
	rel="stylesheet" type="text/css">
<link href="<?=base_url("assets/stylesheets/pixel-admin.min.css")?>"
	rel="stylesheet" type="text/css">
<link href="<?=base_url("assets/stylesheets/widgets.min.css")?>"
	rel="stylesheet" type="text/css">
<link href="<?=base_url("assets/stylesheets/pages.min.css")?>"
	rel="stylesheet" type="text/css">
<link href="<?=base_url("assets/stylesheets/rtl.min.css")?>"
	rel="stylesheet" type="text/css">
<link href="<?=base_url("assets/stylesheets/themes.min.css")?>"
	rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
		<script src="assets/javascripts/ie.min.js"></script>
	<![endif]-->

</head>


<!-- 1. $BODY ======================================================================================
	
	Body

	Classes:
	* 'theme-{THEME NAME}'
	* 'right-to-left'      - Sets text direction to right-to-left
	* 'main-menu-right'    - Places the main menu on the right side
	* 'no-main-menu'       - Hides the main menu
	* 'main-navbar-fixed'  - Fixes the main navigation
	* 'main-menu-fixed'    - Fixes the main menu
	* 'main-menu-animated' - Animate main menu
-->

<?php
$usuario = '';
if ($this->session->userdata ( "usuario_logado" )) {
	
	$usuario = $this->session->userdata ( "usuario_logado" );
	
	$idempresa = $this->session->userdata ( 'idempresa' );
	
}

 if ($usuario['nome_foto_sistema']) {
	$imagem = "uploads/".$usuario['nome_foto_sistema'];
} else { $imagem = "imagens/ic_no_image.png"; }
	

?>



<body class="theme-default main-menu-animated">

	<script>var init = [];</script>
	<!-- Demo script -->
	<script src="<?php echo base_url('assets/demo/demo.js');?>"></script>
	<!-- / Demo script -->

	<div id="main-wrapper">


		<!-- 2. $MAIN_NAVIGATION ===========================================================================

	Main navigation
-->
		<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
			<!-- Main menu toggle -->
			<button type="button" id="main-menu-toggle">
				<i class="navbar-icon fa fa-bars icon"></i><span
					class="hide-menu-text">HIDE MENU</span>
			</button>

			<div class="navbar-inner">
				<!-- Main navbar header -->
				<div class="navbar-header">

					<!-- Logo -->
					<a href="index.html" class="navbar-brand">
						<div>
							<img alt="Pixel Admin"
								src="<?php echo base_url('assets/images/pixel-admin/main-navbar-logo.png');?>">
						</div> SuperBizu
					</a>

					<!-- Main navbar toggle -->
					<button type="button" class="navbar-toggle collapsed"
						data-toggle="collapse" data-target="#main-navbar-collapse">
						<i class="navbar-icon fa fa-bars"></i>
					</button>

				</div>
				<!-- / .navbar-header -->

				<div id="main-navbar-collapse"
					class="collapse navbar-collapse main-navbar-collapse">
					<div>
					<!-- 
						<ul class="nav navbar-nav">
							<li><a href="#">Home</a></li>
							
							<li class="dropdown"><a href="#" class="dropdown-toggle"
								data-toggle="dropdown">Dropdown</a>
								<ul class="dropdown-menu">
									<li><a href="#">First item</a></li>
									<li><a href="#">Second item</a></li>
									<li class="divider"></li>
									<li><a href="#">Third item</a></li>
								</ul></li>  -->
						</ul>
						 
						<!-- / .navbar-nav -->

						<div class="right clearfix">
							<ul class="nav navbar-nav pull-right right-navbar-nav">

								<!-- 3. $NAVBAR_ICON_BUTTONS =======================================================================

							Navbar Icon Buttons

							NOTE: .nav-icon-btn triggers a dropdown menu on desktop screens only. On small screens .nav-icon-btn acts like a hyperlink.

							Classes:
							* 'nav-icon-btn-info'
							* 'nav-icon-btn-success'
							* 'nav-icon-btn-warning'
							* 'nav-icon-btn-danger' 
-->
							<!-- 	<li class="nav-icon-btn nav-icon-btn-danger dropdown"><a
									href="#notifications" class="dropdown-toggle"
									data-toggle="dropdown"> <span class="label">5</span> <i
										class="nav-icon fa fa-bullhorn"></i> <span
										class="small-screen-text">Notifications</span>
								</a> <!-- NOTIFICATIONS -->
								
								 <!-- Javascript --> <script>
									init.push(function () {
										$('#main-navbar-notifications').slimScroll({ height: 250 });
									});
								</script> <!-- / Javascript -->
								
	<!-- Inicio Notificações -->
								<!-- 		<div class="dropdown-menu widget-notifications no-padding"
										style="width: 300px">
										<div class="notifications-list" id="main-navbar-notifications">

											<div class="notification">
												<div class="notification-title text-danger">SYSTEM</div>
												<div class="notification-description">
													<strong>Error 500</strong>: Syntax error in index.php at
													line <strong>461</strong>.
												</div>
												<div class="notification-ago">12h ago</div>
												<div class="notification-icon fa fa-hdd-o bg-danger"></div>
											</div>
											<!-- / .notification -->

											<!-- 	<div class="notification">
												<div class="notification-title text-info">STORE</div>
												<div class="notification-description">
													You have <strong>9</strong> new orders.
												</div>
												<div class="notification-ago">12h ago</div>
												<div class="notification-icon fa fa-truck bg-info"></div>
											</div>
											<!-- / .notification -->

								<!-- 				<div class="notification">
												<div class="notification-title text-default">CRON DAEMON</div>
												<div class="notification-description">
													Job <strong>"Clean DB"</strong> has been completed.
												</div>
												<div class="notification-ago">12h ago</div>
												<div class="notification-icon fa fa-clock-o bg-default"></div>
											</div>
											<!-- / .notification -->

								<!-- 				<div class="notification">
												<div class="notification-title text-success">SYSTEM</div>
												<div class="notification-description">
													Server <strong>up</strong>.
												</div>
												<div class="notification-ago">12h ago</div>
												<div class="notification-icon fa fa-hdd-o bg-success"></div>
											</div>
											<!-- / .notification -->

									<!-- 			<div class="notification">
												<div class="notification-title text-warning">SYSTEM</div>
												<div class="notification-description">
													<strong>Warning</strong>: Processor load <strong>92%</strong>.
												</div>
												<div class="notification-ago">12h ago</div>
												<div class="notification-icon fa fa-hdd-o bg-warning"></div>
											</div>
											<!-- / .notification -->

								<!-- / .notifications-list -->
									<!-- 		</div>
										
										<a href="#" class="notifications-link">MORE NOTIFICATIONS</a>
									</div> 	
									<!-- / .dropdown-menu --></li> 
									<!-- Fim das notificações -->
									<!-- 
								<li class="nav-icon-btn nav-icon-btn-success dropdown"><a
									href="mail.ru" class="dropdown-toggle" data-toggle="dropdown">
										<span class="label">10</span> <i
										class="nav-icon fa fa-envelope"></i> <span
										class="small-screen-text">Income messages</span>
								</a> <!-- MESSAGES --> <!-- Javascript --> <script>
									init.push(function () {
										$('#main-navbar-messages').slimScroll({ height: 250 });
									});
								</script> <!-- / Javascript -->

									<div class="dropdown-menu widget-messages-alt no-padding"
										style="width: 300px;">
										<div class="messages-list" id="main-navbar-messages">

											<div class="message">
												<img
													src="<?php echo base_url('assets/demo/avatars/2.jpg');?>"
													alt="" class="message-avatar"> <a href="#"
													class="message-subject">Lorem ipsum dolor sit amet,
													consectetur adipisicing elit.</a>
												<div class="message-description">
													from <a href="#">Robert Jang</a> &nbsp;&nbsp;·&nbsp;&nbsp;
													2h ago
												</div>
											</div>
											<!-- / .message -->

											<div class="message">
												<img
													src="<?php echo base_url('assets/demo/avatars/3.jpg');?>"
													alt="" class="message-avatar"> <a href="#"
													class="message-subject">Lorem ipsum dolor sit amet,
													consectetur adipisicing elit, sed do eiusmod tempor
													incididunt ut labore et dolore magna aliqua.</a>
												<div class="message-description">
													from <a href="#">Michelle Bortz</a>
													&nbsp;&nbsp;·&nbsp;&nbsp; 2h ago
												</div>
											</div>
											<!-- / .message -->

											<div class="message">
												<img
													src="<?php echo base_url('assets/demo/avatars/4.jpg');?>"
													alt="" class="message-avatar"> <a href="#"
													class="message-subject">Lorem ipsum dolor sit amet.</a>
												<div class="message-description">
													from <a href="#">Timothy Owens</a>
													&nbsp;&nbsp;·&nbsp;&nbsp; 2h ago
												</div>
											</div>
											<!-- / .message -->

											<div class="message">
												<img
													src="<?php echo base_url('assets/demo/avatars/5.jpg');?>"
													alt="" class="message-avatar"> <a href="#"
													class="message-subject">Lorem ipsum dolor sit amet,
													consectetur adipisicing elit, sed do eiusmod tempor
													incididunt ut labore et dolore magna aliqua.</a>
												<div class="message-description">
													from <a href="#">Denise Steiner</a>
													&nbsp;&nbsp;·&nbsp;&nbsp; 2h ago
												</div>
											</div>
											<!-- / .message -->

											<div class="message">
												<img
													src="<?php echo base_url('assets/demo/avatars/2.jpg');?>"
													alt="" class="message-avatar"> <a href="#"
													class="message-subject">Lorem ipsum dolor sit amet.</a>
												<div class="message-description">
													from <a href="#">Robert Jang</a> &nbsp;&nbsp;·&nbsp;&nbsp;
													2h ago
												</div>
											</div>
											<!-- / .message -->

											<div class="message">
												<img
													src="<?php echo base_url('assets/demo/avatars/2.jpg');?>"
													alt="" class="message-avatar"> <a href="#"
													class="message-subject">Lorem ipsum dolor sit amet,
													consectetur adipisicing elit.</a>
												<div class="message-description">
													from <a href="#">Robert Jang</a> &nbsp;&nbsp;·&nbsp;&nbsp;
													2h ago
												</div>
											</div>
											<!-- / .message -->

											<div class="message">
												<img
													src="<?php echo base_url('assets/demo/avatars/3.jpg');?>"
													alt="" class="message-avatar"> <a href="#"
													class="message-subject">Lorem ipsum dolor sit amet,
													consectetur adipisicing elit, sed do eiusmod tempor
													incididunt ut labore et dolore magna aliqua.</a>
												<div class="message-description">
													from <a href="#">Michelle Bortz</a>
													&nbsp;&nbsp;·&nbsp;&nbsp; 2h ago
												</div>
											</div>
											<!-- / .message -->

											<div class="message">
												<img
													src="<?php echo base_url('assets/demo/avatars/4.jpg');?>"
													alt="" class="message-avatar"> <a href="#"
													class="message-subject">Lorem ipsum dolor sit amet.</a>
												<div class="message-description">
													from <a href="#">Timothy Owens</a>
													&nbsp;&nbsp;·&nbsp;&nbsp; 2h ago
												</div>
											</div>
											<!-- / .message -->

											<div class="message">
												<img
													src="<?php echo base_url('assets/demo/avatars/5.jpg');?>"
													alt="" class="message-avatar"> <a href="#"
													class="message-subject">Lorem ipsum dolor sit amet,
													consectetur adipisicing elit, sed do eiusmod tempor
													incididunt ut labore et dolore magna aliqua.</a>
												<div class="message-description">
													from <a href="#">Denise Steiner</a>
													&nbsp;&nbsp;·&nbsp;&nbsp; 2h ago
												</div>
											</div>
											<!-- / .message -->

											<div class="message">
												<img
													src="<?php echo base_url('assets/demo/avatars/2.jpg');?>"
													alt="" class="message-avatar"> <a href="#"
													class="message-subject">Lorem ipsum dolor sit amet.</a>
												<div class="message-description">
													from <a href="#">Robert Jang</a> &nbsp;&nbsp;·&nbsp;&nbsp;
													2h ago
												</div>
											</div>
											<!-- / .message -->

										</div>
										<!-- / .messages-list -->
										<a href="#" class="messages-link">MORE MESSAGES</a>
									</div> <!-- / .dropdown-menu --></li>
								<!-- /3. $END_NAVBAR_ICON_BUTTONS -->

							 <!-- 	<li>
									<form class="navbar-form pull-left">
										<input type="text" class="form-control" placeholder="Search">
									</form>
								</li> -->
								<?php 
								
								$usuarioParaMostrar = $this->session->userdata('usuario_logado');?>
								<li class="dropdown"><a href="#"
									class="dropdown-toggle user-menu" data-toggle="dropdown"> <img
										src="<?php echo base_url($imagem);?>"
										alt=""> <span><?=$usuarioParaMostrar['nome']?></span>
								</a>
									<ul class="dropdown-menu">
										<li><a href="#"><span class="label label-warning pull-right"></span>Home</a></li>
										<!-- <li><a href="#"><span class="badge badge-primary pull-right">New</span>Account</a></li> -->
										<li><?=anchor("usuarios/alteracaoConta", "<span class='badge badge-primary pull-right'></span>Minha Conta") ?></li> 
										<!-- <li><a href="#"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;Settings</a></li> -->
										<li class="divider"></li>
										<li><?=anchor('login/logout', '<i
												class="dropdown-icon fa fa-power-off">
												</i>&nbsp;&nbsp; Sair'); ?></li>
									</ul></li>
							</ul>
							<!-- / .navbar-nav -->
						</div>
						<!-- / .right -->
					</div>
				</div>
				<!-- / #main-navbar-collapse -->
			</div>
			<!-- / .navbar-inner -->
		</div>
		<!-- / #main-navbar -->
		<!-- /2. $END_MAIN_NAVIGATION -->


		<!-- 4. $MAIN_MENU =================================================================================

		Main menu
		
		Notes:
		* to make the menu item active, add a class 'active' to the <li>
		  example: <li class="active">...</li>
		* multilevel submenu example:
			<li class="mm-dropdown">
			  <a href="#"><span class="mm-text">Submenu item text 1</span></a>
			  <ul>
				<li>...</li>
				<li class="mm-dropdown">
				  <a href="#"><span class="mm-text">Submenu item text 2</span></a>
				  <ul>
					<li>...</li>
					...
				  </ul>
				</li>
				...
			  </ul>
			</li>
-->
		<div id="main-menu" role="navigation">
			<div id="main-menu-inner">
				<div class="menu-content top" id="menu-content-demo">
					<!-- Menu custom content demo
					 CSS:        styles/pixel-admin-less/demo.less or styles/pixel-admin-scss/_demo.scss
					 Javascript: html/assets/demo/demo.js
				 -->
					<div>
						<div class="text-bg">
							<span class="text-slim">Bem vindo, </BR></span> <span
								class="text-semibold"><?=$usuarioParaMostrar['nome']?></span>
						</div>
						
						<img src="<?=base_url($imagem)?>"
							alt="" class="">
						<div class="btn-group">
							<a href="#" class="btn btn-xs btn-primary btn-outline dark"><i
								class="fa fa-envelope"></i></a> <a href="#"
								class="btn btn-xs btn-primary btn-outline dark"><i
								class="fa fa-user"></i></a> <a href="#"
								class="btn btn-xs btn-primary btn-outline dark"><i
								class="fa fa-cog"></i></a> <a href="#"
								class="btn btn-xs btn-danger btn-outline dark"><i
								class="fa fa-power-off"></i></a>
						</div>
						<a href="#" class="close">&times;</a>
					</div>
				</div>
			
				<ul class="navigation">
				
						
				
				
				
					 <?php
					
						if ($this->session->userdata ( 'idempresa' )) {
							?>
	<li><?=anchor("geral/home/{$this->session->userdata ( 'idempresa' )}", '<i class="menu-icon fa fa-tasks"></i><span class="mm-text">Home</span>');?></li>
	
	<?php }
				
			
				if ($this->session->userdata("qtdEmpresasUsuario") > 1 ) { 
	?>
	<li><?=anchor('geral/home', '<i class="menu-icon fa fa-tasks"></i><span class="mm-text">Minhas Contas</span>');?></li>
	<?php  }
	
	
	if ($this->session->userdata('idempresa')) {
		$professor = false;
		foreach ($this->session->userdata('perfil') as $perfil) {
			if ($perfil['idperfil'] == 2) {
				$professor = $perfil['idperfil'];
			}
		}
	}
	
	if ($this->session->userdata('idempresa')) {
		if($professor == 2) {
	
	
	?>
	
	<!-- Menu espefício para professores -->
	
		<!-- <li class="mm-dropdown">
		<a href="#"><i class="menu-icon fa fa-desktop"></i><span class="mm-text">Alunos</span></a>
						<ul>
							<li><?//=anchor("usuarios/listaAlunos", '<span class="mm-text">Alunos Cadastrados</span>');?></li>
							<li><?//=anchor("grupos_alunos/listaGrupos", '<span class="mm-text">Grupos de Alunos</span>');?></li>
						
							
						</ul></li>
		 -->
	<!-- Fim menu específico professores -->
		<li><?=anchor("usuarios/listaAlunos", '<i class="menu-icon fa fa-user"></i><span class="mm-text">Alunos</span>');?></li>
			<li><?=anchor("grupos_alunos/listaGrupos", '<i class="menu-icon fa fa-group"></i><span class="mm-text">Grupos de Alunos</span>');?></li>
	
	<!-- <li class="mm-dropdown">
		<a href="#"><i class="menu-icon fa fa-desktop"></i><span class="mm-text">Alunos</span></a>
						<ul>
							<li><?//=anchor("grupos_alunos/listaGrupos", '<span class="mm-text">Grupos de Alunos</span>');?></li>
						
							
						</ul></li> -->
		 
	<!-- Fim menu específico professores -->
	
	<!-- Menu espefício para questões -->
	
				<li><?=anchor("questoes/index", '<i class="menu-icon fa fa-group"></i><span class="mm-text">Questões</span>');?></li>
				<li><?=anchor("lista/listaQuestoes", '<i class="menu-icon fa fa-group"></i><span class="mm-text">Lista de Questões</span>');?></li>
					<li><?=anchor("assuntos/index", '<i class="menu-icon fa fa-group"></i><span class="mm-text">Assuntos de Questões</span>');?></li>
			<li><?=anchor('usuarios/listaProfessores', '<i class="menu-icon fa fa-group"></i><span class="mm-text"></i><span class="mm-text">Professores</span>');?></li>
	
	<!-- 	<li class="mm-dropdown"><a href="#"><i
							class="menu-icon fa fa-desktop"></i><span class="mm-text">Questões</span></a>
						<ul>
							<li><?//=anchor("questoes/index", '<span class="mm-text">Questões Cadastradas</span>');?></li>
							<li><?//=anchor("assuntos/index", '<span class="mm-text">Assuntos de Questões</span>');?></li>
							<li><?//=anchor("lista/listaQuestoes", '<span class="mm-text">Lista de Questões</span>');?></li>
						
							
						</ul></li> -->
		
	<!-- Fim menu específico professores -->
	
	<!-- Cadastro de usuário -->
	
<?php
//echo "Master ??? ".$this->session->userdata("usuario_master");

if($this->session->userdata("usuario_master") == "S") {
?>
		<li><?=anchor('usuarios/index', '<i class="menu-icon fa fa-tasks"></i><span class="mm-text">Usuários</span>');?></li>
		
		
		<?php 
}
?>
		<li><?=anchor("empresa/empresaFormulario/{$idempresa}", '<i class="menu-icon fa fa-tasks"></i><span class="mm-text">Dados da Conta</span>');?></li>
	
	
	<!-- Fim cadastro de usuário -->
	<?php }

	
	}?>
        	
				
							
				
				</ul>
			
			</div>
			<!-- / #main-menu-inner -->
		</div>
		<!-- / #main-menu -->
		<!-- /4. $MAIN_MENU -->


		<div id="content-wrapper">
			<!-- 5. $CONTENT ===================================================================================

		Content
-->

			<!-- Content here - O corpo da página começa aqui-->
		