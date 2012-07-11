<div class="pull-left">
    <ul class="breadcrumb">
        <li>
            <a href="~/">My store</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="~/produtos">Produtos</a>
        </li>
    </ul>
</div>

<div class="pull-right">
    <button class="btn" id="search-btn"><i class="icon-chevron-down"></i> Pesquisar</button>
    <button class="btn btn-primary">Adicionar</button>
</div>

<div class="clearfix"></div>

<div id="search-div" style="display: none" class="well">
    <h3>Busca</h3><br />
    <div class="btn-group pull-left">
        <button class="btn dropdown-toggle span3" data-toggle="dropdown">
            <span class="pull-left">Categorias</span>
            <span class="caret pull-right"></span>
        </button>
        <ul class="dropdown-menu span3">
            <li><a href="#">Selecione uma categoria</a></li>
        </ul>
    </div>
    <div class="input-append margin1 pull-left">
        <input class="pull-left" id="search-text" type="text"  placeholder="Digite sua busca" />
        <button class="btn btn-primary" type="button" id="search-submit"><i class="icon-search icon-white"></i> Buscar</button>
    </div>
    <div class="clearfix"></div>
</div>

<div style="clear: both"></div>
<div class="data">
    <?php
        include('listaprodutos.php');
    ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('#search-btn').toggle(function(){
            $('#search-div').slideDown('fast');
            $(this).find('i').removeClass('icon-chevron-down').addClass('icon-chevron-up');
        },
        function(){
            $('#search-div').slideUp('fast');
            $(this).find('i').removeClass('icon-chevron-up').addClass('icon-chevron-down');
        });
        
        $('.pagination-btn').click(loadData);
        
        $('#search-submit').click(function (e){
            e.preventDefault();
            requestData('produtos?q=' + $('#search-text').val() +'&r=html');
        });
        
        $('.delete').click(function(e){
            e.preventDefault();
            
        });
    });
    
    function loadData(e){
        e.preventDefault();
        requestData($(this).attr('href'));
    }
    
    function requestData(url) {
        $.ajax({
            url: url,
            success: function(data){
                $('.data').empty().append(data);
                $('.pagination-btn').click(loadData);
            }
        });
    }
    
    
        
</script>

