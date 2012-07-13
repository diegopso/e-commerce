
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
        <form class="form-horizontal" action="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#informacoes" data-toggle="tab">Informações</a></li>
                <li class=""><a href="#descricao" data-toggle="tab">Descrição</a></li>
                <li class=""><a href="#dimensoes" data-toggle="tab">Dimensões</a></li>
                <li class=""><a href="#imagens" data-toggle="tab">Imagens</a></li>
            </ul>
            <div class="row">
                <div class="span10">
                    <div id="productTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="informacoes">
                            <br />
                            <div class="control-group">
                                <label class="control-label" for="nome">Nome <span class="warning">*</span></label>
                                <div class="controls">
                                    <input type="text" class="span8" id="nome" name="nome" value="<?= $model->nome ?>"/>
                                    <span class="help-block">Informe um valor para esse campo</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="modelo">Modelo</label>
                                <div class="controls">
                                    <input type="text" class="span8" id="modelo" name="modelo" value="<?= $model->modelo ?>"/>
                                    <span class="help-block">Informe um valor para esse campo</span>
                                </div>
                            </div>
                            <div class="pull-left">
                                <div class="control-group">
                                    <label class="control-label" for="quantidade">Quantidade</label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="quantidade" name="quantidade" value="<?= $model->quantidade ?>"/>
                                        <span class="help-block">Informe um valor para esse campo</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <div class="control-group error">
                                    <label class="control-label" for="preco">Preço</label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="preco" name="preco" value="<?= $model->preco ?>"/>
                                        <span class="help-block">Informe um valor para esse campo</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="descricao">
                        <br />
                            <center>
                                <?php include('editor.php') ?>
                            </center>
                        </div>
                        <div class="tab-pane fade" id="dimensoes">
                            <br />
                            <div class="pull-left">
                                <div class="control-group">
                                    <label class="control-label" for="altura">Altura</label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="quantidade" name="altura" value="<?= $model->altura ?>"/>
                                        <span class="help-block">Informe um valor para esse campo</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="largura">Largura</label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="largura" name="largura" value="<?= $model->largura ?>"/>
                                        <span class="help-block">Informe um valor para esse campo</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <div class="control-group">
                                    <label class="control-label" for="comprimento">Comprimento</label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="comprimento" name="comprimento" value="<?= $model->comprimento ?>"/>
                                        <span class="help-block">Informe um valor para esse campo</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="peso">Peso</label>
                                    <div class="controls">
                                        <input type="text" class="span3" id="peso" name="peso" value="<?= $model->peso ?>"/>
                                        <span class="help-block">Informe um valor para esse campo</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="imagens">
                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="clearfix"></div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button class="btn">Cancel</button>
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