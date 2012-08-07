<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th class="span2">Categoria Pai</th>
            <th class="span2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if($count === 0): ?>
            <tr>
                <td colspan="4"><center><b>Nenhuma categoria a ser exibida</b></center></td>
            </tr>
        <?php endif; ?>
        <?php foreach ($model as $categoria): ?>
            <tr>
                <td><?= $categoria->nome ?> <img class="loading" src="<?= site_url ?>media/img/loading.gif" style="display: none;" /></td>
                <td><?= $categoria->nome_categoria_pai ?></td>
                <td>
                    <a href="<?= site_url ?>produtos/cadastrar/<?= $produto->id ?>"  class="btn tip" title="Editar"><i class="icon-pencil"></i></a>
                    <a href="<?= site_url ?>produtos/excluir/<?= $produto->id ?>" onclick="removerProduto(this); return false;" class="btn tip delete" title="Excluir"><i class="icon-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Nome</th>
            <th class="span2">Categoria Pai</th>
            <th class="span2">Ações</th>
        </tr>
    </tfoot>
</table>
<?php if($qt_pg > 1): ?>
<div class="pull-right pagination">
    <ul>
    
    <?php if ($pg > 0): ?>
        <li><a href="<?= site_url ?>categorias?q=<?= $query ?>&pg=0&r=html" class="pagination-btn tip" title="Primeira">«</a></li>
    <?php endif; ?>
        
    <?php for ($a = $pg - 1 < 1 ? 1 : $pg - 1; $a <= $pg + 3 && $a <= $qt_pg; $a++): ?>
        <li class="<?= $a == $pg + 1 ? 'active' : '' ?>">
            <a href="<?= site_url ?>categorias?q=<?= $query ?>&pg=<?= $a - 1 ?>&r=html" class="pagination-btn tip" title="Página <?= $a ?>">
                <?= $a ?>
            </a>
        </li>
    <?php endfor; ?>
        
    <?php if ($pg < $qt_pg - 1): ?>
        <li><a href="<?= site_url ?>categorias?q=<?= $query ?>&pg=<?= $qt_pg - 1 ?>&r=html" class="pagination-btn tip" title="Última">»</a></li>
    <?php endif; ?>
    </ul>
</div>
<div class="clearfix"></div>
<?php endif; ?>