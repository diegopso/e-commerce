<form method="post" action="">
    <label>
        Título
        <?= Form::input('Title', $model->Title) ?>
    </label>
    <label>
        Conteúdo
        <?= Form::textarea('Content', $model->Content) ?>
    </label>
    <input type="submit" value="Salvar" />
</form>