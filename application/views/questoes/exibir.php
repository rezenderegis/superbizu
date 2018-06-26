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


<div class="panel panel-default">
    <div class="panel panel-heading">Itens</div>
    <div class="panel-body">
        <?= form_open('questoes/cadastrarItem/' . $questao['ID_QUESTAO'], [
            'id' => 'cadastrar-item'
        ]) ?>

            <input type="hidden" name="id_questao" value="<?= $questao['ID_QUESTAO'] ?>">

            <div class="row">
                <div class="form-group col-sm-2">
                    <label>Item</label>
                    <select name="letra_item" class="form-control">
                        <?php foreach(['' => 'Selecione', 'A','B','C','D','E'] as $item): ?>
                            <option value="<?= $item ?>"><?= $item ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div></div>
                </div>

                <div class="form-group col-sm-8">
                    <label>Descrição</label>
                    <input name="descricao" class="form-control"></input>
                    <div></div>
                </div>

                <label>&nbsp;</label>
                <div class="form-group">
                    <button class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        <?= form_close() ?>

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
$js = <<<JS
init.push(function() {
    var formCadastrar = $('#cadastrar-item');
    var formAlterar = '#alterar-item';
    var mod = $('#modal-alterar-item');
    var btnExcluir = $('<a class="excluir" href="$excluir" title="Excluir"><i class="fas fa-trash"></i></a>');
    var btnAlterar = $('<a class="alterar" href="$alterar" title="Alterar"><i class="fas fa-pen-alt"></i></a>');
    var tb = $('#itens').DataTable({
        "dom": "t",
        "bSort": false,
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

    var editorQuestao = new Quill('#editor-questao', {
      readOnly: true
    });

    var editorComando = new Quill('#editor-comando', {
      readOnly: true
    });

    function atualizar() {
        tb.ajax.reload();
    }

    function cadastrar(e) {
        e.preventDefault();
        $.post('$cadastrar', formCadastrar.serialize(), function(data) {
            if (data.status) {
                atualizar();
                formCadastrar.get(0).reset();
            }
        },'json');
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

    formCadastrar.on('submit', cadastrar);
    $(document).on('submit', formAlterar, alterar);
    $(document).on('click', '.alterar', getItem);
    $(document).on('click', '.excluir', excluir);
});
JS;
?>

<script type="text/javascript"><?= $js ?></script>
