<script>
var MQ = MathQuill.getInterface(2);

</script>

<div class="page-header">
	<h1>
		<span class="text-ligth-gray">Cadastro de Nova Questão</span>
	</h1>
</div>

<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>



<?php
$attributes = array (
		'class' => 'control-label',
		'style' => 'color: #000;'
);
$id = $id_questao;

echo form_open ( "questoes/novo", array (
		'id' => 'questoes',
		// 'class' => 'form-horizontal',
		'role' => 'form'
) );

?>

<div class="panel">

<div class="panel-heading">
	<span class="panel-title">Nova Questão</span>
</div>
	<div class="panel-body">

		<div class="row">
            <div class="pull-right"><i class="fas fa-info-circle text-primary"></i> <small class="text-muted">Para saber como construir fórmulas matemáticas, <a href='https://khan.github.io/KaTeX/function-support.html' target='_blank'>clique aqui.</a></small></div>
			<div class="col-sm-12">

				<!-- Pills -->
				<ul class="nav nav-pills bs-tabdrop-example">
					<li class="active"><a href="#bs-tabdrop-pill1" data-toggle="tab">Informações Básicas</a></li>
					<li><a href="#bs-tabdrop-pill2" data-toggle="tab">Informações Opcionais</a></li>

				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="bs-tabdrop-pill1">
                        <div class="form-group">
                            <?= form_label('Questão', 'editor-questao',$attributes) ?>
                            <!-- <a><i class="fas fa-info-circle" data-toggle="popover" data-html="true" data-content="Para saber como construir fórmulas, <a href='https://khan.github.io/KaTeX/function-support.html' target='_blank'>clique aqui.</a>"></i></a> -->
                            <div id="editor-questao"><?= $dados_produto_edicao['DESCRICAO_QUESTAO'] ?></div>
                            <input id="nome" type="hidden" name="nome" value="<?= htmlentities($dados_produto_edicao['DESCRICAO_QUESTAO']) ?>">
                        </div>

                        <div class="form-group">
                            <?= form_label('Comando', 'editor-comando', $attributes) ?>
                            <div id="editor-comando"><?= $dados_produto_edicao['COMANDO_QUESTAO'] ?></div>
                            <input id="comando" type="hidden" name="comando" value="<?= $dados_produto_edicao['COMANDO_QUESTAO'] ?>">
                        </div>

                        <?php
						// echo "<div class='form-group'>";
						// echo form_label ( "Questão", "nome", $attributes );
						// echo "<div class='col-sm-10'>";
						// echo form_textarea ( array (
						// 			"name" => "nome",
						// 			"class" => "form-control",
						// 			"id" => "nome",
						// 			"type" => "text",
						// 			"maxlength" => "5000",
						// 			"value" => set_value ( "nome", $dados_produto_edicao ['DESCRICAO_QUESTAO'] )
						// 	) );
						// 	// echo form_error("nome");
						// echo "</div>";
						// echo "</div>";
                        //
						// echo "<div class='form-group'>";
						// echo form_label ( "Comando da Questão", "comando", $attributes );
						// echo "<div class='col-sm-10'>";
                        //
						// echo form_textarea ( array (
						// 		"name" => "comando",
						// 		"class" => "form-control",
						// 		"id" => "comando",
						// 		"value" => set_value ( "comando", $dados_produto_edicao ['COMANDO_QUESTAO'] )
						// ) );
						// echo "</div>";
						// echo "</div>";




						echo "<div class='form-group'>";
						echo form_label ( "Comentário da Questão", "comentario_questao", $attributes );
						// echo "<div class='col-sm-10'>";

						echo form_textarea ( array (
								"name" => "comentario_questao",
								"class" => "form-control",
                                "rows" => 3,
								"id" => "comentario_questao",
								"value" => set_value ( "comentario_questao", $dados_produto_edicao ['COMENTARIO_QUESTAO'] )
						) );
						// echo "</div>";
						echo "</div>";

						$a = "";
						$b = "";
						$c = "";
						$d = "";
						$e = "";

						if (strcmp ( $dados_produto_edicao ['LETRA_ITEM_CORRETO'], 'A' ) == 0) {
							$a = "selected";
						} else if (strcmp ( $dados_produto_edicao ['LETRA_ITEM_CORRETO'], 'B' ) == 0) {
							$b = "selected";
						} else if (strcmp ( $dados_produto_edicao ['LETRA_ITEM_CORRETO'], 'C' ) == 0) {
							$c = "selected";
						} else if (strcmp ( $dados_produto_edicao ['LETRA_ITEM_CORRETO'], 'D' ) == 0) {
							$d = "selected";
						} else if (strcmp ( $dados_produto_edicao ['LETRA_ITEM_CORRETO'], 'E' ) == 0) {

							$e = "selected";
						}

                        ?>

                    <div class="row">
                        <?php
                        echo "<div class='col-sm-2'>";
						echo form_error ( 'letra_item', "<p class='alert alert-danger'>", "</p>" );
						echo "<div class='form-group'>";
						echo form_label ( "Letra Item", "letra_item", $attributes );
						echo "<select name='letra_item' id='letra_item' class='form-control'>";
						echo "<option value=A " . $a . ">A</option>";
						echo "<option value=B " . $b . ">B</option>";
						echo "<option value=C " . $c . ">C</option>";
						echo "<option value=D " . $d . ">D</option>";
						echo "<option value=E " . $e . ">E</option>";
						echo "</select>";
						echo "</div>";
						echo "</div>";

                        echo "<div class='col-sm-10'>";
						echo "<div class='form-group'>";
						echo form_label ( "Assunto", "assunto_questao", $attributes );
						echo "<select name='assunto_questao' id='assunto_questao' class='form-control'>";
						// echo "<select name='state_id' id='state_id'>";
						echo "<option></option>";
						if (count ( $categoria_produto )) {

							foreach ( $categoria_produto as $key => $list ) {
								// echo $categoria.$list['idcategoriaproduto'];
								if ($list ['id_assunto'] != $assunto_questao) {

									echo "<option value='" . $list ['id_assunto'] . "'>" . $list ['assunto'] . "</option>";
								}
								// echo "<option value='".$list['idcategoriaproduto'].">".$list['nomecategoriaproduto']."</option>";
								if ($list ['id_assunto'] == $assunto_questao) {
									echo "<option value='" . $list ['id_assunto'] . "' selected>" . $list ['assunto'] . "</option>";
								}
							}
						}
						echo "</select>";
						echo "</div>";
						echo "</div>";

						echo form_hidden ( array (
								"id_produto_alterar" => $id
						) );





						?>
                    </div>
						<!-- <div class='form-group'>
