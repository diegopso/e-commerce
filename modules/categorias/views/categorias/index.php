<div class="pull-left">
    <ul class="breadcrumb">
        <li>
            <a href="<?= site_url ?>">My store</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="<?= site_url ?>categorias">Categorias</a>
        </li>
    </ul>
</div>

<div class="pull-right">
    <button class="btn" data-toggle="slide" data-value="#search-div"><i class="icon-chevron-down"></i> Pesquisar</button>
    <a href="#cadastrar" data-toggle="modal" class="btn btn-primary"><i class="icon-plus icon-white"></i> Adicionar</a>
</div>

<div class="clearfix"></div>

<form id="search-div" style="display: none" class="well">
    <h3>Buscar</h3><br />
    <div class="input-append pull-left">
        <input class="pull-left" id="search-text" type="text"  placeholder="Digite sua busca" />
        <button class="btn btn-primary" type="button" id="search-submit"><i class="icon-search icon-white"></i> Buscar</button>
    </div>
    <div class="clearfix"></div>
</form>

<div id="desfazer" class="alert alert-block" style="display: none">
    <center>
        <strong>
            A categoria foi excluída.
            <a class="btn btn-warning" href="javascript:void(0);">Desfazer</a>
        </strong>
    </center>
</div>

<div style="clear: both"></div>
<div class="row">
    <div class="data span<?= marketing ? 10 : 12 ?>">
        <?php
        include(modpath . 'categorias/views/_snippet/listacategorias.php');
        ?>
    </div>

    <?php if (marketing): ?>
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
<form id="form-cadastrar-categoria" class="form-inline" action="<?= site_url ?>categorias/cadastrar" method="POST">
    <div class="modal hide" id="cadastrar">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Cadastrar Categoria</h3>
        </div>
        <div class="modal-body">

            <label>
                Nome<br />
                <input id="input-nome" name="nome" type="text" value="" placeholder="Digite um Nome para a Categoria" />
            </label>
            <label class="pull-right">
                Categoria Pai<br />
                <select id="select-categoria-pai" name="id_categoria_pai" data-placeholder="Não Adicionar Categoria Pai">
                    <option value="0">Não Adicionar Categoria Pai</option>
                    <?php foreach ($model as $categoria): ?>
                        <option value="<?= $categoria->id ?>"><?= $categoria->nome ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <div class="clearfix"></div>
            <input id="input-id" name="id" type="hidden" value="0" />
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Cancelar</a>
            <input type="submit" value="Salvar" class="btn btn-primary" />
        </div>
    </div>
</form>
<script type="text/javascript" src="~/media/js/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="~/media/js/chosen/chosen.css"></link>
<script type="text/javascript" src="~/media/js/jquery.form.js"></script>
<script type="text/javascript">
    var divAlert = null;
    $(document).ready(function(){
        $('.pagination-btn').click(loadData);
        
        $("#select-categoria-pai").chosen({
            no_results_text: "Nenhuma Categoria Encontrada.",
            allow_single_deselect: true
        });
        
        $('#form-cadastrar-categoria').ajaxForm({
            success: function(data){
                console.log(data);
            }
        }); 
        
        $('#search-submit').click(function (e){
            e.preventDefault();
            requestData('<?= site_url ?>categorias?q=' + $('#search-text').val() +'&r=html');
        });
        
        $('#form-cadastrar-categoria a[data-dismiss], #form-cadastrar-categoria button[data-dismiss]').click(function(e){
            var form = $('#form-cadastrar-categoria').clear();
            form.find('input[type="hidden"]').val(0);
            form.find('select').val(0).trigger("liszt:updated"); 
        });
        
        divAlert = $('#desfazer');
    });
    
    function loadData(e){
        e.preventDefault();
        $('.tooltip').remove();
        requestData($(this).attr('href'));
    }
    
    function requestData(url) {
        $.ajax({
            url: url,
            success: function(data){
                $('.data').empty().append(data);
                $('.pagination-btn').click(loadData);
                $(".data .tip").tooltip();
            }
        });
    }
    
    removerCategoria = function(element){
        var self = $(element);
        var tr = self.parent().parent();
        tr.find('.loading').show();
        $.ajax({
            url: self.attr('href'),
            success: function(data){
                requestData('<?= site_url ?>categorias?q=' + $('#search-text').val() +'&r=html');
                divAlert.find('a').unbind('click').click(function(e){
                    e.preventDefault();
                    $.ajax({
                        url: '<?= site_url ?>categorias/desfazerexclusao/' + data.d.model.id,
                        success: function(){
                            divAlert.slideUp('fast');
                            requestData('<?= site_url ?>categorias?q=' + $('#search-text').val() +'&r=html');
                        }
                    });
                });
                divAlert.slideDown('fast');
                setTimeout(function(){
                    divAlert.slideUp('fast');
                }, 2000);
            },
            complete: function(){
                $('.tooltip').remove();
            }
        });
    }
    
    function editarCategoria(c){
        $('#input-nome').val(c.nome);
        $('#input-id').val(c.id);
        $("#select-categoria-pai").val(2).trigger("liszt:updated");
    }   
</script>

