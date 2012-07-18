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
                <li class="active"><a href="#descricao" data-toggle="tab">Descrição</a></li>
                <li class=""><a href="#imagens" data-toggle="tab">Imagens</a></li>
            </ul>
            <div id="contentTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="descricao">
                    <br />
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
                    <div>
                        <? include(root . 'app/views/_snippet/editor.php'); ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="imagens">
                    <br />
                    <? include(root . 'app/views/_snippet/enviarimagens.php'); ?>
                </div>
            </div>
            <hr />
            <div class="clearfix"></div>
            <div class="pull-right">
                <input type="submit" class="btn btn-primary" data-toggle="dont-redirect" value="Salvar" />
                <input type="submit" class="btn btn-info" value="Salvar e Sair" onclick="$('#redirect').val('1');" />
                <input id="redirect" name="redirecionar" type="hidden" value="" />
                <input name="id" type="hidden" value="<?= $model->id ?>" />
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
        
        $('#form-produto').submitValidation(requireds, 'seletor_modal');
        $('#form-produto').submit(function(){
            CKEDITOR.instances.editor.destroy();
        });
    });
</script>