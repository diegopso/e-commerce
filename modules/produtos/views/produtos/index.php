<div class="pull-left">
    <ul class="breadcrumb">
        <li>
            <a href="<?= site_url ?>">My store</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="<?= site_url ?>produtos">Produtos</a>
        </li>
    </ul>
</div>

<div class="pull-right">
    <button class="btn" data-toggle="slide" data-value="#search-div"><i class="icon-chevron-down"></i> Pesquisar</button>
    <a href="<?= site_url ?>produtos/cadastrar/" class="btn btn-primary"><i class="icon-plus icon-white"></i> Adicionar</a>
</div>

<div class="clearfix"></div>

<form id="search-div" style="display: none" class="well">
    <h3>Buscar</h3><br />
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
</form>

<div id="desfazer" class="alert alert-block" style="display: none">
    <center>
        <strong>
            <a class="close" data-dismiss="alert" href="#">×</a>
            O produto foi excluído. 
            <a class="btn btn-warning" href="javascript:void(0);">Desfazer</a>
        </strong>
    </center>
</div>

<div style="clear: both"></div>
<div class="row">
    <div class="data span<?= marketing ? 10 : 12 ?>">
        <?php
            include(modpath . 'produtos/views/_snippet/listaprodutos.php');
        ?>
    </div>
    
    <?php if(marketing): ?>
    <br />
    <div class="span2">
        <a href="javascript:void(0);" class="thumbnail">
            <img src="http://placehold.it/125x125" />
        </a>
        <a href="javascript:void(0);" class="thumbnail">
            <img src="http://placehold.it/125x125" />
        </a>
        <a href="javascript:void(0);" class="thumbnail">
            <img src="http://placehold.it/125x125" />
        </a>
        <a href="javascript:void(0);" class="thumbnail">
            <img src="http://placehold.it/125x125" />
        </a>
    </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    var divAlert = null;
    $(document).ready(function(){
        $('.pagination-btn').click(loadData);
        
        $('#search-submit').click(function (e){
            e.preventDefault();
            requestData('<?= site_url ?>produtos?q=' + $('#search-text').val() +'&r=html');
        });
        
        divAlert = $('#desfazer');
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
    
    removerProduto = function(element){
        var self = $(element);
        var tr = self.parent().parent();
        tr.find('.loading').show();
        $.ajax({
            url: self.attr('href'),
            success: function(data){
                requestData('<?= site_url ?>produtos?q=' + $('#search-text').val() +'&r=html');
                divAlert.find('a').unbind('click').click(function(e){
                    e.preventDefault();
                    $.ajax({
                        url: '<?= site_url ?>produtos/desfazerexclusao/' + data.d.model.id,
                        success: function(){
                            divAlert.slideUp('fast');
                            requestData('<?= site_url ?>produtos?q=' + $('#search-text').val() +'&r=html');
                        }
                    });
                });
                divAlert.slideDown('fast');
                setTimeout(function(){
                    divAlert.slideUp('fast');
                }, 2000);
            }
        });
    }
        
</script>

