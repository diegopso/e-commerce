<form method="POST" action="~/produtos/cadastrar">
    <label>
        Nome<br/>
        <input type="text" name="nome" value="<?= $model->nome ?>"/>
    </label>
    <br />
    <label>
        Quantidade<br />
        <input type="text" name="quantidade" value="<?= $model->quantidade ?>" />
    </label>
    <br />
    <input type="submit" value="Salvar" />
    <input type="hidden" name="id" value="<?= $model->id ?>" />
</form>