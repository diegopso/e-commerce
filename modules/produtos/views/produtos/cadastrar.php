
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

<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#informacoes" data-toggle="tab">Informações</a></li>
    <li><a href="#dimensoes" data-toggle="tab">Dimensões</a></li>
    <li><a href="#fotos" data-toggle="tab">Fotos</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="informacoes">
        <form method="POST" action="~/produtos/cadastrar">
            <div class="row">
                <div class="span4">
                    <div class="control-group">
                        <label class="control-label" for="nome">Nome <span class="warning">*</span></label>
                        <div class="controls">
                            <input type="text" class="span12" id="nome" name="nome" value="<?= $model->nome ?>"/>
                            <span class="help-block">Informe um valor para esse campo</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="modelo">Modelo</label>
                        <div class="controls">
                            <input type="text" class="span4" id="modelo" name="modelo" value="<?= $model->modelo ?>"/>
                            <span class="help-block">Informe um valor para esse campo</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="quantidade">Quantidade</label>
                        <div class="controls">
                            <input type="text" class="span4" id="quantidade" name="quantidade" value="<?= $model->quantidade ?>"/>
                            <span class="help-block">Informe um valor para esse campo</span>
                        </div>
                    </div>
                    <div class="control-group error">
                        <div class="controls">
                            <label class="control-label" for="preco">Preço</label>
                            <input type="text" class="span4" id="preco" name="preco" value="<?= $model->preco ?>"/>
                            <span class="help-block">Informe um valor para esse campo</span>
                        </div>
                    </div>
                </div>


                <div class="clearfix"></div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <input type="hidden" name="id" value="<?= $model->id ?>" />
                </div>
            </div>
        </form>
    </div>

    <div class="tab-pane" id="dimensoes">
        <div class="span4">
            <div class="control-group">
                <label class="control-label" for="altura">Altura</label>
                <div class="controls">
                    <input type="text" class="span4" id="quantidade" name="altura" value="<?= $model->altura ?>"/>
                    <span class="help-block">Informe um valor para esse campo</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="largura">Largura</label>
                <div class="controls">
                    <input type="text" class="span4" id="largura" name="largura" value="<?= $model->largura ?>"/>
                    <span class="help-block">Informe um valor para esse campo</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="comprimento">Comprimento</label>
                <div class="controls">
                    <input type="text" class="span4" id="comprimento" name="comprimento" value="<?= $model->comprimento ?>"/>
                    <span class="help-block">Informe um valor para esse campo</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="peso">Peso</label>
                <div class="controls">
                    <input type="text" class="span4" id="peso" name="peso" value="<?= $model->peso ?>"/>
                    <span class="help-block">Informe um valor para esse campo</span>
                </div>
            </div>
        </div>
        <div class="span4">
            Tags: <br />
            <div class="btn-group pull-left">
                <button data-toggle="dropdown" class="btn dropdown-toggle span4">
                    <span class="pull-left">Categorias</span>
                    <span class="caret pull-right"></span>
                </button>
                <ul class="dropdown-menu span4">
                    <li><a href="#">Selecione uma categoria</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="fotos">

        <?php
        include('enviarimagens.php');
        ?>
        <a href="javascript:void(0);" class="thumbnail">
            <img src="http://placehold.it/150x150" />
        </a>
    </div>
</div>


