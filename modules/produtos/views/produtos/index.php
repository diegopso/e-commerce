<div class="pull-left">
    <ul class="breadcrumb">
        <li>
            <a href="~/">My store</a> <span class="divider">/</span>
        </li>
        <li class="active">Produtos</li>
    </ul>
</div>

<div class="pull-right">
    <button class="btn" id="search-btn">Pesquisar</button>
    <button class="btn btn-primary">Adicionar</button>
</div>

<div class="clearfix"></div>

<div id="search-div" style="display: none">
    Busca <br />
    <div class="btn-group pull-left">
        <button class="btn dropdown-toggle" data-toggle="dropdown">
            Action 
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" style="">
            <li><a href="#">Action</a></li>
        </ul>
    </div>

    <input type="text" placeholder="Digite sua busca" class="pull-left"/>

    <button class="btn" class="pull-left">Buscar</button>

</div>

<div style="clear: both"></div>
<div class="data">
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
</div>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('#search-btn').toggle(function(){
            $('#search-div').slideDown('fast');
        },
        function(){
            $('#search-div').slideUp('fast');
        });
        
        $('.pagination-btn').click(function(){
            $.ajax({
                url: $(this).attr('href'),
                success: function(data){
                    var tbody = $('.table > tbody');
                    tbody.empty();
                    
                }
            });
        });
    });
</script>

