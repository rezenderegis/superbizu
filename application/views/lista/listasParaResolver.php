<script type="text/javascript">

function loadDoc() {

		
		var self = $(this);
		//console.log(self);

		
		var codigo =  $(this).nextAll('.idLista').text();
		
			$(this).parent().parent().find(".idLista").text();
			//parseFloat(self.closest('tr').children('td.idLista').text());
		console.log("codigo" +codigo);
		var codigo = 5;
		var teste = "";
	//teste
	
	var person = {fname:"John", lname:"Doe", age:25}; 

	var text = "";
	var x;
	for (x in person) {
    	text = person["fname"];
	}
	//	console.log(text);
	
	//

	
	//var myArr = [{"nome": "joao", "b":"2"}, {"nome":"ze", "d":"4"}, {"nome":"lulu", "d":"4"}];

	var myArr = [{"ID_QUESTAO":"1","ANO_QUESTAO":"2016","NUMERO_QUESTAO":"12","DESCRICAO_QUESTAO":"Questao escola 11","COMANDO_QUESTAO":"Questão escola 11","PROVA":"1","SITUACAO_QUESTAO":"1","NOME_IMAGEM_QUESTAO":"1","COMENTARIO_QUESTAO":"teste","NOME_IMAGEM_QUESTAO_SISTEMA":"1","LETRA_ITEM_CORRETO":"A","DIA_PROVA":"1","APLICACAO":"1","ID_DONO":"11","nome_materia":"Porgugues","descricao_assunto":"Pontuacao"},{"ID_QUESTAO":"7","ANO_QUESTAO":"2015","NUMERO_QUESTAO":"123","DESCRICAO_QUESTAO":"adf","COMANDO_QUESTAO":"asdfadf","PROVA":"1","SITUACAO_QUESTAO":"1","NOME_IMAGEM_QUESTAO":"1","COMENTARIO_QUESTAO":"asdf","NOME_IMAGEM_QUESTAO_SISTEMA":"1","LETRA_ITEM_CORRETO":"A","DIA_PROVA":"1","APLICACAO":"1","ID_DONO":"11","nome_materia":"Porgugues","descricao_assunto":"Pontuacao"},{"ID_QUESTAO":"8","ANO_QUESTAO":"22","NUMERO_QUESTAO":"123","DESCRICAO_QUESTAO":"dfasdfadf","COMANDO_QUESTAO":"asdf","PROVA":"1","SITUACAO_QUESTAO":"1","NOME_IMAGEM_QUESTAO":"1","COMENTARIO_QUESTAO":"asdf","NOME_IMAGEM_QUESTAO_SISTEMA":"1","LETRA_ITEM_CORRETO":"A","DIA_PROVA":"1","APLICACAO":"1","ID_DONO":"11","nome_materia":"Porgugues","descricao_assunto":"Pontuacao"},{"ID_QUESTAO":"9","ANO_QUESTAO":"2014","NUMERO_QUESTAO":"99","DESCRICAO_QUESTAO":"adfadf","COMANDO_QUESTAO":"dfadsf","PROVA":"1","SITUACAO_QUESTAO":"1","NOME_IMAGEM_QUESTAO":"1","COMENTARIO_QUESTAO":"dfadf","NOME_IMAGEM_QUESTAO_SISTEMA":"1","LETRA_ITEM_CORRETO":"A","DIA_PROVA":"1","APLICACAO":"1","ID_DONO":"11","nome_materia":"Porgugues","descricao_assunto":"Pontuacao"}];
	
	for( var i=0, l=myArr.length; i<l; i++ ) {
    	//console.log( myArr[i]["COMENTARIO_QUESTAO"] );
	}



		
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	     //document.getElementById("consulta").innerHTML = xhttp.responseText;
	    teste = "";
		teste = xhttp.responseText;
		var dados = JSON.parse(teste);
		console.log(dados);
		
		for( var i=0, l=dados.length; i<l; i++ ) {
    	console.log( dados[i]['DESCRICAO_QUESTAO']);
    	var nome_materia = dados[i]['nome_materia'];
    	var descricao_assunto = dados[i]['descricao_assunto'];
    	var COMANDO_QUESTAO = dados[i]['COMANDO_QUESTAO'];
    	
		var id = dados[i]['ID_QUESTAO'];
		var descricao_questao = dados[i]['DESCRICAO_QUESTAO'];
    	
    	$('#consulta tbody:last').after('<tr><td class="codigo_venda">'+id+'<td>'+nome_materia+'</td><td>'+descricao_assunto+'</td><td>'+COMANDO_QUESTAO+'</td><td>'+descricao_questao+'</td></tr>');
	}
		
	//	$('#consulta tr:last').after('<tr><td class="codigo_venda">'+txt+'</td><td>'+this.SITUACAO_QUESTAO+'</td></tr>');
	     	      
	    }
	  };
	  xhttp.open("GET", "<?=base_url(); ?>index.php/questoes/verDetalhePopup/" +codigo, true);

	  
	  xhttp.send();
	}

</script>

<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Lista de Questões</span>
	</h1>
</div>


<br />
<div class="table-primary">
	<div class="table-header">
		<div class="table-caption">Lista de Questões</div>
	</div>


	<table class="table table-striped bordered">
		<thead>
			<tr>
				<th><b>Professor</b></th>
				
				<th><b>Descrição da Lista</b></th>
				<th><b>Situacao</b></th>
				
				<th><b>Resolver</b></th>

			</tr>
		</thead>
		<tbody>
	<?php
	
	if ($this->session->userdata ( "usuario_logado" )) :
		foreach ( $listaQuestao as $lista ) :
			
			?>
	<tr>
								<td><?=$lista["nome_professor"] ?></td>
				
				<td><?=anchor("lista/formularioResolverLista/{$lista['IDLISTAQUESTOES']}", $lista["DESCRICAO"]) ?></td>
				
				
								<td><?=$lista["SITUACAO_LISTA"] ?></td>
				

				<td class="gacesso"> 
				<?=anchor("lista/formularioResolverLista/{$lista['IDLISTAQUESTOES']}", '<i class="navbar-icon fa fa-bars icon"></i><span')?>
				</td>
			
			</tr>
	
<?php endforeach ?>
</tbody>
	</table>
</div>

			
				
<?php endif?>



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






