<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>SuperBizu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

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


<!-- $DEMO =========================================================================================

	Remove this section on production
-->
	<style>
		#signup-demo {
			position: fixed;
			right: 0;
			bottom: 0;
			z-index: 10000;
			background: rgba(0,0,0,.6);
			padding: 6px;
			border-radius: 3px;
		}
		#signup-demo img { cursor: pointer; height: 40px; }
		#signup-demo img:hover { opacity: .5; }
		#signup-demo div {
			color: #fff;
			font-size: 10px;
			font-weight: 600;
			padding-bottom: 6px;
		}
	</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
	<script>
	$(document).ready(function(){
    $('#perfil').on('change', function() {
      if ( this.value == '3')
      //.....................^.......
      {
        $("#codigoConvite").show();
      }
      else
      {
        $("#codigoConvite").hide();
      }
    });
});
	
	</script>
<!-- / $DEMO -->

</head>


<!-- 1. $BODY ======================================================================================
	
	Body

	Classes:
	* 'theme-{THEME NAME}'
	* 'right-to-left'     - Sets text direction to right-to-left
-->
<body class="theme-default page-signup">

<script>
	var init = [];
	init.push(function () {
		var $div = $('<div id="signup-demo" class="hidden-xs"><div>PAGE BACKGROUND</div></div>'),
		    bgs  = [ 'assets/demo/signin-bg-1.jpg', 'assets/demo/signin-bg-2.jpg', 'assets/demo/signin-bg-3.jpg',
		    		 'assets/demo/signin-bg-4.jpg', 'assets/demo/signin-bg-5.jpg', 'assets/demo/signin-bg-6.jpg',
					 'assets/demo/signin-bg-7.jpg', 'assets/demo/signin-bg-8.jpg', 'assets/demo/signin-bg-9.jpg' ];
		for (var i=0, l=bgs.length; i < l; i++) $div.append($('<img src="' + bgs[i] + '">'));
		$div.find('img').click(function () {
			var img = new Image();
			img.onload = function () {
				$('#page-signup-bg > img').attr('src', img.src);
				$(window).resize();
			}
			img.src = $(this).attr('src');
		});
		$('body').append($div);
	});
</script>
<!-- Demo script --> <script src="<?=base_url("assets/demo/demo.js")?>"></script> <!-- / Demo script -->

	<!-- Page background -->
	<div id="page-signup-bg">
		<!-- Background overlay -->
		<div class="overlay"></div>
		<!-- Replace this with your bg image -->
		<img src="<?=base_url("assets/demo/signin-bg-1.jpg")?>" alt="">
	</div>
	<!-- / Page background -->

	<!-- Container -->
	<div class="signup-container">
		<!-- Header -->
		<div class="signup-header">
			<a href="index.html" class="logo">
				<img src="<?=base_url("assets/demo/logo-big.png")?>" alt="" style="margin-top: -5px;">&nbsp;
				SuperBizu
			</a> <!-- / .logo -->
			<div class="slogan">
				Prepare-se para o grande dia!
			</div> <!-- / .slogan -->
		</div>
		<!-- / Header -->
	<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>
	<?php 
			if ($this->session->flashdata('success')) {
		echo "<p class='alert alert-success'>";
			 print_r($this->session->flashdata('success'));
			 
			echo "</p>";
			}	?>
		<!-- Form -->
		<div class="signup-form">
		<?php 
			echo form_open("cadastroUsuario/salvarUsuario", array (
			'id' => 'novousuario',
			'role' => 'form'
	));
				?>
				<div class="signup-text">
					<span>Criar uma nova conta</span>
				</div>

				<div class="form-group w-icon">
					<input type="text" name="nome" id="nome" class="form-control input-lg" placeholder="Nome">
					<span class="fa fa-info signup-form-icon"></span>
				</div>
				
				<div class="form-group w-icon">
					<input type="text" name="email" id="email" class="form-control input-lg" placeholder="E-mail">
					<span class="fa fa-envelope signup-form-icon"></span>
				</div>

				<!-- Perfil -->
				<div class="form-group w-icon">
						<div class="row">
							<div class="col-md-12">
								<select id="perfil" name="perfil" class="form-control input-lg">
										<option value="3">Sou Aluno</option>
										<option value="2">Sou Professor</option>
									

								</select>
							</div>
							
						</div>
					</div>
				
				<!-- Fim Perfil -->
				<div class="form-group w-icon">
					<input type="text" name="codigoConvite" id="codigoConvite" class="form-control input-lg" placeholder="C??digo Convite">
					<span class="fa fa-info signup-form-icon"></span>
				</div>

				<div class="form-group w-icon">
					<input type="password" name="senha" id="senha" class="form-control input-lg" placeholder="Password">
					<span class="fa fa-lock signup-form-icon"></span>
				</div>

				<div class="form-group" style="margin-top: 20px;margin-bottom: 20px;">
					<label class="checkbox-inline">
						<input type="checkbox" name="signup_confirm" class="px" id="confirm_id">
						<span class="lbl">Eu concordo com os termos e condi????es <a href="#" target="_blank">Termos e Condi????es</a></span>
					</label>
				</div>
				<input type="hidden" name="cadastroDoSite" value=<?=$cadastroDoSite?> >
				<div class="form-actions">
					<input type="submit" value="CADASTRAR" class="signup-btn bg-primary">
				</div>
			</form>
			<!-- / Form -->

			<!-- "Sign In with" block -->
			<!-- 
			<div class="signup-with">
				<!-- 
				<a href="index.html" class="signup-with-btn" style="background:#4f6faa;background:rgba(79, 111, 170, .8);">Entrar com <span>Facebook</span></a>
			</div> -->
			<!-- / "Sign In with" block -->
		</div>
		<!-- Right side -->
	</div>

		<div class="have-account">
		J?? tem uma conta? <?=anchor('geral/index', 'Entrar')?>
	</div>


<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="assets/javascripts/bootstrap.min.js"></script>
<script src="assets/javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
	// Resize BG
	init.push(function () {
		var $ph  = $('#page-signup-bg'),
		    $img = $ph.find('> img');

		$(window).on('resize', function () {
			$img.attr('style', '');
			if ($img.height() < $ph.height()) {
				$img.css({
					height: '100%',
					width: 'auto'
				});
			}
		});

		$("#signup-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });

		// Validate name
		$("#name_id").rules("add", {
			required: true,
			minlength: 1
		});

		// Validate email
		$("#email_id").rules("add", {
			required: true,
			email: true
		});
		
		// Validate username
		$("#username_id").rules("add", {
			required: true,
			minlength: 3
		});

		// Validate password
		$("#password_id").rules("add", {
			required: true,
			minlength: 6
		});

		// Validate confirm checkbox
		$("#confirm_id").rules("add", {
			required: true
		});
	});

	window.PixelAdmin.start(init);
</script>

</body>
</html>
