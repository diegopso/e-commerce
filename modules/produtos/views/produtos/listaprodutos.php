<table class="table table-striped">
    <thead>
    <th>Nome</th>
    <th>Preço</th>
    <th>Quantidade</th>
    <th class="span2">Ações</th>
</thead>
<tbody>
    <?php if($count == 0): ?>
        <tr>
            <td colspan="4"><center><b>Nenhum produto a ser exibido</b></center></td>
        </tr>
    <?php endif; ?>
    <? foreach ($model as $produto): ?>
        <tr>
            <td><?= $produto->nome ?></td>
            <td><?= $produto->preco ?></td>
            <td><?= $produto->quantidade ?></td>
            <td>
                <a href="#" class="btn tip" title="Editar"><i class="icon-pencil"></i></a>
                <a href="#" class="btn tip" title="Visualizar"><i class="icon-eye-open"></i></a>
                <a href="produtos/excluir/<?= $produto->id ?>" class="btn tip delete" title="Excluir"><i class="icon-trash"></i></a>
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

<div class="pull-right">
    
    <?php if ($pg > 0): ?>
        <a href="produtos?q=<?= $query ?>&pg=0&r=html" class="btn btn-mini pagination-btn tip" title="Primeira"><i class="icon-fast-backward"></i></a>
    <?php endif; ?>
        
    <?php for ($a = $pg - 3 < 1 ? 1 : $pg - 3; $a <= $pg + 3 && $a <= $qt_pg; $a++): ?>
        <a href="produtos?q=<?= $query ?>&pg=<?= $a - 1 ?>&r=html" class="btn btn-mini pagination-btn <?= $a == $pg + 1 ? 'active' : '' ?>" id="<?= $pg ?>">
            <?= $a ?>
        </a>
    <? endfor; ?>
        
    <?php if ($pg < $qt_pg - 1): ?>
        <a href="produtos?q=<?= $query ?>&pg=<?= $qt_pg - 1 ?>&r=html" class="btn btn-mini pagination-btn tip" title="Última"><i class="icon-forward"></i></a>
    <?php endif; ?>
    <div class="clearfix"></div>
</div>
