<link rel="stylesheet" type="text/css" href="~/media/css/bootstrap.css">
<button class="btn"><i class="icon-user"></i>Ola</button>
<table>
    <thead>
        <tr>
            <th>Título<th>
            <th>Data</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if(is_array($model->Data)): ?>
            <?php foreach($model->Data as $post): ?>
            <tr>
                <td><?= $post->Title ?></td>
                <td><?= date('d/m/Y H:i', $post->Date) ?></td>
                <td>
                    <a href="~/post/edit/<?= $post->Id ?>">[editar]</a>
                    <a href="~/post/delete/<?= $post->Id ?>">[deletar]</a>
                </td>
            </tr>
            <?php endforeach ?>
        <?php else: ?>
        <tr>
            <td colspan="4">Nenhum post encontrado!</td>
        </tr>
        <?php endif ?>
    </tbody>
</table>
<div class="less-test">
</div>