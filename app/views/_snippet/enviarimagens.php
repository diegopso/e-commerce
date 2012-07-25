<button class="btn" data-toggle="slide" data-value="#uploader">
    <i class="icon-chevron-down"></i>
    <span>Nova Imagem</span>
    <i class="icon-plus"></i>
</button>
<div id="uploader" style="display:none;">
    <fieldset class="profile-fieldset">
        <div id="file-uploader-picture">		
            <noscript>			
            <p>Por favor, ative o JavaScript para utilizar esta funcionalidade.</p>
            </noscript>         
        </div>
    </fieldset>
</div>
<link rel="stylesheet" type="text/css" href="~/app/wwwroot/media/css/fileuploader.css"></link>
<script type="text/javascript" src="~/app/wwwroot/media/js/fileuploader.js"></script>
<script type="text/javascript">  
    var site_url = <?php echo '"' . site_url . '"' ?>;
    $(document).ready(function(){
        var picture_uploader_options = {
            name: 'picture-uploader',
            elementId: 'file-uploader-picture',
            onComplete: function(indx, fileName, data){
               data = data.d;
               if(data.status == 'SUCCESS'){
                   $('.qq-upload-list').empty();
                   $('#list-images .empty-row').remove();
                   
                   var tr = $('<tr><input type="hidden" name="nome_original[]" value="'+ data.model.original_name +'" /><input type="hidden" name="filename[]" value="'+ data.model.basename +'.'+ data.model.ext +'" /></tr>');
                   tr.append('<td>'+data.model.original_name+'</td>');
                   
                    var del = $('<button class="btn tip" onclick="return false;" title="Excluir"><i class="icon-trash"></i></button>').click(function(){
                        $(this).parent().parent().remove();
                    });
                   
                   var see = $('<a href="'+site_url+'uploads/temp/' + data.model.basename + '.' + data.model.ext + '" target="_blank" class="btn tip" title="Visualizar"><i class="icon-eye-open"></i></a>');
                   
                   tr.append($('<td></td>').append(del, see));
                   $('#list-images tbody').append(tr);
               }else{
                   
               }
            },
            showMessage: function(message){
                //pass
            },
            allowedExtensions: [
                'jpg', 'jpeg', 'png'
            ]
        };
        createUploader(picture_uploader_options);
    });
    
    
    removerImg = function(element){
        var self = $(element);
        var tr = self.parent().parent();
        tr.find('.loading').show();
        $.ajax({
            url: self.attr('href'),
            success: function(data){
                $('#list-images').remove();
                $('#imagens').append(data);
            }
        });
    }
    
    function createUploader(o){            
        var uploader = new qq.FileUploader({
            element: document.getElementById(o.elementId),
            action: site_url + "Midia/AjaxUpload", 
            debug: false,
            name: o.name,
            onComplete: o.onComplete,
            showMessage: o.showMessage
        });           
    }   
</script> 
<?php include('listarimagens.php'); ?>
    