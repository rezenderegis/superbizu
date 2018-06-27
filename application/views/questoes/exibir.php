<?php

/* URLs */
$listar = site_url(['questoes', 'itens', $questao['ID_QUESTAO']]);
$cadastrar = site_url(['questoes', 'cadastrarItem', $questao['ID_QUESTAO']]);
$excluir = site_url('questoes/excluirItem');
$alterar = site_url('questoes/alterarItem');
$listarQuestao = site_url('questoes');
$alterarQuestao = site_url(['questoes', 'formulario', $questao['ID_QUESTAO']]);
?>

<p>
    <a href="<?= $alterarQuestao ?>" class="btn btn-primary">Alterar</a>
    <a href="<?= $listarQuestao ?>" class="btn btn-link">Questões</a>
</p>

<div class="panel panel-default">
    <div class="panel-body">
        <h4>Questão</h4>
        <div id="editor-questao"><?= $questao['DESCRICAO_QUESTAO'] ?></div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <h4>Comando</h4>
        <div id="editor-comando"><?= $questao['COMANDO_QUESTAO'] ?></div>
    </div>
</div>

<table class="table table-bordered table-striped hide">
   <tbody>
       <?php foreach($questao as $campo => $v): ?>
           <?php if (!in_array($campo, ['DESCRICAO_QUESTAO', 'COMANDO_QUESTAO'])) continue; ?>
           <tr>
              <th scope="row"><?= $model::getRotulos($campo) ?></th>
              <td><?= $v ?></td>
           </tr>
       <?php endforeach; ?>
   </tbody>
</table>

<div id="panel-itens" class="panel panel-default">
    <div class="panel panel-heading">Itens</div>
    <div class="panel-body">
        <div class="form"></div>
        <table id="itens" class="table table-bordered table-striped table-primary">
            <thead>
                <tr>
                    <th>Letra</th>
                    <th>Descrição</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="modal-alterar-item" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Item</h4>
            </div>
            <div class="modal-body"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
$listar = site_url(['questoes', 'itens', $questao['ID_QUESTAO']]);
$cadastrar = site_url(['questoes', 'cadastrarItem', $questao['ID_QUESTAO']]);
$excluir = site_url('questoes/excluirItem');
$alterar = site_url('questoes/alterarItem');
$upload = site_url('questoes/upload');
$js = <<<JS
init.push(function() {
    var panelItens = $('#panel-itens');
    var descricao = $('#descricao');
    var formCadastrar = '#cadastrar-item';
    var formAlterar = '#alterar-item';
    var mod = $('#modal-alterar-item');
    var btnExcluir = $('<a class="excluir" href="$excluir" title="Excluir"><i class="fas fa-trash"></i></a>');
    var btnAlterar = $('<a class="alterar" href="$alterar" title="Alterar"><i class="fas fa-pen-alt"></i></a>');
    var editorCfg = {
        modules: {
            formula: true,
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],

                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],

                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],

                ['formula','image'],

                ['clean']
            ],
        },
        theme: 'snow'
    };
    var tb = $('#itens').DataTable({
        "dom": "t",
        "bSort": false,
        "iDisplayLength": Infinity,
        "oLanguage": {
            "sEmptyTable": "Nenhum item cadastrado."
        },
        "ajax": {
            "url": "$listar",
            "dataSrc": ""
        },
        "columns": [
            {"data": "LETRA_ITEM"},
            {"data": "DESCRICAO"},
            {
                "render": function(data, type, row) {
                    var alterar = btnAlterar.clone().attr('data-id', row.ID_ITEM);
                    var excluir = btnExcluir.clone().attr('data-id', row.ID_ITEM);
                    return alterar.prop('outerHTML') + ' ' + excluir.prop('outerHTML');
                },
                "createdCell":  function (td, cellData, rowData, row, col) {
                   $(td).attr('class', 'text-center');
                }
            },
        ]
    });

    new Quill('#editor-questao', {readOnly: true});
    new Quill('#editor-comando', {readOnly: true});

    function atualizar() {
        tb.ajax.reload();
    }

    function initFormCadastrar() {
        var descricao = $(formCadastrar).find('#descricao');
        var editorDescricao = new Quill(formCadastrar + ' #editor-descricao', editorCfg);

        editorDescricao.getModule('toolbar').addHandler('image', selectLocalImage);
        editorDescricao.on('text-change', function() {
            var html = editorDescricao.root.innerHTML;
            descricao.val(html);
        });
    };

    function cadastrar(e) {
        e.preventDefault();
        var form = $(formCadastrar);
        $.post('$cadastrar', form.serialize(), function(data) {
            panelItens.find('.form').html(data);
            form = $(formCadastrar);
            if (form.data('save')) {
                atualizar();
            }
            initFormCadastrar();
        });
    }

    function alterar(e) {
        e.preventDefault();
        var form = $(formAlterar);
        $.post(form.attr('action'), form.serialize(), function(data) {
            mod.modal('hide');
            atualizar();
        });
    }

    function getItem(e) {
        e.preventDefault();
        var url = this.href + '/' + $(this).data('id');
        $.get(url, function(data) {
            mod.find('.modal-body').html(data);
            var descricao = $(formAlterar).find('#descricao');
            var editorDescricao = new Quill(formAlterar + ' #editor-descricao', editorCfg);

            editorDescricao.getModule('toolbar').addHandler('image', selectLocalImage);
            editorDescricao.on('text-change', function() {
                var html = editorDescricao.root.innerHTML;
                descricao.val(html);
            });

            mod.modal('show');
        });
    }

    function excluir(e) {
        e.preventDefault();
        if (confirm('Deseja realmente excluir este item?')) {
            $.post(this.href, {
                id_item: $(this).data('id')
            }, atualizar);
        }
    }

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
        var xhr = new XMLHttpRequest();

        fd.append('image', file);
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

    $(document).on('submit', formCadastrar, cadastrar);
    $(document).on('submit', formAlterar, alterar);
    $(document).on('click', '.alterar', getItem);
    $(document).on('click', '.excluir', excluir);

    $.get('$cadastrar', function(data) {
        panelItens.find('.form').html(data);
        initFormCadastrar();
    });
});
JS;
?>

<script type="text/javascript"><?= $js ?></script>
