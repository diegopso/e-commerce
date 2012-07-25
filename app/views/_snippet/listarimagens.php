<table id="list-images" class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th class="span2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!count($model->arquivos)): ?>
            <tr class="empty-row">
                <td colspan="4"><center><b>Nenhum conteúdo a ser exibido</b></center></td>
            </tr>
        <?php else:
        foreach($model->arquivos as $a): ?>
            <tr>
                <td><?= $a->nome_original ?> <img class="loading" src="<?= site_url ?>media/img/loading.gif" style="display: none;" /></td>
                <td>
                    <a href="<?= site_url ?>Midia/ExcluirArquivo/<?=$a->id_arquivo?>/<?=$model->id?>" class="btn tip" onclick="removerImg(this); return false;" title="Excluir">
                        <i class="icon-trash"></i>
                    </a>
                    <a href="<?= site_url ?>uploads/<?= $a->caminho . $a->extensao ?>" target="_blank" class="btn tip" title="Visualizar">
                        <i class="icon-eye-open"></i>
                    </a>
                </td>
            </tr>
        <? endforeach;
        endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </tfoot>
</table>