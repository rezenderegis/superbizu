<?= form_open('questoes/alterarItem/' . $item['ID_ITEM'], [
    'id' => 'alterar-item'
]) ?>
    <div class="row">
        <div class="form-group col-sm-2">
            <label>Item</label>
            <?= form_dropdown('LETRA_ITEM', $itens, $item['LETRA_ITEM'], 'class="form-control"') ?>
            <div></div>
        </div>

        <div class="form-group col-sm-8">
            <label>Descrição</label>
            <input name="DESCRICAO" class="form-control" value="<?= $item['DESCRICAO'] ?>"></input>
            <div></div>
        </div>

        <label>&nbsp;</label>
        <div class="form-group">
            <button class="btn btn-primary">Salvar</button>
        </div>
    </div>
<?= form_close() ?>
