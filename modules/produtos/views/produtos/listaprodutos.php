<table class="table table-striped">
        <thead>
        <th>Nome</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th class="span2">Ações</th>
        </thead>
        <tbody>
            <? foreach ($model as $produto): ?>
                <tr>
                    <td><?= $produto->nome ?></td>
                    <td><?= $produto->preco ?></td>
                    <td><?= $produto->quantidade ?></td>
                    <td>
                        <a href="#" class="btn tip" title="Editar"><i class="icon-pencil"></i></a>
                        <a href="#" class="btn tip" title="Visualizar"><i class="icon-eye-open"></i></a>
                        <a href="#" class="btn tip" title="Excluir"><i class="icon-trash"></i></a>
                    </td>
                </tr>
            <? endforeach; ?>
        </tbody>
        <tfoot>
        <th>Nome</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th class="span2">Ações</th>
        </tfoot>
    </table>

    <a href="~/produtos?q=<?= $query ?>&pg=0&r=json" class="btn btn-mini pagination-btn tip" id="0" title="Primeira"><i class="icon-fast-backward"></i></a>

    <? for ($a = $pg - 3 < 1 ? 1 : $pg - 3; $a <= $pg + 3 && $a <= $qt_pg; $a++): ?>
        <a href="~/produtos?q=<?= $query ?>&pg=<?= $a ?>&r=json" class="btn btn-mini pagination-btn <?= $a == $pg + 1 ? 'active' : '' ?>" id="<?= $pg ?>">
            <?= $a ?>
        </a>
    <? endfor; ?>

    <a href="~/produtos?q=<?= $query ?>&pg=<?= $qt_pg - 1 ?>&r=json" class="btn btn-mini pagination-btn tip" title="Última"><i class="icon-forward"></i></a>