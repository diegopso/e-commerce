<div class="pull-left">
    <ul class="breadcrumb">
        <li>
            <a href="~/">My store</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="~/conteudos">Conteúdos</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="~/conteudos/cadastrar">Cadastrar</a>
        </li>
    </ul>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="span<?= marketing ? 10 : 12 ?>">
        <form id="form-conteudo" class="form-horizontal" action="<?= site_url . 'Conteudos/Cadastrar' ?>" method="POST">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#conteudo" data-toggle="tab">Conteúdo</a></li>
                <li class=""><a href="#imagens" data-toggle="tab">Imagens</a></li>
            </ul>
            <div id="contentTabContent" class="tab-content">
                <div id="conteudo" class="tab-pane fade active in row">
                    <div class="row">
                        <br />
                        <div class="span10">
                            <div class="control-group">
                                <label class="control-label" for="nome">Título <span class="help-required">*</span></label>
                                <div class="controls">
                                    <input type="text" class="span8" id="titulo" name="titulo" value="<?= $model->titulo ?>"/>
                                    <span class="help-block">Informe o título do conteúdo</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="nome">Subtítulo</label>
                                <div class="controls">
                                    <input type="text" class="span8" id="subtitulo" name="subtitulo" value="<?= $model->subtitulo ?>"/>
                                    <span class="help-block">Informe o subtítulo do conteúdo</span>
                                </div>
                            </div>
                            <div id="descricao" class="tab-pane">
                                <? include(root . 'app/views/_snippet/editor.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="imagens">
                    <br />
                    <? include(root . 'app/views/_snippet/enviarimagens.php'); ?>
                    <span>Obs.: Máximo de <?= Helper_Conteudos::$arquivos_por_pagina ?> arquivos.</span>
                </div>
            </div>
            <hr />
            <div class="clearfix"></div>
            <div class="pull-right">
                <input type="submit" class="btn btn-primary" value="Salvar" />
                <input name="id" type="hidden" value="<?= $model->id ?>" />
                <a href="<?= site_url ?>conteudos" class="btn">Cancelar</a>
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
<div class="modal hide" id="correcoes">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Existem alguns campos incorretos</h3>
    </div>
    <div class="modal-body">
        
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">Ok</a>
    </div>
</div>
<script type="text/javascript">
    var $titulo = undefined;
    var $sub = undefined;
    var $tags = undefined;
    var requireds = undefined;
    $(document).ready(function(){
        $titulo = $('#titulo').keyupValidation(/^[\u0001-\u9999]{1,256}$/);
        $sub = $('#subtitulo').keyupValidation(/^[\u0001-\u9999]{0,256}$/);
        $tags = $('#palavras_chave').keyupValidation(/^([a-zA-Z0-9\s\_\-\'\"\\\/À-Ãà-ãÒ-Õò-õÈ-Êè-êÇçÌ-Îì-îÙ-Üù-ü]{1,}(;)?(\s)?)*$/);
        //$categoria = $('#categoria');
        requireds = [$titulo];
        
        $('#form-conteudo').submitValidation(requireds, '#correcoes', function(e){
            CKEDITOR.instances.editor.destroy();
        });
    });
</script>