<p>In your webapp:</p>

<div id="example">
  <p>Type math here: <span id="math-field"></span></p>
  <p>LaTeX of what you typed: <code id="latex"></code></p>

  <script>
  var mathFieldSpan = document.getElementById('math-field');
  var latexSpan = document.getElementById('latex');

  var MQ = MathQuill.getInterface(2); // for backcompat
  var mathField = MQ.MathField(mathFieldSpan, {
    spaceBehavesLikeTab: true, // configurable
    handlers: {
      edit: function() { // useful event handlers
        latexSpan.textContent = mathField.latex(); // simple API
      }
    }
  });
  </script>
</div>


</div> -->

					</div>
					<div class="tab-pane" id="bs-tabdrop-pill2">
			<div class="note note-info">
			Informações sugeridas para o caso de cadastramento de questões vinculadas a alguma prova.
		</div>
						<?php
echo "<div class='form-group'>";
echo form_label ( "Número Questão", "numero_questao", $attributes );
echo "<div class='col-sm-2'>";
echo form_input ( array (
		"name" => "numero_questao",
		"class" => "form-control",
		"id" => "numero_questao",
		"maxlength" => "255",
		"type" => "number",
		"value" => set_value ( "numero_questao", $dados_produto_edicao ['NUMERO_QUESTAO'] )
) );
echo "</div>";
echo "</div>";

if ($dados_produto_edicao ['APLICACAO'] == 1) {
	$apl_1 = "selected";
} else if ($dados_produto_edicao ['APLICACAO'] == 2) {
	$apl_2 = "selected";
}

echo form_error ( 'aplicacao', "<p class='alert alert-danger'>", "</p>" );
echo "<div class='form-group'>";
echo form_label ( "Aplicação", "aplicacao", $attributes );
echo "<div class='col-sm-2'>";
echo "<select name='aplicacao' id='aplicacao' class='form-control'>";
echo "<option value=1 " . $apl_1 . ">1a</option>";
echo "<option value=2 " . $apl_2 . ">2a</option>";
echo "</select>";
echo "</div>";
echo "</div>";


