<div class="pull-left">
    <ul class="breadcrumb">
        <li>
            <a href="~/">My store</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="~/produtos">Produtos</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="~/produtos/cadastrar">Cadastrar</a>
        </li>
    </ul>
</div>

<div class="clearfix"></div>

<div class="row">

    <div class="span<?= marketing ? 10 : 12 ?>">
        <form id="form-produto" class="form-horizontal" action="<?= site_url . 'Produtos/Cadastrar' ?>" method="POST">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#informacoes" data-toggle="tab">Informações</a></li>
                <li class=""><a href="#descricao" data-toggle="tab">Descrição</a></li>
                <li class=""><a href="#dimensoes" data-toggle="tab">Dimensões</a></li>
                <li class=""><a href="#imagens" data-toggle="tab">Imagens</a></li>
            </ul>
            <div class="row">
                <div id="productTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="informacoes">
                        <br />
                        <div class="span10">
                            <div class="control-group">
                                <label class="control-label" for="nome">Nome <span class="help-required">*</span></label>
                                <div class="controls">
                                    <input type="text" class="span8" id="nome" name="nome" value="<?= $model->nome ?>"/>
                                    <span class="help-block">Informe o nome do produto</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="modelo">Modelo</label>
                                <div class="controls">
                                    <input type="text" class="span8" id="modelo" name="modelo" value="<?= $model->modelo ?>"/>
                                    <span class="help-block">Informe o modelo do produto</span>
                                </div>
                            </div>
                            <div class="pull-left">
                                <div class="control-group">
                                    <label class="control-label" for="quantidade">Quantidade<span class="help-required">*</span></label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="quantidade" name="quantidade" value="<?= $model->quantidade ?>"/>
                                        <span class="help-block">Informe a quantidade em estoque</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <div class="control-group">
                                    <label class="control-label" for="preco">Preço<span class="help-required">*</span></label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="preco" name="preco" value="<?= $model->preco ?>"/>
                                        <span class="help-block">Informe o preço de venda</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="descricao">
                        <div>
                            <div class="btn-toolbar">
                                <div class="btn-group pull-left">
                                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                                        <span class="editor-selected-style">Categorias</span>
                                        <span class="caret"></span>
                                        <input id="categoria" name="categoria" type="hidden" value="" />
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)" data-value="1">Selecione uma Categoria</a></li>
                                    </ul>
                                    <button class="btn btn-info tip" onclick="return false;" title="Adicionar">
                                        <i class="icon-plus"></i>
                                    </button>
                                </div>
                                <div class="control-group">
                                    <label class="pull-right">
                                        Palavras-Chave: <input type="text" vlaue="" id="palavras-chave" name="palavras-chave" placeholder="Separadas por ponto e vírgula (;)" />
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?= Import::get_contents('editor', '_snippet'); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="dimensoes">
                        <br />
                        <div class="span10">
                            <div class="pull-left">
                                <div class="control-group">
                                    <label class="control-label" for="altura">Altura<br /><span class="label label-warning">P/ FRETE</span></label>
                                    <div class="controls">
                                        <input type="text" id="altura" class="span3" name="altura" value="<?= $model->altura ?>"/>
                                        <span class="help-block">Valor em metros</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="largura">Largura<br /><span class="label label-warning">P/ FRETE</span></label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="largura" name="largura" value="<?= $model->largura ?>"/>
                                        <span class="help-block">Valor em metros</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <div class="control-group">
                                    <label class="control-label" for="comprimento">Comprimento<br /><span class="label label-warning">P/ FRETE</span></label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="comprimento" name="comprimento" value="<?= $model->comprimento ?>"/>
                                        <span class="help-block">Valor em metros</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="peso">Peso<br /><span class="label label-warning">P/ FRETE</span></label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="peso" name="peso" value="<?= $model->peso ?>"/>
                                        <span class="help-block">Valor em quilos</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="imagens">
                        <? include(modpath . 'produtos/views/_snippet/enviarimagens.php'); ?>
                    </div>
                </div>
            </div>
            <hr />
            <div class="clearfix"></div>
            <div class="pull-right">
                <input type="submit" class="btn btn-primary" data-toggle="dont-redirect" value="Salvar" />
                <input type="submit" class="btn btn-info" value="Salvar e Sair" onclick="$('#redirect').val('1');" />
                <input id="redirect" name="redirecionar" type="hidden" value="" />
                <button class="btn">Cancelar</button>
            </div>

        </form>
    </div> <!-- /span10 ou span12 -->
    <?php if (marketing): ?>
        <div class="span2">
            <a href="javascript:void(0);" class="thumbnail">
                <img src="http://placehold.it/125x125" />
            </a>
        </div>
    <?php endif; ?>
</div>
<script type="text/javascript">
    var $nome = undefined;
    var $modelo = undefined;
    var $qt = undefined;
    var $preco = undefined;
    var $tags = undefined;
    var $categoria = undefined;
    var requireds = undefined;
    $(document).ready(function(){
        $nome = $('#nome').keyupValidation(/^[a-zA-Z0-9À-Ãà-ãÒ-Õò-õÈ-Êè-êÇçÌ-Îì-îÙ-Üù-ü\s\_\-\'\"\\\/\#]{1,256}$/);
        $modelo = $('#modelo').keyupValidation(/^[a-zA-Z0-9À-Ãà-ãÒ-Õò-õÈ-Êè-êÇçÌ-Îì-îÙ-Üù-ü\s\_\-\'\"\\\/\#]{0,256}$/);
        $qt = $('#quantidade').keyupValidation(/^[0-9]{1,11}$/);
        $preco = $('#preco').keyupValidation(/^[0-9]{1,9}(.[0-9]{0,2})?$/);
        $tags = $('#palavras-chave').keyupValidation(/^([a-zA-Z0-9\s\_\-\'\"\\\/À-Ãà-ãÒ-Õò-õÈ-Êè-êÇçÌ-Îì-îÙ-Üù-ü]{1,}(;)?(\s)?)*$/);
        //$categoria = $('#categoria');
        $altura = $('#altura').keyupValidation(/^[0-9]{0,9}(.)?[0-9]{0,2}$/);
        $largura = $('#largura').keyupValidation(/^[0-9]{0,9}(.)?[0-9]{0,2}$/);
        $comprimento = $('#comprimento').keyupValidation(/^[0-9]{0,9}(.)?[0-9]{0,2}$/);
        $peso = $('#peso').keyupValidation(/^[0-9]{0,9}(.)?[0-9]{0,2}$/);
        requireds = [$nome, $qt, $preco];
        
        $('#form-produto').submitValidation(requireds, 'seletor_modal');
    });
</script>