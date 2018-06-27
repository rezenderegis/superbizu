<?php

$eNovo = empty($item['ID_ITEM']);
$action = $eNovo ? "questoes/cadastrarItem/{$item['ID_QUESTAO']}" : "questoes/alterarItem/{$item['ID_ITEM']}";
$id = $eNovo ? 'cadastrar-item' : 'alterar-item';
?>

<?= form_open($action, ['id' => $id, 'data-save' => (int) isset($item['status'])]) ?>
    <div class="row">
        <div class="form-group col-sm-9">
            <label>Descrição</label>
            <input id="descricao" type="hidden" name="DESCRICAO" class="form-control" value="<?= htmlentities($item['DESCRICAO']) ?>"></input>
            <div id="editor-descricao"><?= $item['DESCRICAO'] ?></div>
        </div>

        <div class="form-group col-sm-2">
            <label>Letra</label>
            <?= form_dropdown('LETRA_ITEM', $letras, $item['LETRA_ITEM'], 'class="form-control"') ?>
            <div></div>
        </div>

        <label>&nbsp;</label>
        <div class="form-group">
            <button class="btn btn-primary">Salvar</button>
        </div>
    </div>
<?= form_close() ?>