if ($dados_produto_edicao ['APLICACAO'] == 1) {
	$apl_1 = "selected";
} else if ($dados_produto_edicao ['APLICACAO'] == 2) {
	$apl_2 = "selected";
}

echo form_error ( 'habilidades', "<p class='alert alert-danger'>", "</p>" );
echo "<div class='form-group'>";
echo form_label ( "Habilidades", "habilidades", $attributes );
echo "<div class='col-sm-2'>";
echo "<select name='habilidades' id='habilidades' class='form-control'>";
echo "<option value=1 " . $apl_1 . ">1a</option>";
echo "<option value=2 " . $apl_2 . ">2a</option>";
echo "</select>";
echo "</div>";
echo "</div>";


if ($dados_produto_edicao ['DIA_PROVA'] == 1) {
	$dia_1 = "selected";
} else if ($dados_produto_edicao ['DIA_PROVA'] == 2) {
	$dia_2 = "selected";
}

echo form_error ( 'dia_prova', "<p class='alert alert-danger'>", "</p>" );
echo "<div class='form-group'>";
echo form_label ( "Dia", "dia_prova", $attributes );
echo "<div class='col-sm-2'>";
echo "<select name='dia_prova' id='dia_prova' class='form-control'>";
echo "<option value=1 " . $dia_1 . ">1a</option>";
echo "<option value=2 " . $dia_2 . ">2a</option>";
echo "</select>";
echo "</div>";
echo "</div>";


echo "<div class='form-group'>";
echo form_label ( "AnoASDFASD", "ano", $attributes );
echo "<div class='col-sm-2'>";
echo form_input ( array (
		"name" => "ano",
		"class" => "form-control",
		"id" => "ano",
		"maxlength" => "255",
		"type" => "number",
		"value" => set_value ( "ano", $dados_produto_edicao ['ANO_QUESTAO'] )
) );
// echo form_error("preco");
echo "</div>";
echo "</div>";
?>



					</div>

				</div>

			</div>

		</div>















</div>








	<div class="panel-footer text-center">
<?php
echo form_button ( array (
		"class" => "btn btn-primary",
		"content" => "Salvar",
		"type" => "submit"
) );

echo form_close ();

?>
</div>

<?php
$upload = site_url('questoes/upload');
$js = <<<JS
init.push(function() {
    var questao = $('#nome');
    var comando = $('#comando');
    var editorCfg = {
        modules: {
            formula: true,
            toolbar: [
                [{ 'font': [] }],
                [{ 'size': ['small', false, 'large', 'huge'] }],

                ['bold', 'italic', 'underline', 'strike'],

                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],

                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],

                ['formula', 'image'],

                ['clean']
            ],
        },
        theme: 'snow'
    };
    var editorQuestao = new Quill('#editor-questao', editorCfg);
    var editorComando = new Quill('#editor-comando', editorCfg);

    // https://github.com/quilljs/quill/issues/1089
    function selectLocalImage() {
        var quill = this.quill;
        var input = $('<input type="file">');
        input.click();

        input.change(function() {
            var file = input[0].files[0];

            if (/^image\//.test(file.type)) {
                saveToServer(file, quill);
            } else {
                alert('Apenas imagem é válido.');
            }
        });
    }

    function saveToServer(file, quill) {
        var fd = new FormData();
        fd.append('image', file);
        //
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '$upload');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var url = JSON.parse(xhr.responseText).url;
                insertToEditor(url, quill);
            }
        };
        xhr.send(fd);
    }

    function insertToEditor(url, quill) {
        var range = quill.getSelection();
        quill.insertEmbed(range.index, 'image', url);
    }

    editorQuestao.on('text-change', function() {
        var html = editorQuestao.root.innerHTML;
        questao.val(html);
    });

    editorComando.on('text-change', function() {
        var html = editorComando.root.innerHTML;
        comando.val(html);
    });

    editorQuestao.getModule('toolbar').addHandler('image', selectLocalImage);
    editorComando.getModule('toolbar').addHandler('image', selectLocalImage);
});
JS;
?>
<script type="text/javascript"><?= $js ?></script>
