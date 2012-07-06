<form method="POST" action="~/produtos/cadastrar">
    <label>
        Nome<br/>
        <input type="text" name="nome" value="<?= $model->nome ?>"/>
    </label>
    <br />
    <label>
        Quantidade<br />
        <input type="text" name="quantidade" value="<?= $model->quantidaade ?>"
    </label>
    <br />
    <input type="submit" value="Salvar" />
</form>