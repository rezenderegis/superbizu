<html>
<head>
	<!-- 	<meta http-equiv="Content-Type:text/html" content="charset=UTF-8"> -->
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	
	<link rel="stylesheet" href="<?=base_url("css/bootstrap.css")?>">
		<link rel="stylesheet" href="<?=base_url("css/datatable.css")?>">
	
	<link rel="stylesheet" href="<?=base_url("css/mysale.css")?>">
	<link rel="stylesheet" href="<?=base_url("css/estilo/table_jui.css")?>">
	
		
	</head>
<body> 	

<div class="container"> 
<script src="<?php echo base_url('js/jquery-ui-1.9.2.custom/js/jquery-1.8.3.js');?>" type="text/javascript"></script> 
<script src="<?php echo base_url('js/jquery.maskMoney.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.mask.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/datatable/media/js/jquery.dataTables.min.js');?>" type="text/javascript"></script>



<?php 
//echo img('imagens/logo_mysale_site_azul_oceano.jpg');


$image_properties = array(
          'src' => 'imagens/logo_bizu_provisorio.png',
          'class' => 'post_images',
          'width' => '100',
          'height' => '100',
		  'background-size' =>'100%',
		  'background-repeat' => 'no-repeat',
		   'moz-background-size' => '100% 100%',
			'webkit-background-size' => '100% 100%',
		'background-size' => '100% 100%',
          'rel' => 'lightbox'
);

echo img($image_properties);
echo "</br>";
if($this->session->userdata("usuario_logado")) :


$usuario = $this->session->userdata("usuario_logado");


$idempresa = $this->session->userdata('idempresa');
?>



<nav class="site-navigation">  
    <ul id="nav-primary" class="menu horizontal">     

        <?php 
        if ($this->session->userdata('idempresa')) {        	
        	?>
	<li><?=anchor("geral/home/{$this->session->userdata('idempresa')}", 'Home Empresa');?></li>
	<?php }?>
	<li><?=anchor('geral/home', 'Home Usu?rio');?></li>
        <li>
		
		 <?php
		// echo $perfilUsuario;
		 
		
	
		 
		if ($this->session->userdata('idempresa')) {
			if($this->session->userdata('perfil') == 0) {		
		 	?>

            <a class="sub" href="#">Cadastro</a>
            <ul class="sub-menu">
			
                <li><?=anchor("questoes	/index/$idempresa", 'Quest?es');?></li>
				<li><?=anchor("usuarios/index", 'Usu?rio');?></li>
				<li><?=anchor("produtos/indexCategoria", 'Categoria');?></li>
				
				
				<li><?=anchor("empresa/empresaFormulario/{$idempresa}", 'Editar Dados da Conta')?></li>
				
            </ul>
			
        </li>
  <!--  -->

		<?php 
		$validacao = 'sim';
		if ($validacao == 'nao') {
		?>
		<li><?=anchor("vendas/vendasBalcao/cozinha", 'Cozinha');?></li>
        <li><?=anchor("vendas/vendasBalcao/bebida", 'Bebidas');?></li>
        <li><?=anchor("vendas/vendasBalcao/entrega", 'Entregas');?></li>
		<li><?=anchor("vendas/formularioVendaBalcao/$idempresa", 'Registrar Venda');?></li>
		<li><?=anchor("autocomplete/index", 'Venda Balcao');?></li>
		
		<?php }?>
	<?php 	} 
		
	else {
	
		foreach ($this->session->userdata('perfil') as $perfil) {
	
				if ($perfil['idperfil'] == 1) { ?>
					
					<li><?=anchor("vendas/vendasBalcao/cozinha", 'Cozinha');?></li>
				<?php 	
				}
				
				if ($perfil['idperfil'] == 2) { ?>
								
	        		 <li><?=anchor("vendas/vendasBalcao/bebida", 'Bebidas');?></li>
							<?php 	
							}
					
							if ($perfil['idperfil'] == 3) { ?>
															
        <li><?=anchor("vendas/vendasBalcao/entrega", 'Entregas');?></li>
														<?php 	
														}
							
			}?>
			
			
			
			
		
	 <?php		} 
	
 }  ?>
 
        <li><?=anchor('login/logout', 'Sair'); ?></li>
    </ul>
</nav>



<?php 
echo "</br>";
echo "</br>";

echo "Seja bem vindo, <b>".$usuario['nome']."</b>!";
endif;
?>
<br/>

<?php if ($this->session->flashdata("success")) :?>
<p class="alert alert-success"><?=$this->session->flashdata("success")?></p>
<?php endif ?>

<?php if ($this->session->flashdata("danger")) :?>
<p class="alert alert-danger"><?=$this->session->flashdata("danger")?></p>
<?php endif ?>