<script type="text/javascript" src="~/media/js/tinyeditor.js"></script>
<div class="tiny-editor">
    <div class="btn-toolbar">
        <div class="btn-group toolbar-controls toolbar-controls">
            <a class="btn" title="Negrito" href="Bold"><i class="icon-bold"></i></a>
            <a class="btn" title="Itálico" href="Italic"><i class="icon-italic"></i></a>
            <a class="btn" title="Sublinhado" href="Underline"><i class="icon-text-width"></i></a>
        </div>
        <div class="btn-group toolbar-controls">
            <a class="btn" title="Lista Ordenada" href="Insert Ordered List"><i class="icon-list"></i></a>
            <a class="btn" title="Lista" href="Insert Unordered List"><i class="icon-list"></i></a>
        </div>
        <div class="btn-group toolbar-controls">
            <a class="btn" title="Remover Identação" href="Outdent"><i class="icon-indent-right"></i></a>
            <a class="btn" title="Identar" href="Indent"><i class="icon-indent-left"></i></a>
        </div>
        <div class="btn-group toolbar-controls">
            <a class="btn" title="Imagem" href="Insert Image"><i class="icon icon-picture"></i></a>
            <a class="btn" title="Linha Horizontal" href="Insert Horizontal Rule"><i class="icon-minus"></i></a>
            <a class="btn" title="Link" href="Insert Hyperlink"><i class="icon-globe"></i></a>
        </div>
        <div class="btn-group toolbar-controls">
            <a class="btn" title="Alinhar à Esquerda" href="Left Align"><i class="icon-align-left"></i></a>
            <a class="btn" title="Alinhar à Centro" href="Center Align"><i class="icon-align-center"></i></a>
            <a class="btn" title="Alinhar à Direita" href="Right Align"><i class="icon-align-right"></i></a>
            <a class="btn" title="Justificar" href="Block Justify"><i class="icon-align-justify"></i></a>
        </div>
        <div class="btn-group editor-select-style">
            <button class="btn dropdown-toggle" title="Estilo do Texto" data-toggle="dropdown">
                <span>Texto Normal</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="<p>">Texto Normal</a></li>
                <li><a href="<h1>"><h1>Titulo 1</h1></a></li>
                <li><a href="<h2>"><h2>Titulo 2</h2></a></li>
                <li><a href="<h3>"><h3>Titulo 3</h3></a></li>
                <li><a href="<h4>"><h4>Titulo 4</h4></a></li>
                <li><a href="<h5>"><h5>Titulo 5</h5></a></li>
                <li><a href="<h6>"><h6>Titulo 6</h6></a></li>
            </ul>
        </div>
    </div>
    <textarea id="edito-input"></textarea>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.toolbar-controls .btn').click(function(e){
            e.preventDefault();
            var ref = $(this).attr('href');
			
            $('.tecontrol[title="'+ref+'"]').click();
        });
		
        $('.editor-select-style a').click(function(e){
            e.preventDefault();
            var self = $(this);
            var ref = self.attr('href');
			
            $('.editor-select-style span:eq(0)').text(self.text());
			
            $('.testyle').val(ref).change();
        });
        
        //pegar conteudo como html
        //$("iframe").contents().find("#editor").html();
    });
	
    new TINY.editor.edit('editor',{
        id:'edito-input',
        width: '100%',
        controlclass:'tecontrol',
        rowclass:'teheader',
        dividerclass:'tedivider',
        controls:[
            'bold','italic','underline','|',
            'orderedlist','unorderedlist','|',
            'outdent','indent','|',
            'image','hr','link',
            'leftalign','centeralign','rightalign','blockjustify','|',
            'unformat','style','|',
        ],
        footer:true,
        fonts:['Verdana','Arial','Georgia','Trebuchet MS'],
        xhtml:true,
        cssfile:'style.css',
        bodyid:'editor',
        footerclass:'tefooter',
        toggle:{text:'source',activetext:'wysiwyg',cssclass:'toggle'},
        resize:{cssclass:'resize'}
    });
</script>