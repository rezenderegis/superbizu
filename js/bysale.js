$(function() {
    $('#preco').maskMoney();
  });
$(function() {
	$('#telefone').mask('(000) 0000-00000'); 
	  });



//Valida��o de email para login
$(document).ready(function(){
	   $("#login").submit(function(){
	      var email = $("#email").val();
	      if(email != "")
	      {
	         var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	         if(!filtro.test(email))
	         {
	           alert("Digite um endere�o de e-mail v�lido!");
	           return false;
	         }
	      } 
	   });
	});


//Valida��o de email para login
$(document).ready(function(){
	   $("#novousuario").submit(function(){
	      var email = $("#email").val();
	      if(email != "")
	      {
	         var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	         if(!filtro.test(email))
	         {
	           alert("Digite um endere�o de e-mail v�lido!");
	           return false;
	         }
	      } 
	   });
	});

//Valida��o de email para cadastro de novo cliente
$(document).ready(function(){
	   $("#cadastro_cliente").submit(function(){
	      var email = $("#email").val();
	      if(email != "")
	      {
	         var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	         if(!filtro.test(email))
	         {
	           alert("Digite um endere�o de e-mail v�lido!");
	           return false;
	         }
	      } 
	   });
	});

	  $(document).ready(function() {
			oTable = $('#consulta_vendas').dataTable({
				"bPaginate": true,
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
			});
		});
      
  
  
