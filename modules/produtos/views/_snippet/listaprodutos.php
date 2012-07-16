<table class="table table-striped">
<thead>
    <tr>
        <th>Nome</th>
        <th class="span2">Preço (<?=default_currency?>)</th>
        <th class="span1">Estoque</th>
        <th class="span2">Ações</th>
    </tr>
</thead>
<tbody>
    <?php if($count == 0): ?>
        <tr>
            <td colspan="4"><center><b>Nenhum produto a ser exibido</b></center></td>
        </tr>
    <?php endif; ?>
    <? foreach ($model as $produto): ?>
        <tr>
            <td><?= $produto->nome ?> <img class="loading" src="<?= site_url ?>media/img/loading.gif" style="display: none;" /></td>
            <td><?= number_format($produto->preco, 2, decimal_separator, thousands_separator); ?></td>
            <td><?= $produto->quantidade ?></td>
            <td>
                <a href="~/produtos/cadastrar/<?= $produto->id ?>"  class="btn tip" title="Editar"><i class="icon-pencil"></i></a>
                <a href="javascript:void(0);" class="btn tip" title="Visualizar"><i class="icon-eye-open"></i></a>
                <a href="produtos/excluir/<?= $produto->id ?>" onclick="removerProduto(this); return false;" class="btn tip delete" title="Excluir"><i class="icon-trash"></i></a>
            </td>
        </tr>
    <? endforeach; ?>
</tbody>
<tfoot>
<th>Nome</th>
<th>Preço (<?=default_currency?>)</th>
<th>Estoque</th>
<th class="span2">Ações</th>
</tfoot>
</table>
<?php if($qt_pg > 1): ?>
<div class="pull-right pagination">
    <ul>
    
    <?php if ($pg > 0): ?>
        <li><a href="produtos?q=<?= $query ?>&pg=0&r=html" class="pagination-btn tip" title="Primeira">«</a></li>
    <?php endif; ?>
        
    <?php for ($a = $pg - 1 < 1 ? 1 : $pg - 1; $a <= $pg + 3 && $a <= $qt_pg; $a++): ?>
        <li class="<?= $a == $pg + 1 ? 'active' : '' ?>">
            <a href="produtos?q=<?= $query ?>&pg=<?= $a - 1 ?>&r=html" class="pagination-btn tip" title="Página <?= $a ?>">
                <?= $a ?>
            </a>
        </li>
    <? endfor; ?>
        
    <?php if ($pg < $qt_pg - 1): ?>
        <li><a href="produtos?q=<?= $query ?>&pg=<?= $qt_pg - 1 ?>&r=html" class="pagination-btn tip" title="Última">»</a></li>
    <?php endif; ?>
    </ul>
</div>
<div class="clearfix"></div>
<?php endif; ?>