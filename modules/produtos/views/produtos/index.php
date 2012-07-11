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


<? for ($a; $a < $qt_pg; $a++): ?>
    <
<? endfor; ?>



<script type="text/javascript">
    $(document).ready(function(){
        
        
        
        $('#search-btn').toggle(function(){
            $('#search-div').slideDown('fast');
        },
        function(){
            $('#search-div').slideUp('fast');
        });
        
    });
</script>

